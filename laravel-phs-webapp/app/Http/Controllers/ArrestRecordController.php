<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Helper\DataRetrieval;

class ArrestRecordController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $prefill = DataRetrieval::retrieveArrestRecord(auth()->user()->username);
        $data = $this->getCommonViewData('arrest-record');
        $data = array_merge($data, $prefill);

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.sections.arrest-record-content', $data)->render();
        }
        return view('phs.arrest-record', $data);
    }

    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        try {
            // Validation (minimal for save-only, full for final submission)
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'arrest_records' => 'nullable|array',
                    'arrest_records.*.date_arrested' => 'nullable|date',
                    'arrest_records.*.offense' => 'nullable|string|max:255',
                    'arrest_records.*.place_arrested' => 'nullable|string|max:255',
                    'arrest_records.*.status' => 'nullable|string|max:255',
                    'arrest_records.*.disposition' => 'nullable|string|max:255',
                ]);
            } else {
                $validated = $request->validate([
                    'arrest_records' => 'nullable|array',
                    'arrest_records.*.date_arrested' => 'nullable|date',
                    'arrest_records.*.offense' => 'nullable|string|max:255',
                    'arrest_records.*.place_arrested' => 'nullable|string|max:255',
                    'arrest_records.*.status' => 'nullable|string|max:255',
                    'arrest_records.*.disposition' => 'nullable|string|max:255',
                ]);
            }

            $username = auth()->user()->username;
            $data = [
                'arrest_records' => $validated['arrest_records'] ?? [],
            ];
            
            \App\Helper\DataUpdate::saveArrestRecord($data, $username);
            $this->markSectionAsCompleted('arrest-record');
            session()->save();

            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Arrest record saved successfully']);
            }

            if ($request->ajax()) {
                $nextRoute = route('phs.character-and-reputation.create');
                return response()->json([
                    'success' => true,
                    'next_route' => $nextRoute
                ]);
            }

            return redirect()->route('phs.character-and-reputation.create')
                ->with('success', 'Arrest record saved successfully. Please continue with your character and reputation.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Exception in ArrestRecordController@store', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your arrest record. Please try again.');
        }
    }

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
            'credit-reputation',
            'arrest-record',
            'character-and-reputation',
            'organization',
            'miscellaneous'
        ];
    }
}
