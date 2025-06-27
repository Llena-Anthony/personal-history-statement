<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Models\ResidenceHistory;

class PlacesOfResidenceController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        // Load existing residence history data for autofill
        $residenceHistory = ResidenceHistory::where('username', auth()->user()->username)->get();
        
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
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'residences.*.address' => 'nullable|string|max:255',
                'residences.*.from_date' => 'nullable|date',
                'residences.*.to_date' => 'nullable|date',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'residences.*.address' => 'nullable|string|max:255',
                'residences.*.from_date' => 'nullable|date',
                'residences.*.to_date' => 'nullable|date',
            ]);
        }

        try {
            // Mark places of residence as completed
            $this->markSectionAsCompleted('places-of-residence');

            // Log validated data
            \Log::info('PlacesOfResidence validated data:', $validated);

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Places of residence saved successfully']);
            }

            // Save residences
            foreach ($validated['residences'] as $residence) {
                ResidenceHistory::updateOrCreate(
                    ['username' => auth()->user()->username, 'address' => $residence['address']],
                    [
                        'from_date' => $residence['from_date'],
                        'to_date' => $residence['to_date'],
                    ]
                );
            }

            // Log residences after saving
            \Log::info('ResidenceHistory after save:', ResidenceHistory::where('username', auth()->user()->username)->get()->toArray());

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
} 