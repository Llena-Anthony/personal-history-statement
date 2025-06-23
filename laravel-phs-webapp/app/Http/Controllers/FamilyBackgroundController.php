<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

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

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.family-background', $data)->render();
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
        // Check if this is a save-only request (for dynamic navigation)
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
            ]);
        }

        try {
            // Add user_id to the validated data
            $validated['user_id'] = auth()->id();

            // Store in FamilyBackground model
            $familyBackground = \App\Models\FamilyBackground::updateOrCreate(
                ['user_id' => auth()->id()],
                $validated
            );

            // Save siblings (delete old, create new)
            if (isset($validated['siblings'])) {
                $familyBackground->siblings()->delete();
                foreach ($validated['siblings'] as $sibling) {
                    if (!empty($sibling['first_name']) || !empty($sibling['last_name'])) {
                        $familyBackground->siblings()->create([
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
                        ]);
                    }
                }
            }

            // Mark both family-background and family-history as completed
            $this->markSectionAsCompleted('family-background');
            $this->markSectionAsCompleted('family-history');
            
            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Family background saved successfully']);
            }
            
            return redirect()->route('phs.educational-background')
                ->with('success', 'Family background and history saved successfully!');
        } catch (\Exception $e) {
            if ($isSaveOnly) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            
            return back()->with('error', 'An error occurred while saving your family information. Please try again.');
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