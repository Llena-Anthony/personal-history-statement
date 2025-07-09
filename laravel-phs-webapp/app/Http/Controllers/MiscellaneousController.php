<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

use App\Models\UserDetail;
use App\Helper\DataRetrieval;
use App\Helper\DataUpdate;
use App\Models\PersonalDetail;
use App\Models\FluencyDetail;

use Illuminate\Support\Facades\Auth;

class MiscellaneousController extends Controller
{
    use PHSSectionTracking;

    /**
     * Show the form for creating/editing miscellaneous information.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $username = auth()->user()->username;
        $personalDetail = PersonalDetail::where('username', $username)->first();
        $fluencies = FluencyDetail::where('username', $username)->with('languageDetail')->get();
        $viewData = $this->getCommonViewData('miscellaneous');
        $viewData['personalDetail'] = $personalDetail;
        $viewData['fluencies'] = $fluencies;
        if (request()->ajax()) {
            return view('phs.sections.miscellaneous-content', $viewData);
        }
        return view('phs.miscellaneous-new', $viewData);
    }

    /**
     * Store miscellaneous information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        try {
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'hobbies' => 'nullable|string',
                    'languages' => 'nullable|array',
                    'languages.*.language' => 'nullable|string|max:255',
                    'languages.*.speak' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.read' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.write' => 'nullable|in:FLUENT,FAIR,POOR',
                    'undergo_lie_detection' => 'nullable|in:yes,no',
                ]);
            } else {
                $validated = $request->validate([
                    'hobbies' => 'required|string',
                    'languages' => 'nullable|array',
                    'languages.*.language' => 'nullable|string|max:255',
                    'languages.*.speak' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.read' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.write' => 'nullable|in:FLUENT,FAIR,POOR',
                    'undergo_lie_detection' => 'required|in:yes,no',
                ]);
            }
            $username = auth()->user()->username;
            // Update PersonalDetail
            $personalDetail = PersonalDetail::where('username', $username)->first();
            if (!$personalDetail) {
                $personalDetail = new PersonalDetail(['username' => $username]);
            }
            $personalDetail->hobbies = $validated['hobbies'] ?? '';
            $personalDetail->undergo_lie_detection = $validated['undergo_lie_detection'] ?? '';
            $personalDetail->save();
            // Update FluencyDetail
            if (isset($validated['languages'])) {
                // Remove all previous fluency records for this user
                FluencyDetail::where('username', $username)->delete();
                foreach ($validated['languages'] as $lang) {
                    if (!empty($lang['language'])) {
                        // Find or create the language by description
                        $langModel = \App\Models\LanguageDetail::firstOrCreate(
                            ['lang_desc' => $lang['language']]
                        );
                        FluencyDetail::create([
                            'username' => $username,
                            'lang' => $langModel->lang_id,
                            'speak_fluency' => $lang['speak'] ?? '',
                            'read_fluency' => $lang['read'] ?? '',
                            'write_fluency' => $lang['write'] ?? '',
                        ]);
                    }
                }
            }
            $this->markSectionAsCompleted('miscellaneous');
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Miscellaneous information saved successfully']);
            }
            return redirect()->route('phs.review')->with('success', 'Miscellaneous information saved successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your miscellaneous information. Please try again.');
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
