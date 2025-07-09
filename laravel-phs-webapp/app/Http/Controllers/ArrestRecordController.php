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
        $username = auth()->user()->username;
        $arrestRecord = \App\Models\ArrestRecordDetail::with(['arrDesc', 'famArrDesc', 'violationDesc'])->where('username', $username)->first();
        $data = $this->getCommonViewData('arrest-record');
        $data['arrestRecord'] = $arrestRecord;
        if (request()->ajax()) {
            return view('phs.sections.arrest-record-content', $data);
        }
        return view('phs.arrest-record', $data);
    }

    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        // Validation (keep as is)
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
        $username = auth()->user()->username;
        $data = [ 'arrest' => $validated ];
        \App\Helper\DataUpdate::saveArrestRecord($data, $username);
        $this->markSectionAsCompleted('arrest-record');
        if ($isSaveOnly) {
            return response()->json(['success' => true, 'message' => 'Arrest record and conduct information saved successfully']);
        }
        return redirect()->route('phs.character-and-reputation.create')->with('success', 'Arrest record and conduct saved successfully!');
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
