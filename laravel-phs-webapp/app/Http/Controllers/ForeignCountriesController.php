<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Models\User;

class ForeignCountriesController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        // Load all foreign visit details for the current user, with address details
        $username = auth()->user()->username;
        $foreignVisits = \App\Models\ForeignVisitDetail::with('addressDetail')->where('username', $username)->get();

        $data = $this->getCommonViewData('foreign-countries');
        $data['foreignVisits'] = $foreignVisits;

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.sections.foreign-countries-content', $data);
        }

        return view('phs.foreign-countries', $data);
    }

    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';

        // Validation (keep as is, but for array of countries)
        $rules = [
            'countries' => 'nullable|array',
            'countries.*.name' => 'nullable|string|max:255',
            'countries.*.purpose' => 'nullable|string|max:255',
            'countries.*.from_month' => 'nullable|string|max:2',
            'countries.*.from_year' => 'nullable|integer|min:1900|max:2030',
            'countries.*.to_month' => 'nullable|string|max:2',
            'countries.*.to_year' => 'nullable|integer|min:1900|max:2030',
            'countries.*.address_abroad' => 'nullable|string|max:255',
        ];
        $validated = $request->validate($rules);

        try {
            $username = auth()->user()->username;
            $data = [
                'countries' => $validated['countries'] ?? [],
            ];
            \App\Helper\DataUpdate::saveForeignCountriesVisited($data, $username);

            $this->markSectionAsCompleted('foreign-countries');

            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Foreign countries visited saved successfully']);
            }

            return redirect()->route('phs.credit-reputation.create')
                ->with('success', 'Foreign countries visited saved successfully. Please continue with your credit reputation.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your foreign countries visited. Please try again.');
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
