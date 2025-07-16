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
        if (!is_array($prefill)) {
            $prefill = $prefill ? $prefill->toArray() : [];
        }
        $data = $this->getCommonViewData('arrest-record');
        $data = array_merge($data, $prefill);
        $data['arrestRecord'] = DataRetrieval::retrieveArrestRecord(auth()->user()->username);
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
            $rules = [
                'investigated_arrested' => 'nullable|string|in:yes,no',
                'investigated_arrested_court_name' => 'nullable|string|max:255',
                'investigated_arrested_nature_of_offense' => 'nullable|string|max:255',
                'investigated_arrested_disposition_of_case' => 'nullable|string|max:255',
                'family_investigated_arrested' => 'nullable|string|in:yes,no',
                'family_investigated_arrested_court_name' => 'nullable|string|max:255',
                'family_investigated_arrested_nature_of_offense' => 'nullable|string|max:255',
                'family_investigated_arrested_disposition_of_case' => 'nullable|string|max:255',
                'administrative_case' => 'nullable|string|in:yes,no',
                'administrative_case_details' => 'nullable|string|max:255',
                'pd1081_arrested' => 'nullable|string|in:yes,no',
                'pd1081_arrested_nature_of_offense' => 'nullable|string|max:255',
                'pd1081_arrested_disposition_of_case' => 'nullable|string|max:255',
                'intoxicating_liquor_narcotics' => 'nullable|string|in:yes,no',
                'intoxicating_liquor_narcotics_details' => 'nullable|string|max:255',
            ];
            $validated = $request->validate($rules);

            $username = auth()->user()->username;
            $data = ['arrest' => $validated];

            \App\Helper\DataUpdate::saveArrestRecord($data, $username);
            $this->markSectionAsCompleted('arrest-record');
            session()->save();

            if ($isSaveOnly || $request->ajax()) {
                $nextRoute = route('phs.character-and-reputation.create');
                return response()->json([
                    'success' => true,
                    'message' => 'Arrest record saved successfully',
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
