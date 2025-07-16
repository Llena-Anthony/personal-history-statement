<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Helper\DataRetrieval;

class MiscellaneousController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $prefill = DataRetrieval::retrieveMiscellaneous(auth()->user()->username);
        $data = $this->getCommonViewData('miscellaneous');
        $data = array_merge($data, $prefill);
        // Always return the full section view
        return view('phs.miscellaneous-new', $data);
    }

    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        try {
            // Validation (minimal for save-only, full for final submission)
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'hobbies_sports_pastimes' => 'nullable|string|max:1000',
                    'languages' => 'nullable|array',
                    'languages.*.language' => 'nullable|string|max:255',
                    'languages.*.speak' => 'nullable|string|max:50',
                    'languages.*.read' => 'nullable|string|max:50',
                    'languages.*.write' => 'nullable|string|max:50',
                    'lie_detection_test' => 'nullable|string|max:255',
                ]);
            } else {
                $validated = $request->validate([
                    'hobbies_sports_pastimes' => 'nullable|string|max:1000',
                    'languages' => 'nullable|array',
                    'languages.*.language' => 'nullable|string|max:255',
                    'languages.*.speak' => 'nullable|string|max:50',
                    'languages.*.read' => 'nullable|string|max:50',
                    'languages.*.write' => 'nullable|string|max:50',
                    'lie_detection_test' => 'nullable|string|max:255',
                ]);
            }

            $username = auth()->user()->username;
            $data = [
                'hobbies_sports_pastimes' => $validated['hobbies_sports_pastimes'] ?? null,
                'languages' => $validated['languages'] ?? [],
                'lie_detection_test' => $validated['lie_detection_test'] ?? null,
            ];
            
            \App\Helper\DataUpdate::saveMiscellaneous($data, $username);
            $this->markSectionAsCompleted('miscellaneous');
            session()->save();

            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Miscellaneous information saved successfully']);
            }

            if ($request->ajax()) {
                $nextRoute = route('phs.review.create');
                return response()->json([
                    'success' => true,
                    'next_route' => $nextRoute
                ]);
            }

            return redirect()->route('phs.review.create')
                ->with('success', 'Miscellaneous information saved successfully. Please review your PHS submission.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Exception in MiscellaneousController@store', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your miscellaneous information. Please try again.');
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
