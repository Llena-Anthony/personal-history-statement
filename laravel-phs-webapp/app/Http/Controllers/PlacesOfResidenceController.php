<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

use App\Models\User;

class PlacesOfResidenceController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        // Load all residence history details for the current user, with address details
        $username = auth()->user()->username;
        $residenceHistory = \App\Models\ResidenceHistoryDetail::with('addressDetail')->where('username', $username)->get();

        $data = $this->getCommonViewData('places-of-residence');
        $data['residenceHistory'] = $residenceHistory;

        // Return partial for AJAX requests, full view for normal requests
        if (request()->ajax()) {
            return view('phs.sections.places-of-residence-content', $data);
        }

        return view('phs.places-of-residence', $data);
    }

    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';

        // Validation (keep as is)
        if ($isSaveOnly) {
            $validated = $request->validate([
                'residences.*.address' => 'nullable|string|max:255',
                'residences.*.from_date' => 'nullable|date',
                'residences.*.to_date' => 'nullable|date',
            ]);
        } else {
            $validated = $request->validate([
                'residences.*.address' => 'nullable|string|max:255',
                'residences.*.from_date' => 'nullable|date',
                'residences.*.to_date' => 'nullable|date',
            ]);
        }

        try {
            $username = auth()->user()->username;
            $data = [
                'residences' => $validated['residences'] ?? [],
            ];
            \App\Helper\DataUpdate::savePlacesOfResidence($data, $username);

            $this->markSectionAsCompleted('places-of-residence');

            if ($isSaveOnly || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Places of residence saved successfully',
                    'next_route' => route('phs.employment-history.create')
                ]);
            }

            return redirect()->route('phs.employment-history.create')
                ->with('success', 'Places of residence saved successfully. Please continue with your employment history.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your places of residence. Please try again.');
        }
    }

    /**
     * Get the list of PHS sections for progress calculation.
     *
     * @return array
     */
    protected function getSections()
    {
        return [
            'personal-details',
            'family-background',
            'educational-background',
            'employment-history',
            'military-history',
            'places-of-residence',
            'foreign-countries',
            'personal-characteristics',
            'marital-status',
            'family-history',
            'organization',
            'miscellaneous',
        ];
    }
}
