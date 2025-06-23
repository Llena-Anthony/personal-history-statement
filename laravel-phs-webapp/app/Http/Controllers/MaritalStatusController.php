<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\PHSSectionTracking;

class MaritalStatusController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $data = $this->getCommonViewData('marital-status');

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.marital-status', $data)->render();
        }

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
                'children.*.citizenship_address' => 'nullable|string|max:255',
                'children.*.parent_name' => 'nullable|string|max:255',
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
                'children.*.citizenship_address' => 'nullable|string|max:255',
                'children.*.parent_name' => 'nullable|string|max:255',
            ]);
        }

        try {
            DB::beginTransaction();

            // Check if marital status already exists for this user
            $maritalStatus = MaritalStatus::where('user_id', auth()->id())->first();
            
            if ($maritalStatus) {
                // Update existing marital status
                $maritalStatus->update([
                    'marital_status' => $validated['marital_status'],
                    'spouse_first_name' => $validated['spouse_first_name'] ?? null,
                    'spouse_middle_name' => $validated['spouse_middle_name'] ?? null,
                    'spouse_last_name' => $validated['spouse_last_name'] ?? null,
                    'spouse_suffix' => $validated['spouse_suffix'] ?? null,
                    'marriage_date' => $validated['marriage_date'] ?? null,
                    'marriage_place' => $validated['marriage_place'] ?? null,
                    'spouse_birth_date' => $validated['spouse_birth_date'] ?? null,
                    'spouse_birth_place' => $validated['spouse_birth_place'] ?? null,
                    'spouse_occupation' => $validated['spouse_occupation'] ?? null,
                    'spouse_employer' => $validated['spouse_employer'] ?? null,
                    'spouse_employment_place' => $validated['spouse_employment_place'] ?? null,
                    'spouse_contact' => $validated['spouse_contact'] ?? null,
                    'spouse_citizenship' => $validated['spouse_citizenship'] ?? null,
                    'spouse_other_citizenship' => $validated['spouse_other_citizenship'] ?? null,
                ]);
            } else {
                // Create new marital status
                $maritalStatus = MaritalStatus::create([
                    'user_id' => auth()->id(),
                    'marital_status' => $validated['marital_status'],
                    'spouse_first_name' => $validated['spouse_first_name'] ?? null,
                    'spouse_middle_name' => $validated['spouse_middle_name'] ?? null,
                    'spouse_last_name' => $validated['spouse_last_name'] ?? null,
                    'spouse_suffix' => $validated['spouse_suffix'] ?? null,
                    'marriage_date' => $validated['marriage_date'] ?? null,
                    'marriage_place' => $validated['marriage_place'] ?? null,
                    'spouse_birth_date' => $validated['spouse_birth_date'] ?? null,
                    'spouse_birth_place' => $validated['spouse_birth_place'] ?? null,
                    'spouse_occupation' => $validated['spouse_occupation'] ?? null,
                    'spouse_employer' => $validated['spouse_employer'] ?? null,
                    'spouse_employment_place' => $validated['spouse_employment_place'] ?? null,
                    'spouse_contact' => $validated['spouse_contact'] ?? null,
                    'spouse_citizenship' => $validated['spouse_citizenship'] ?? null,
                    'spouse_other_citizenship' => $validated['spouse_other_citizenship'] ?? null,
                ]);
            }

            if (isset($validated['children'])) {
                // Delete existing children and recreate
                $maritalStatus->children()->delete();
                
                foreach ($validated['children'] as $childData) {
                    if (!empty($childData['name'])) {
                        $maritalStatus->children()->create([
                            'name' => $childData['name'],
                            'birth_date' => $childData['birth_date'],
                            'citizenship_address' => $childData['citizenship_address'],
                            'parent_name' => $childData['parent_name'],
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