<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaritalStatusController extends Controller
{
    public function create()
    {
        return view('phs.marital-status');
    }

    public function store(Request $request)
    {
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

        try {
            DB::beginTransaction();

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

            if (isset($validated['children'])) {
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

            DB::commit();

            return redirect()->route('phs.family-background.create')
                ->with('success', 'Marital status saved successfully. Please continue with your family history.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while saving your marital status information. Please try again.');
        }
    }
} 