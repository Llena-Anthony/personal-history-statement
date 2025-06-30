<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Models\Miscellaneous;
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
        $miscellaneous = Miscellaneous::where('user_id', Auth::id())
            ->where('misc_type', 'general-miscellaneous')
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
            // Check if this is a save-only request (for dynamic navigation)
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'hobbies_sports_pastimes' => 'nullable|string',
                    'languages' => 'nullable|array',
                    'languages.*.language' => 'nullable|string|max:255',
                    'languages.*.speak' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.read' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.write' => 'nullable|in:FLUENT,FAIR,POOR',
                    'lie_detection_test' => 'nullable|in:yes,no',
                ]);
            } else {
                // Full validation for final submission
                $validated = $request->validate([
                    'hobbies_sports_pastimes' => 'required|string',
                    'languages' => 'nullable|array',
                    'languages.*.language' => 'nullable|string|max:255',
                    'languages.*.speak' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.read' => 'nullable|in:FLUENT,FAIR,POOR',
                    'languages.*.write' => 'nullable|in:FLUENT,FAIR,POOR',
                    'lie_detection_test' => 'required|in:yes,no',
                ]);
            }

            \Log::info('Miscellaneous validated data:', $validated);

            // Process languages data
            $languagesData = '';
            if (isset($validated['languages'])) {
                $languagesArray = [];
                foreach ($validated['languages'] as $language) {
                    if (!empty($language['language'])) {
                        $languagesArray[] = [
                            'language' => $language['language'],
                            'speak' => $language['speak'] ?? '',
                            'read' => $language['read'] ?? '',
                            'write' => $language['write'] ?? ''
                        ];
                    }
                }
                $languagesData = json_encode($languagesArray);
            }

            $miscellaneous = Miscellaneous::updateOrCreate(
                ['user_id' => Auth::id(), 'misc_type' => 'general-miscellaneous'],
                [
                    'hobbies_sports_pastimes' => $validated['hobbies_sports_pastimes'] ?? '',
                    'languages_dialects' => $languagesData,
                    'lie_detection_test' => $validated['lie_detection_test'] ?? null,
                ]
            );

            \Log::info('Miscellaneous after save:', $miscellaneous->toArray());

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