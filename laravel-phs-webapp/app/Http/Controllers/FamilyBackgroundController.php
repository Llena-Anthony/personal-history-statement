<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Services\NameService;
use App\Models\FamilyBackground;

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
        // Determine which section is being accessed
        $currentSection = request()->routeIs('phs.family-history.create') ? 'family-history' : 'family-background';
        
        $data = $this->getCommonViewData($currentSection);

        // Load existing family background data for autofill
        $familyBackground = FamilyBackground::where('user_id', auth()->id())->first();
        if ($familyBackground) {
            $data['familyBackground'] = $familyBackground;
            
            // Load related data
            $data['siblings'] = $familyBackground->siblings()->with('nameDetails')->get();
        }

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.sections.family-background-content', $data);
        }

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
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'father_first_name' => 'nullable|string|max:255',
                'father_middle_name' => 'nullable|string|max:255',
                'father_last_name' => 'nullable|string|max:255',
                'father_suffix' => 'nullable|string|max:255',
                'father_birth_date' => 'nullable|date',
                'father_birth_place' => 'nullable|string|max:255',
                'father_occupation' => 'nullable|string|max:255',
                'father_employer' => 'nullable|string|max:255',
                'father_place_of_employment' => 'nullable|string|max:255',
                'father_citizenship' => 'nullable|string|max:255',
                'father_other_citizenship' => 'nullable|string|max:255',
                'father_naturalized_details' => 'nullable|string|max:255',
                'father_complete_address' => 'nullable|string|max:255',
                'mother_first_name' => 'nullable|string|max:255',
                'mother_middle_name' => 'nullable|string|max:255',
                'mother_last_name' => 'nullable|string|max:255',
                'mother_suffix' => 'nullable|string|max:255',
                'mother_birth_date' => 'nullable|date',
                'mother_birth_place' => 'nullable|string|max:255',
                'mother_occupation' => 'nullable|string|max:255',
                'mother_employer' => 'nullable|string|max:255',
                'mother_place_of_employment' => 'nullable|string|max:255',
                'mother_citizenship' => 'nullable|string|max:255',
                'mother_other_citizenship' => 'nullable|string|max:255',
                'mother_naturalized_details' => 'nullable|string|max:255',
                'mother_complete_address' => 'nullable|string|max:255',
                'spouse_first_name' => 'nullable|string|max:255',
                'spouse_middle_name' => 'nullable|string|max:255',
                'spouse_last_name' => 'nullable|string|max:255',
                'spouse_suffix' => 'nullable|string|max:255',
                'spouse_birth_date' => 'nullable|date',
                'spouse_birth_place' => 'nullable|string|max:255',
                'spouse_occupation' => 'nullable|string|max:255',
                'spouse_employer' => 'nullable|string|max:255',
                'spouse_place_of_employment' => 'nullable|string|max:255',
                'spouse_citizenship' => 'nullable|string|max:255',
                'spouse_other_citizenship' => 'nullable|string|max:255',
                'spouse_naturalized_details' => 'nullable|string|max:255',
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
                'step_parent_guardian_citizenship' => 'nullable|string|max:255',
                'step_parent_guardian_other_citizenship' => 'nullable|string|max:255',
                'step_parent_guardian_naturalized_details' => 'nullable|string|max:255',
                'step_parent_guardian_complete_address' => 'nullable|string|max:255',
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
                'father_in_law_citizenship' => 'nullable|string|max:255',
                'father_in_law_other_citizenship' => 'nullable|string|max:255',
                'father_in_law_naturalized_details' => 'nullable|string|max:255',
                'father_in_law_complete_address' => 'nullable|string|max:255',
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
                'mother_in_law_citizenship' => 'nullable|string|max:255',
                'mother_in_law_other_citizenship' => 'nullable|string|max:255',
                'mother_in_law_naturalized_details' => 'nullable|string|max:255',
                'mother_in_law_complete_address' => 'nullable|string|max:255',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'father_first_name' => 'required|string|max:255',
                'father_middle_name' => 'nullable|string|max:255',
                'father_last_name' => 'required|string|max:255',
                'father_suffix' => 'nullable|string|max:255',
                'father_birth_date' => 'required|date',
                'father_birth_place' => 'required|string|max:255',
                'father_occupation' => 'nullable|string|max:255',
                'father_employer' => 'nullable|string|max:255',
                'father_place_of_employment' => 'nullable|string|max:255',
                'father_citizenship' => 'nullable|string|max:255',
                'father_other_citizenship' => 'nullable|string|max:255',
                'father_naturalized_details' => 'nullable|string|max:255',
                'father_complete_address' => 'nullable|string|max:255',
                'mother_first_name' => 'required|string|max:255',
                'mother_middle_name' => 'nullable|string|max:255',
                'mother_last_name' => 'required|string|max:255',
                'mother_suffix' => 'nullable|string|max:255',
                'mother_birth_date' => 'required|date',
                'mother_birth_place' => 'required|string|max:255',
                'mother_occupation' => 'nullable|string|max:255',
                'mother_employer' => 'nullable|string|max:255',
                'mother_place_of_employment' => 'nullable|string|max:255',
                'mother_citizenship' => 'nullable|string|max:255',
                'mother_other_citizenship' => 'nullable|string|max:255',
                'mother_naturalized_details' => 'nullable|string|max:255',
                'mother_complete_address' => 'nullable|string|max:255',
                'spouse_first_name' => 'nullable|string|max:255',
                'spouse_middle_name' => 'nullable|string|max:255',
                'spouse_last_name' => 'nullable|string|max:255',
                'spouse_suffix' => 'nullable|string|max:255',
                'spouse_birth_date' => 'nullable|date',
                'spouse_birth_place' => 'nullable|string|max:255',
                'spouse_occupation' => 'nullable|string|max:255',
                'spouse_employer' => 'nullable|string|max:255',
                'spouse_place_of_employment' => 'nullable|string|max:255',
                'spouse_citizenship' => 'nullable|string|max:255',
                'spouse_other_citizenship' => 'nullable|string|max:255',
                'spouse_naturalized_details' => 'nullable|string|max:255',
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
                'step_parent_guardian_citizenship' => 'nullable|string|max:255',
                'step_parent_guardian_other_citizenship' => 'nullable|string|max:255',
                'step_parent_guardian_naturalized_details' => 'nullable|string|max:255',
                'step_parent_guardian_complete_address' => 'nullable|string|max:255',
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
                'father_in_law_citizenship' => 'nullable|string|max:255',
                'father_in_law_other_citizenship' => 'nullable|string|max:255',
                'father_in_law_naturalized_details' => 'nullable|string|max:255',
                'father_in_law_complete_address' => 'nullable|string|max:255',
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
                'mother_in_law_citizenship' => 'nullable|string|max:255',
                'mother_in_law_other_citizenship' => 'nullable|string|max:255',
                'mother_in_law_naturalized_details' => 'nullable|string|max:255',
                'mother_in_law_complete_address' => 'nullable|string|max:255',
            ]);
        }

        // Capitalize names for all family members
        foreach ([
            'father', 'mother', 'spouse', 'step_parent_guardian', 'father_in_law', 'mother_in_law'
        ] as $role) {
            foreach (['first_name', 'middle_name', 'last_name'] as $part) {
                $key = $role . '_' . $part;
                if (isset($validated[$key]) && $validated[$key]) {
                    $validated[$key] = ucwords(strtolower($validated[$key]));
                }
            }
        }

        try {
            // Create or find NameDetails for each family member
            $fatherName = NameService::createOrFindName(
                $validated['father_first_name'] ?? null,
                $validated['father_last_name'] ?? null,
                $validated['father_middle_name'] ?? null,
                null,
                $validated['father_suffix'] ?? null
            );
            $motherName = NameService::createOrFindName(
                $validated['mother_first_name'] ?? null,
                $validated['mother_last_name'] ?? null,
                $validated['mother_middle_name'] ?? null,
                null,
                $validated['mother_suffix'] ?? null
            );
            $spouseName = NameService::createOrFindName(
                $validated['spouse_first_name'] ?? null,
                $validated['spouse_last_name'] ?? null,
                $validated['spouse_middle_name'] ?? null,
                null,
                $validated['spouse_suffix'] ?? null
            );
            $stepParentName = NameService::createOrFindName(
                $validated['step_parent_guardian_first_name'] ?? null,
                $validated['step_parent_guardian_last_name'] ?? null,
                $validated['step_parent_guardian_middle_name'] ?? null,
                null,
                $validated['step_parent_guardian_suffix'] ?? null
            );
            $fatherInLawName = NameService::createOrFindName(
                $validated['father_in_law_first_name'] ?? null,
                $validated['father_in_law_last_name'] ?? null,
                $validated['father_in_law_middle_name'] ?? null,
                null,
                $validated['father_in_law_suffix'] ?? null
            );
            $motherInLawName = NameService::createOrFindName(
                $validated['mother_in_law_first_name'] ?? null,
                $validated['mother_in_law_last_name'] ?? null,
                $validated['mother_in_law_middle_name'] ?? null,
                null,
                $validated['mother_in_law_suffix'] ?? null
            );
            // Prepare data for FamilyBackground
            $fbData = $validated;
            unset(
                $fbData['father_first_name'], $fbData['father_middle_name'], $fbData['father_last_name'], $fbData['father_suffix'],
                $fbData['mother_first_name'], $fbData['mother_middle_name'], $fbData['mother_last_name'], $fbData['mother_suffix'],
                $fbData['spouse_first_name'], $fbData['spouse_middle_name'], $fbData['spouse_last_name'], $fbData['spouse_suffix'],
                $fbData['step_parent_guardian_first_name'], $fbData['step_parent_guardian_middle_name'], $fbData['step_parent_guardian_last_name'], $fbData['step_parent_guardian_suffix'],
                $fbData['father_in_law_first_name'], $fbData['father_in_law_middle_name'], $fbData['father_in_law_last_name'], $fbData['father_in_law_suffix'],
                $fbData['mother_in_law_first_name'], $fbData['mother_in_law_middle_name'], $fbData['mother_in_law_last_name'], $fbData['mother_in_law_suffix']
            );
            $fbData['father_name_id'] = $fatherName ? $fatherName->name_id : null;
            $fbData['mother_name_id'] = $motherName ? $motherName->name_id : null;
            $fbData['spouse_name_id'] = $spouseName ? $spouseName->name_id : null;
            $fbData['step_parent_guardian_name_id'] = $stepParentName ? $stepParentName->name_id : null;
            $fbData['father_in_law_name_id'] = $fatherInLawName ? $fatherInLawName->name_id : null;
            $fbData['mother_in_law_name_id'] = $motherInLawName ? $motherInLawName->name_id : null;
            $fbData['user_id'] = auth()->id();
            \Log::info('FamilyBackground validated data:', $fbData);
            $familyBackground = FamilyBackground::updateOrCreate(
                ['user_id' => auth()->id()],
                $fbData
            );
            \Log::info('FamilyBackground before save:', ['user_id' => auth()->id(), 'data' => $fbData]);
            // Save siblings (delete old, create new)
            if (isset($validated['siblings'])) {
                $familyBackground->siblings()->delete();
                foreach ($validated['siblings'] as $sibling) {
                    if (!empty($sibling['first_name']) || !empty($sibling['last_name'])) {
                        $siblingName = NameService::createOrFindName(
                            $sibling['first_name'] ?? null,
                            $sibling['last_name'] ?? null,
                            $sibling['middle_name'] ?? null
                        );
                        $familyBackground->siblings()->create([
                            'name_id' => $siblingName ? $siblingName->name_id : null,
                            'date_of_birth' => $sibling['date_of_birth'] ?? null,
                            'citizenship' => $sibling['citizenship'] ?? null,
                            'dual_citizenship' => $sibling['dual_citizenship'] ?? null,
                            'complete_address' => $sibling['complete_address'] ?? null,
                            'occupation' => $sibling['occupation'] ?? null,
                            'employer' => $sibling['employer'] ?? null,
                            'employer_address' => $sibling['employer_address'] ?? null,
                        ]);
                    }
                }
            }
            \Log::info('Siblings after save:', $familyBackground->siblings()->get()->toArray());
            \Log::info('FamilyBackground after save:', $familyBackground->toArray());
            $this->markSectionAsCompleted('family-background');
            $this->markSectionAsCompleted('family-history');
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Family background saved successfully']);
            }
            return redirect()->route('phs.educational-background')
                ->with('success', 'Family background and history saved successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your family background. Please try again.');
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