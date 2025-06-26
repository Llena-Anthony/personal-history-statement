<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use App\Models\FamilyBackground;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\PHSSectionTracking;
use App\Services\NameService;

class MaritalStatusController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $data = $this->getCommonViewData('marital-status');

        // Load existing marital status data
        $maritalStatus = MaritalStatus::where('user_id', auth()->id())->first();
        if ($maritalStatus) {
            $data['maritalStatus'] = $maritalStatus;
            
            // Load spouse name details
            if ($maritalStatus->spouseName) {
                $data['spouseName'] = $maritalStatus->spouseName;
            }
        }

        // Load existing family background data for children
        $familyBackground = FamilyBackground::where('user_id', auth()->id())->first();
        if ($familyBackground) {
            $data['children'] = $familyBackground->children()->with('nameDetails')->get();
        }

        // Check if it's an AJAX request
        if (request()->ajax()) {
            // Return only the partial content for AJAX
            return view('phs.sections.marital-status-content', $data);
        }

        // Return the full view (with layout) for normal requests
        return view('phs.marital-status', $data);
    }

    public function store(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'marital_status' => 'nullable|in:Single,Married,Widowed,Separated',
                'spouse_first_name' => 'nullable|string|max:255',
                'spouse_middle_name' => 'nullable|string|max:255',
                'spouse_last_name' => 'nullable|string|max:255',
                'spouse_suffix' => 'nullable|string|max:10',
                'marriage_date' => 'nullable|date',
                'marriage_date_type' => 'nullable|in:exact,month_year',
                'marriage_month' => 'nullable|string|max:2',
                'marriage_year' => 'nullable|integer|min:1900|max:2030',
                'marriage_place' => 'nullable|string|max:255',
                'spouse_birth_date' => 'nullable|date',
                'spouse_birth_place' => 'nullable|string|max:255',
                'spouse_occupation' => 'nullable|string|max:255',
                'spouse_employer' => 'nullable|string|max:255',
                'spouse_employment_place' => 'nullable|string|max:255',
                'spouse_contact' => 'nullable|string|max:20',
                'spouse_citizenship' => 'nullable|string|max:100',
                'spouse_other_citizenship' => 'nullable|string|max:100',
                'children' => 'nullable|array',
                'children.*.name' => 'nullable|string|max:255',
                'children.*.birth_date' => 'nullable|date',
                'children.*.citizenship' => 'nullable|string|max:255',
                'children.*.address' => 'nullable|string|max:255',
                'children.*.father_name' => 'nullable|string|max:255',
                'children.*.mother_name' => 'nullable|string|max:255',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'marital_status' => 'required|in:Single,Married,Widowed,Separated',
                'spouse_first_name' => 'nullable|required_if:marital_status,Married|string|max:255',
                'spouse_middle_name' => 'nullable|string|max:255',
                'spouse_last_name' => 'nullable|required_if:marital_status,Married|string|max:255',
                'spouse_suffix' => 'nullable|string|max:10',
                'marriage_date' => 'nullable|required_if:marital_status,Married|date',
                'marriage_date_type' => 'nullable|required_if:marital_status,Married|in:exact,month_year',
                'marriage_month' => 'nullable|required_if:marriage_date_type,month_year|string|max:2',
                'marriage_year' => 'nullable|required_if:marriage_date_type,month_year|integer|min:1900|max:2030',
                'marriage_place' => 'nullable|required_if:marital_status,Married|string|max:255',
                'spouse_birth_date' => 'nullable|required_if:marital_status,Married|date',
                'spouse_birth_place' => 'nullable|required_if:marital_status,Married|string|max:255',
                'spouse_occupation' => 'nullable|string|max:255',
                'spouse_employer' => 'nullable|string|max:255',
                'spouse_employment_place' => 'nullable|string|max:255',
                'spouse_contact' => 'nullable|string|max:20',
                'spouse_citizenship' => 'nullable|required_if:marital_status,Married|string|max:100',
                'spouse_other_citizenship' => 'nullable|string|max:100',
                'children' => 'nullable|array',
                'children.*.name' => 'nullable|string|max:255',
                'children.*.birth_date' => 'nullable|date',
                'children.*.citizenship' => 'nullable|string|max:255',
                'children.*.address' => 'nullable|string|max:255',
                'children.*.father_name' => 'nullable|string|max:255',
                'children.*.mother_name' => 'nullable|string|max:255',
            ]);
        }

        // Capitalize spouse name
        foreach (['spouse_first_name', 'spouse_middle_name', 'spouse_last_name'] as $part) {
            if (isset($validated[$part]) && $validated[$part]) {
                $validated[$part] = ucwords(strtolower($validated[$part]));
            }
        }

        // Process marriage date based on date type
        if (isset($validated['marriage_date_type'])) {
            if ($validated['marriage_date_type'] === 'month_year') {
                // Clear exact date when using month/year
                $validated['marriage_date'] = null;
            } else {
                // Clear month/year when using exact date
                $validated['marriage_month'] = null;
                $validated['marriage_year'] = null;
            }
        }

        try {
            DB::beginTransaction();

            // Create or find NameDetails for spouse
            $spouseName = NameService::createOrFindName(
                $validated['spouse_first_name'] ?? null,
                $validated['spouse_last_name'] ?? null,
                $validated['spouse_middle_name'] ?? null,
                null,
                $validated['spouse_suffix'] ?? null
            );
            $maritalData = $validated;
            unset($maritalData['spouse_first_name'], $maritalData['spouse_middle_name'], $maritalData['spouse_last_name']);
            $maritalData['spouse_name_id'] = $spouseName ? $spouseName->name_id : null;
            $maritalData['user_id'] = auth()->id();
            $maritalStatus = MaritalStatus::where('user_id', auth()->id())->first();
            if ($maritalStatus) {
                $maritalStatus->update($maritalData);
            } else {
                $maritalStatus = MaritalStatus::create($maritalData);
            }

            if (isset($validated['children'])) {
                $familyBackground = FamilyBackground::firstOrCreate(
                    ['user_id' => auth()->id()],
                    ['user_id' => auth()->id()]
                );
                $familyBackground->children()->delete();
                foreach ($validated['children'] as $childData) {
                    if (!empty($childData['name'])) {
                        $childNameParts = NameService::parseFullName($childData['name']);
                        $childName = NameService::createOrFindName(
                            $childNameParts['first_name'],
                            $childNameParts['last_name'],
                            $childNameParts['middle_name']
                        );
                        $familyBackground->children()->create([
                            'name_id' => $childName ? $childName->name_id : null,
                            'birth_date' => $childData['birth_date'],
                            'citizenship_address' => $childData['citizenship'] ?? null,
                            'address' => $childData['address'] ?? null,
                            'father_name' => $childData['father_name'] ?? null,
                            'mother_name' => $childData['mother_name'] ?? null,
                        ]);
                    }
                }
            }

            // Mark marital status as completed
            $this->markSectionAsCompleted('marital-status');

            DB::commit();

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Marital status saved successfully']);
            }

            return redirect()->route('phs.family-background.create')
                ->with('success', 'Marital status saved successfully. Please continue with your family history.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($isSaveOnly) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            
            return back()->with('error', 'An error occurred while saving your marital status information. Please try again.');
        }
    }
} 