<?php

namespace App\Http\Controllers;

use App\Models\ArrestRecordDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\PHSSectionTracking;

class ArrestRecordController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $arrestRecord = ArrestRecordDetail::where('username', Auth::id())->first();

        $data = $this->getCommonViewData('arrest-record');
        $data['arrestRecord'] = $arrestRecord;

        if (request()->ajax()) {
            return view('phs.sections.arrest-record-content', $data);
        }

        return view('phs.arrest-record', $data);
    }

    public function store(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';

        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'investigated_arrested' => 'nullable|in:yes,no',
                'investigated_arrested_details' => 'nullable|string|max:1000',
                'family_investigated_arrested' => 'nullable|in:yes,no',
                'family_investigated_arrested_details' => 'nullable|string|max:1000',
                'administrative_case' => 'nullable|in:yes,no',
                'administrative_case_details' => 'nullable|string|max:1000',
                'pd1081_arrested' => 'nullable|in:yes,no',
                'pd1081_arrested_details' => 'nullable|string|max:1000',
                'intoxicating_liquor_narcotics' => 'nullable|in:yes,no',
                'intoxicating_liquor_narcotics_details' => 'nullable|string|max:1000',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'investigated_arrested' => 'required|in:yes,no',
                'investigated_arrested_details' => 'required_if:investigated_arrested,yes|string|max:1000',
                'family_investigated_arrested' => 'required|in:yes,no',
                'family_investigated_arrested_details' => 'required_if:family_investigated_arrested,yes|string|max:1000',
                'administrative_case' => 'required|in:yes,no',
                'administrative_case_details' => 'required_if:administrative_case,yes|string|max:1000',
                'pd1081_arrested' => 'required|in:yes,no',
                'pd1081_arrested_details' => 'required_if:pd1081_arrested,yes|string|max:1000',
                'intoxicating_liquor_narcotics' => 'required|in:yes,no',
                'intoxicating_liquor_narcotics_details' => 'required_if:intoxicating_liquor_narcotics,yes|string|max:1000',
            ]);
        }

        // Add user_id to validated data
        $validated['user_id'] = Auth::id();

        \Log::info('ArrestRecord validated data:', $validated);

        try {
            // Save or update arrest record
            $arrestRecord = ArrestRecord::updateOrCreate(
                ['user_id' => Auth::id()],
                $validated
            );

            \Log::info('ArrestRecord after save:', $arrestRecord->toArray());

            // Mark section as completed using trait method
            $this->markSectionAsCompleted('arrest-record');

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Arrest record and conduct information saved successfully']);
            }

            return redirect()->route('phs.character-and-reputation.create')->with('success', 'Arrest record and conduct saved successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your arrest record. Please try again.');
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
