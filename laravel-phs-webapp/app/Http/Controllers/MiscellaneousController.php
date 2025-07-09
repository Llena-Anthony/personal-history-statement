<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

use App\Models\UserDetail;

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
        $miscellaneous = UserDetail::where('username', Auth::id())
            ->first();

        // Decode languages data if it exists
        $languages = [];
        if ($miscellaneous && $miscellaneous->languages_dialects) {
            $languages = json_decode($miscellaneous->languages_dialects, true) ?: [];
        }

        $viewData = $this->getCommonViewData('miscellaneous');
        $viewData['miscellaneous'] = $miscellaneous;
        $viewData['languages'] = $languages;

        // Return partial for AJAX requests, full view for normal requests
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
            // Validation rules
            $validated = $request->validate([
                'hobbies_sports_pastimes' => $isSaveOnly ? 'nullable|string|max:1000' : 'required|string|max:1000',
                'languages' => 'nullable|array',
                'languages.*.language' => 'nullable|string|max:255',
                'languages.*.speak' => 'nullable|string|max:255',
                'languages.*.read' => 'nullable|string|max:255',
                'languages.*.write' => 'nullable|string|max:255',
                'lie_detection_test' => 'nullable|in:yes,no',
            ]);

            \Log::info('Miscellaneous validated data:', $validated);

            // Use centralized helper to save miscellaneous data
            $username = auth()->user()->username;
            \App\Helper\DataUpdate::saveMiscellaneous($validated, $username);

            \Log::info('Miscellaneous after save:', [
                'personal_details' => \App\Models\PersonalDetail::where('username', $username)->first(),
                'fluency_details' => \App\Models\FluencyDetail::where('username', $username)->get()->toArray(),
            ]);

            // Mark miscellaneous section as completed
            $this->markSectionAsCompleted('miscellaneous');

            // Return appropriate response based on mode
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
