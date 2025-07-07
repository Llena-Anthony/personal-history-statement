<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Services\NameService;
use App\Models\FamilyHistoryDetail;
use App\Models\FamilyMember;

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
        $familyBackground = FamilyHistoryDetail::where('username', auth()->user()->username)
            ->with(['fatherName', 'motherName', 'spouseName', 'stepParentGuardianName', 'fatherInLawName', 'motherInLawName'])
            ->first();

        \Log::info('FamilyBackground create method called', [
            'user_id' => auth()->id(),
            'family_background_found' => $familyBackground ? true : false,
            'is_ajax' => request()->ajax()
        ]);

        if ($familyBackground) {
            $data['familyBackground'] = $familyBackground;

            // Load family members from the family_members table
            $familyMembers = FamilyMember::where('username', auth()->user()->username)
                ->with('nameDetails')
                ->get()
                ->keyBy('role');

            \Log::info('Family members loaded', [
                'count' => $familyMembers->count(),
                'roles' => $familyMembers->keys()->toArray()
            ]);

            // Set the name data for each family member
            $data['fatherName'] = $familyMembers->get('father')?->nameDetails;
            $data['motherName'] = $familyMembers->get('mother')?->nameDetails;
            $data['spouseName'] = $familyMembers->get('spouse')?->nameDetails;
            $data['stepParentGuardianName'] = $familyMembers->get('step_parent_guardian')?->nameDetails;
            $data['fatherInLawName'] = $familyMembers->get('father_in_law')?->nameDetails;
            $data['motherInLawName'] = $familyMembers->get('mother_in_law')?->nameDetails;

            // Load related data
            $data['siblings'] = $familyBackground->siblings()->with('name')->get();
            $data['family_members'] = $familyMembers;

            \Log::info('Data loaded for form', [
                'father_name' => $data['fatherName'] ? $data['fatherName']->first_name : null,
                'mother_name' => $data['motherName'] ? $data['motherName']->first_name : null,
                'siblings_count' => $data['siblings']->count(),
                'family_members_count' => $data['family_members']->count()
            ]);
        } else {
            // Initialize empty name objects to prevent errors
            $data['familyBackground'] = null;
            $data['fatherName'] = null;
            $data['motherName'] = null;
            $data['spouseName'] = null;
            $data['stepParentGuardianName'] = null;
            $data['fatherInLawName'] = null;
            $data['motherInLawName'] = null;
            $data['siblings'] = collect();
            $data['family_members'] = collect();

            \Log::info('No family background found, using empty data');
        }

        // For both AJAX and normal requests, return the full section view
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

        // Capitalize names for all family members
        foreach ([
                'father', 'mother', 'step_parent_guardian', 'father_in_law', 'mother_in_law'
        ] as $role) {
            foreach (['first_name', 'middle_name', 'last_name'] as $part) {
                $key = $role . '_' . $part;
                if (isset($validated[$key]) && $validated[$key]) {
                    $validated[$key] = ucwords(strtolower($validated[$key]));
                }
            }
        }

            // Create or find NameDetails for each family member
            $fatherName = null;
            if (!empty($validated['father_first_name']) || !empty($validated['father_last_name'])) {
            $fatherName = NameService::createOrFindName(
                $validated['father_first_name'] ?? null,
                $validated['father_last_name'] ?? null,
                $validated['father_middle_name'] ?? null,
                null,
                $validated['father_suffix'] ?? null
            );
            }
            $motherName = null;
            if (!empty($validated['mother_first_name']) || !empty($validated['mother_last_name'])) {
            $motherName = NameService::createOrFindName(
                $validated['mother_first_name'] ?? null,
                $validated['mother_last_name'] ?? null,
                $validated['mother_middle_name'] ?? null,
                null,
                $validated['mother_suffix'] ?? null
            );
            }
            $stepParentName = null;
            if (!empty($validated['step_parent_guardian_first_name']) || !empty($validated['step_parent_guardian_last_name'])) {
            $stepParentName = NameService::createOrFindName(
                $validated['step_parent_guardian_first_name'] ?? null,
                $validated['step_parent_guardian_last_name'] ?? null,
                $validated['step_parent_guardian_middle_name'] ?? null,
                null,
                $validated['step_parent_guardian_suffix'] ?? null
            );
            }
            $fatherInLawName = null;
            if (!empty($validated['father_in_law_first_name']) || !empty($validated['father_in_law_last_name'])) {
            $fatherInLawName = NameService::createOrFindName(
                $validated['father_in_law_first_name'] ?? null,
                $validated['father_in_law_last_name'] ?? null,
                $validated['father_in_law_middle_name'] ?? null,
                null,
                $validated['father_in_law_suffix'] ?? null
            );
            }
            $motherInLawName = null;
            if (!empty($validated['mother_in_law_first_name']) || !empty($validated['mother_in_law_last_name'])) {
            $motherInLawName = NameService::createOrFindName(
                $validated['mother_in_law_first_name'] ?? null,
                $validated['mother_in_law_last_name'] ?? null,
                $validated['mother_in_law_middle_name'] ?? null,
                null,
                $validated['mother_in_law_suffix'] ?? null
            );
            }

            // Save only the fields that exist in family_backgrounds (foreign keys and summary fields only)
            $fbData = [
                'user_id' => auth()->id(),
                'father_name_id' => $fatherName ? $fatherName->name_id : null,
                'mother_name_id' => $motherName ? $motherName->name_id : null,
                'spouse_name_id' => null, // Spouse name is not provided in the form
                'step_parent_guardian_name_id' => $stepParentName ? $stepParentName->name_id : null,
                'father_in_law_name_id' => $fatherInLawName ? $fatherInLawName->name_id : null,
                'mother_in_law_name_id' => $motherInLawName ? $motherInLawName->name_id : null,
                'father_suffix' => $validated['father_suffix'] ?? null,
                'father_complete_address' => $validated['father_complete_address'] ?? null,
                'mother_complete_address' => $validated['mother_complete_address'] ?? null,
                'spouse_suffix' => null, // Spouse suffix is not provided in the form
                'spouse_occupation' => null, // Spouse occupation is not provided in the form
                'spouse_employer' => null, // Spouse employer is not provided in the form
                'spouse_business_address' => null, // Spouse business address is not provided in the form
                'spouse_telephone' => null, // Not in form
            ];
            $familyBackground = FamilyBackground::updateOrCreate(
                ['user_id' => auth()->id()],
                $fbData
            );
            \Log::info('FamilyBackground saved', ['family_background_id' => $familyBackground->id]);

            // Save family members to the new family_members table
            $familyMembers = [];
            // Father
            if ($fatherName) {
                $familyMembers[] = [
                    'user_id' => auth()->id(),
                    'name_id' => $fatherName->name_id,
                    'role' => 'father',
                    'birth_id' => null, // Not handling birth details in this refactor
                    'birth_date' => $validated['father_birth_date'] ?? null,
                    'birth_place' => $validated['father_birth_place'] ?? null,
                    'occupation' => $validated['father_occupation'] ?? null,
                    'employer' => $validated['father_employer'] ?? null,
                    'place_of_employment' => $validated['father_place_of_employment'] ?? null,
                    'complete_address' => $validated['father_complete_address'] ?? null,
                    'citizenship_type' => $validated['father_citizenship_type'] ?? null,
                    'citizenship' => $validated['father_citizenship'] ?? null,
                    'citizenship_dual_1' => $validated['father_citizenship_dual_1'] ?? null,
                    'citizenship_dual_2' => $validated['father_citizenship_dual_2'] ?? null,
                    'citizenship_naturalized' => $validated['father_citizenship_naturalized'] ?? null,
                    'naturalized_month' => $validated['father_naturalized_month'] ?? null,
                    'naturalized_year' => $validated['father_naturalized_year'] ?? null,
                    'naturalized_place' => $validated['father_naturalized_place'] ?? null,
                    'isnaturalized' => ($validated['father_citizenship_type'] === 'Naturalized') ? 1 : 0,
                    'naturalized_details' => $validated['father_naturalized_details'] ?? null,
                ];
            }
            // Mother
            if ($motherName) {
                $familyMembers[] = [
                    'user_id' => auth()->id(),
                    'name_id' => $motherName->name_id,
                    'role' => 'mother',
                    'birth_id' => null,
                    'birth_date' => $validated['mother_birth_date'] ?? null,
                    'birth_place' => $validated['mother_birth_place'] ?? null,
                    'occupation' => $validated['mother_occupation'] ?? null,
                    'employer' => $validated['mother_employer'] ?? null,
                    'place_of_employment' => $validated['mother_place_of_employment'] ?? null,
                    'complete_address' => $validated['mother_complete_address'] ?? null,
                    'citizenship_type' => $validated['mother_citizenship_type'] ?? null,
                    'citizenship' => $validated['mother_citizenship'] ?? null,
                    'citizenship_dual_1' => $validated['mother_citizenship_dual_1'] ?? null,
                    'citizenship_dual_2' => $validated['mother_citizenship_dual_2'] ?? null,
                    'citizenship_naturalized' => $validated['mother_citizenship_naturalized'] ?? null,
                    'naturalized_month' => $validated['mother_naturalized_month'] ?? null,
                    'naturalized_year' => $validated['mother_naturalized_year'] ?? null,
                    'naturalized_place' => $validated['mother_naturalized_place'] ?? null,
                    'isnaturalized' => ($validated['mother_citizenship_type'] === 'Naturalized') ? 1 : 0,
                    'naturalized_details' => $validated['mother_naturalized_details'] ?? null,
                    'suffix' => $validated['mother_suffix'] ?? null,
                ];
            }
            // Step-parent or Guardian
            if ($stepParentName) {
                $familyMembers[] = [
                    'user_id' => auth()->id(),
                    'name_id' => $stepParentName->name_id,
                    'role' => 'step_parent_guardian',
                    'birth_id' => null,
                    'birth_date' => $validated['step_parent_guardian_birth_date'] ?? null,
                    'birth_place' => $validated['step_parent_guardian_birth_place'] ?? null,
                    'occupation' => $validated['step_parent_guardian_occupation'] ?? null,
                    'employer' => $validated['step_parent_guardian_employer'] ?? null,
                    'place_of_employment' => $validated['step_parent_guardian_place_of_employment'] ?? null,
                    'complete_address' => $validated['step_parent_guardian_complete_address'] ?? null,
                    'citizenship_type' => $validated['step_parent_guardian_citizenship_type'] ?? null,
                    'citizenship' => $validated['step_parent_guardian_citizenship'] ?? null,
                    'citizenship_dual_1' => $validated['step_parent_guardian_citizenship_dual_1'] ?? null,
                    'citizenship_dual_2' => $validated['step_parent_guardian_citizenship_dual_2'] ?? null,
                    'citizenship_naturalized' => $validated['step_parent_guardian_citizenship_naturalized'] ?? null,
                    'naturalized_month' => $validated['step_parent_guardian_naturalized_month'] ?? null,
                    'naturalized_year' => $validated['step_parent_guardian_naturalized_year'] ?? null,
                    'naturalized_place' => $validated['step_parent_guardian_naturalized_place'] ?? null,
                    'isnaturalized' => ($validated['step_parent_guardian_citizenship_type'] === 'Naturalized') ? 1 : 0,
                    'naturalized_details' => $validated['step_parent_guardian_naturalized_details'] ?? null,
                    'suffix' => $validated['step_parent_guardian_suffix'] ?? null,
                ];
            }
            // Father-in-law
            if ($fatherInLawName) {
                $familyMembers[] = [
                    'user_id' => auth()->id(),
                    'name_id' => $fatherInLawName->name_id,
                    'role' => 'father_in_law',
                    'birth_id' => null,
                    'birth_date' => $validated['father_in_law_birth_date'] ?? null,
                    'birth_place' => $validated['father_in_law_birth_place'] ?? null,
                    'occupation' => $validated['father_in_law_occupation'] ?? null,
                    'employer' => $validated['father_in_law_employer'] ?? null,
                    'place_of_employment' => $validated['father_in_law_place_of_employment'] ?? null,
                    'complete_address' => $validated['father_in_law_complete_address'] ?? null,
                    'citizenship_type' => $validated['father_in_law_citizenship_type'] ?? null,
                    'citizenship' => $validated['father_in_law_citizenship'] ?? null,
                    'citizenship_dual_1' => $validated['father_in_law_citizenship_dual_1'] ?? null,
                    'citizenship_dual_2' => $validated['father_in_law_citizenship_dual_2'] ?? null,
                    'citizenship_naturalized' => $validated['father_in_law_citizenship_naturalized'] ?? null,
                    'naturalized_month' => $validated['father_in_law_naturalized_month'] ?? null,
                    'naturalized_year' => $validated['father_in_law_naturalized_year'] ?? null,
                    'naturalized_place' => $validated['father_in_law_naturalized_place'] ?? null,
                    'isnaturalized' => ($validated['father_in_law_citizenship_type'] === 'Naturalized') ? 1 : 0,
                    'naturalized_details' => $validated['father_in_law_naturalized_details'] ?? null,
                    'suffix' => $validated['father_in_law_suffix'] ?? null,
                ];
            }
            // Mother-in-law
            if ($motherInLawName) {
                $familyMembers[] = [
                    'user_id' => auth()->id(),
                    'name_id' => $motherInLawName->name_id,
                    'role' => 'mother_in_law',
                    'birth_id' => null,
                    'birth_date' => $validated['mother_in_law_birth_date'] ?? null,
                    'birth_place' => $validated['mother_in_law_birth_place'] ?? null,
                    'occupation' => $validated['mother_in_law_occupation'] ?? null,
                    'employer' => $validated['mother_in_law_employer'] ?? null,
                    'place_of_employment' => $validated['mother_in_law_place_of_employment'] ?? null,
                    'complete_address' => $validated['mother_in_law_complete_address'] ?? null,
                    'citizenship_type' => $validated['mother_in_law_citizenship_type'] ?? null,
                    'citizenship' => $validated['mother_in_law_citizenship'] ?? null,
                    'citizenship_dual_1' => $validated['mother_in_law_citizenship_dual_1'] ?? null,
                    'citizenship_dual_2' => $validated['mother_in_law_citizenship_dual_2'] ?? null,
                    'citizenship_naturalized' => $validated['mother_in_law_citizenship_naturalized'] ?? null,
                    'naturalized_month' => $validated['mother_in_law_naturalized_month'] ?? null,
                    'naturalized_year' => $validated['mother_in_law_naturalized_year'] ?? null,
                    'naturalized_place' => $validated['mother_in_law_naturalized_place'] ?? null,
                    'isnaturalized' => ($validated['mother_in_law_citizenship_type'] === 'Naturalized') ? 1 : 0,
                    'naturalized_details' => $validated['mother_in_law_naturalized_details'] ?? null,
                    'suffix' => $validated['mother_in_law_suffix'] ?? null,
                ];
            }
            // Delete existing family members and create new ones
            if (!empty($familyMembers)) {
                \App\Models\FamilyMember::where('user_id', auth()->id())->delete();
                foreach ($familyMembers as $memberData) {
                    \App\Models\FamilyMember::create($memberData);
                }
            }
            \Log::info('Family members saved', ['count' => count($familyMembers)]);

            // Save siblings (delete old, create new)
            if (isset($validated['siblings'])) {
                $familyBackground->siblings()->delete();
                foreach ($validated['siblings'] as $index => $sibling) {
                    if (!empty($sibling['first_name']) || !empty($sibling['last_name'])) {
                        \Log::info('Processing sibling', ['index' => $index, 'sibling_data' => $sibling]);

                        $siblingName = \App\Services\NameService::createOrFindName(
                            $sibling['first_name'] ?? null,
                            $sibling['last_name'] ?? null,
                            $sibling['middle_name'] ?? null
                        );

                        $siblingData = [
                            'name_id' => $siblingName ? $siblingName->name_id : null,
                            'first_name' => $sibling['first_name'] ?? null,
                            'middle_name' => $sibling['middle_name'] ?? null,
                            'last_name' => $sibling['last_name'] ?? null,
                            'date_of_birth' => $sibling['date_of_birth'] ?? null,
                            'citizenship' => $sibling['citizenship'] ?? null,
                            'dual_citizenship' => $sibling['dual_citizenship'] ?? null,
                            'complete_address' => $sibling['complete_address'] ?? null,
                            'occupation' => $sibling['occupation'] ?? null,
                            'employer' => $sibling['employer'] ?? null,
                            'employer_address' => $sibling['employer_address'] ?? null,
                        ];

                        \Log::info('Creating sibling with data', ['sibling_data' => $siblingData]);

                        $createdSibling = $familyBackground->siblings()->create($siblingData);

                        \Log::info('Sibling created', ['sibling_id' => $createdSibling->id, 'date_of_birth' => $createdSibling->date_of_birth]);
                    }
                }
            }
            \Log::info('Siblings saved', ['count' => isset($validated['siblings']) ? count($validated['siblings']) : 0]);

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
