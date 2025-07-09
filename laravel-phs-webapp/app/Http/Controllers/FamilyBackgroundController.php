<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Models\FamilyHistoryDetail;
use App\Models\FamilyMember;
use App\Helper\DataRetrieval;

class FamilyBackgroundController extends Controller
{
    use PHSSectionTracking;

    /**
     * Show the form for creating a new family background.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $prefill = DataRetrieval::retrieveFamilyBackground(auth()->user()->username);
        $data = $this->getCommonViewData('family-background');
        $data = array_merge($data, $prefill);
        return view('phs.family-background', $data);
    }

    /**
     * Store a newly created family background in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        \Log::info('FamilyBackground store method called', [
            'user_id' => auth()->id(),
            'request_data' => $request->all(),
            'is_ajax' => $request->ajax(),
            'save_only' => $request->header('X-Save-Only')
        ]);

        $isSaveOnly = $request->header('X-Save-Only') === 'true';

        try {
            // Validation (same as before)
            $validated = $request->validate([
                // Father
                'father_first_name' => 'nullable|string|max:255',
                'father_middle_name' => 'nullable|string|max:255',
                'father_last_name' => 'nullable|string|max:255',
                'father_suffix' => 'nullable|string|max:255',
                'father_birth_date' => 'nullable|date',
                'father_birth_place' => 'nullable|string|max:255',
                'father_occupation' => 'nullable|string|max:255',
                'father_employer' => 'nullable|string|max:255',
                'father_place_of_employment' => 'nullable|string|max:255',
                'father_citizenship_type' => 'nullable|string|in:Single,Dual,Naturalized',
                'father_citizenship' => 'nullable|string|max:255',
                'father_citizenship_dual_1' => 'nullable|string|max:255',
                'father_citizenship_dual_2' => 'nullable|string|max:255',
                'father_citizenship_naturalized' => 'nullable|string|max:255',
                'father_naturalized_month' => 'nullable|string|max:2',
                'father_naturalized_year' => 'nullable|integer|min:1900|max:2030',
                'father_naturalized_place' => 'nullable|string|max:255',
                'father_other_citizenship' => 'nullable|string|max:255',
                'father_naturalized_details' => 'nullable|string|max:255',
                'father_complete_address' => 'nullable|string|max:255',
                // Mother
                'mother_first_name' => 'nullable|string|max:255',
                'mother_middle_name' => 'nullable|string|max:255',
                'mother_last_name' => 'nullable|string|max:255',
                'mother_suffix' => 'nullable|string|max:255',
                'mother_birth_date' => 'nullable|date',
                'mother_birth_place' => 'nullable|string|max:255',
                'mother_occupation' => 'nullable|string|max:255',
                'mother_employer' => 'nullable|string|max:255',
                'mother_place_of_employment' => 'nullable|string|max:255',
                'mother_citizenship_type' => 'nullable|string|in:Single,Dual,Naturalized',
                'mother_citizenship' => 'nullable|string|max:255',
                'mother_citizenship_dual_1' => 'nullable|string|max:255',
                'mother_citizenship_dual_2' => 'nullable|string|max:255',
                'mother_citizenship_naturalized' => 'nullable|string|max:255',
                'mother_naturalized_month' => 'nullable|string|max:2',
                'mother_naturalized_year' => 'nullable|integer|min:1900|max:2030',
                'mother_naturalized_place' => 'nullable|string|max:255',
                'mother_other_citizenship' => 'nullable|string|max:255',
                'mother_naturalized_details' => 'nullable|string|max:255',
                'mother_complete_address' => 'nullable|string|max:255',
                // Siblings
                'siblings' => 'nullable|array',
                'siblings.*.first_name' => 'nullable|string|max:255',
                'siblings.*.middle_name' => 'nullable|string|max:255',
                'siblings.*.last_name' => 'nullable|string|max:255',
                'siblings.*.date_of_birth' => 'nullable|date',
                'siblings.*.citizenship' => 'nullable|string|max:255',
                'siblings.*.dual_citizenship' => 'nullable|string|max:255',
                'siblings.*.complete_address' => 'nullable|string|max:255',
                'siblings.*.occupation' => 'nullable|string|max:255',
                'siblings.*.employer' => 'nullable|string|max:255',
                'siblings.*.employer_address' => 'nullable|string|max:255',
                // Step-parent or Guardian
                'step_parent_guardian_first_name' => 'nullable|string|max:255',
                'step_parent_guardian_middle_name' => 'nullable|string|max:255',
                'step_parent_guardian_last_name' => 'nullable|string|max:255',
                'step_parent_guardian_suffix' => 'nullable|string|max:255',
                'step_parent_guardian_birth_date' => 'nullable|date',
                'step_parent_guardian_birth_place' => 'nullable|string|max:255',
                'step_parent_guardian_occupation' => 'nullable|string|max:255',
                'step_parent_guardian_employer' => 'nullable|string|max:255',
                'step_parent_guardian_place_of_employment' => 'nullable|string|max:255',
                'step_parent_guardian_complete_address' => 'nullable|string|max:500',
                'step_parent_guardian_citizenship_type' => 'nullable|string|max:255',
                'step_parent_guardian_citizenship' => 'nullable|string|max:255',
                'step_parent_guardian_citizenship_dual_1' => 'nullable|string|max:255',
                'step_parent_guardian_citizenship_dual_2' => 'nullable|string|max:255',
                'step_parent_guardian_citizenship_naturalized' => 'nullable|string|max:255',
                'step_parent_guardian_naturalized_month' => 'nullable|string|max:255',
                'step_parent_guardian_naturalized_year' => 'nullable|integer|min:1900|max:2030',
                'step_parent_guardian_naturalized_place' => 'nullable|string|max:255',
                'step_parent_guardian_naturalized_details' => 'nullable|string|max:500',
                // Father-in-law
                'father_in_law_first_name' => 'nullable|string|max:255',
                'father_in_law_middle_name' => 'nullable|string|max:255',
                'father_in_law_last_name' => 'nullable|string|max:255',
                'father_in_law_suffix' => 'nullable|string|max:255',
                'father_in_law_birth_date' => 'nullable|date',
                'father_in_law_birth_place' => 'nullable|string|max:255',
                'father_in_law_occupation' => 'nullable|string|max:255',
                'father_in_law_employer' => 'nullable|string|max:255',
                'father_in_law_place_of_employment' => 'nullable|string|max:255',
                'father_in_law_complete_address' => 'nullable|string|max:500',
                'father_in_law_citizenship_type' => 'nullable|string|max:255',
                'father_in_law_citizenship' => 'nullable|string|max:255',
                'father_in_law_citizenship_dual_1' => 'nullable|string|max:255',
                'father_in_law_citizenship_dual_2' => 'nullable|string|max:255',
                'father_in_law_citizenship_naturalized' => 'nullable|string|max:255',
                'father_in_law_naturalized_month' => 'nullable|string|max:255',
                'father_in_law_naturalized_year' => 'nullable|integer|min:1900|max:2030',
                'father_in_law_naturalized_place' => 'nullable|string|max:255',
                'father_in_law_naturalized_details' => 'nullable|string|max:500',
                // Mother-in-law
                'mother_in_law_first_name' => 'nullable|string|max:255',
                'mother_in_law_middle_name' => 'nullable|string|max:255',
                'mother_in_law_last_name' => 'nullable|string|max:255',
                'mother_in_law_suffix' => 'nullable|string|max:255',
                'mother_in_law_birth_date' => 'nullable|date',
                'mother_in_law_birth_place' => 'nullable|string|max:255',
                'mother_in_law_occupation' => 'nullable|string|max:255',
                'mother_in_law_employer' => 'nullable|string|max:255',
                'mother_in_law_place_of_employment' => 'nullable|string|max:255',
                'mother_in_law_complete_address' => 'nullable|string|max:500',
                'mother_in_law_citizenship_type' => 'nullable|string|max:255',
                'mother_in_law_citizenship' => 'nullable|string|max:255',
                'mother_in_law_citizenship_dual_1' => 'nullable|string|max:255',
                'mother_in_law_citizenship_dual_2' => 'nullable|string|max:255',
                'mother_in_law_citizenship_naturalized' => 'nullable|string|max:255',
                'mother_in_law_naturalized_month' => 'nullable|string|max:255',
                'mother_in_law_naturalized_year' => 'nullable|integer|min:1900|max:2030',
                'mother_in_law_naturalized_place' => 'nullable|string|max:255',
                'mother_in_law_naturalized_details' => 'nullable|string|max:500',
            ]);

            \Log::info('Validation passed', ['validated_data' => $validated]);

            // Save or update all family background data using the helper
            \App\Helper\DataUpdate::saveOrUpdateFamilyBackground(auth()->user()->username, $validated);

            // Update PHS section tracking
            $phs = \App\Models\PHS::where('user_id', auth()->id())->first();
            if ($phs) {
                $phs->update(['section_4_completed' => true]);
            }
            $this->markSectionAsCompleted('family-background');
            \Log::info('Session after markSectionAsCompleted', ['phs_sections' => session('phs_sections')]);
            session()->save();
            \Log::info('Session after session()->save()', ['phs_sections' => session('phs_sections')]);

            if ($request->ajax()) {
                \Log::info('Returning AJAX response, session:', ['phs_sections' => session('phs_sections')]);
                $nextRoute = auth()->user()->role === 'personnel'
                    ? route('personnel.phs.educational-background.create')
                    : route('phs.educational-background.create');

                return response()->json([
                    'success' => true,
                    'next_route' => $nextRoute
                ]);
            }
            return redirect()->route('phs.section', ['section' => 'family-background']);
        } catch (\Exception $e) {
            \Log::error('Exception in FamilyBackgroundController@store', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            if ($request->ajax()) {
                return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
            }
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Get the list of PHS sections.
     * Overrides the method in PHSSectionTracking trait to define the main sections.
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
        ];
    }
}
