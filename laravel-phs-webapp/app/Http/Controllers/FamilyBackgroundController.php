<?php

namespace App\Http\Controllers;

use App\Models\FamilyBackground;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyBackgroundController extends Controller
{
    public function create()
    {
        return view('phs.family-background');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Spouse fields are optional
            'spouse_first_name' => 'nullable|string|max:255',
            'spouse_middle_name' => 'nullable|string|max:255',
            'spouse_last_name' => 'nullable|string|max:255',
            'spouse_suffix' => 'nullable|string|max:255',
            'spouse_occupation' => 'nullable|string|max:255',
            'spouse_employer' => 'nullable|string|max:255',
            'spouse_business_address' => 'nullable|string|max:255',
            'spouse_telephone' => 'nullable|string|max:255',

            // Parent fields are required
            'father_first_name' => 'required|string|max:255',
            'father_middle_name' => 'required|string|max:255',
            'father_last_name' => 'required|string|max:255',
            'father_suffix' => 'nullable|string|max:255',
            'mother_first_name' => 'required|string|max:255',
            'mother_middle_name' => 'required|string|max:255',
            'mother_last_name' => 'required|string|max:255',
            'mother_suffix' => 'nullable|string|max:255',

            // Children are optional
            'children' => 'nullable|array',
            'children.*.full_name' => 'nullable|string|max:255',
            'children.*.date_of_birth' => 'nullable|date',
        ]);

        try {
            DB::beginTransaction();

            $familyBackground = FamilyBackground::create([
                'user_id' => auth()->id(),
                'spouse_first_name' => $validated['spouse_first_name'] ?? null,
                'spouse_middle_name' => $validated['spouse_middle_name'] ?? null,
                'spouse_last_name' => $validated['spouse_last_name'] ?? null,
                'spouse_suffix' => $validated['spouse_suffix'] ?? null,
                'spouse_occupation' => $validated['spouse_occupation'] ?? null,
                'spouse_employer' => $validated['spouse_employer'] ?? null,
                'spouse_business_address' => $validated['spouse_business_address'] ?? null,
                'spouse_telephone' => $validated['spouse_telephone'] ?? null,
                'father_first_name' => $validated['father_first_name'],
                'father_middle_name' => $validated['father_middle_name'],
                'father_last_name' => $validated['father_last_name'],
                'father_suffix' => $validated['father_suffix'] ?? null,
                'mother_first_name' => $validated['mother_first_name'],
                'mother_middle_name' => $validated['mother_middle_name'],
                'mother_last_name' => $validated['mother_last_name'],
                'mother_suffix' => $validated['mother_suffix'] ?? null,
            ]);

            // Create children records if provided
            if (!empty($validated['children'])) {
                foreach ($validated['children'] as $child) {
                    if (!empty($child['full_name']) && !empty($child['date_of_birth'])) {
                        $familyBackground->children()->create([
                            'full_name' => $child['full_name'],
                            'date_of_birth' => $child['date_of_birth'],
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('phs.educational-background.create')
                ->with('success', 'Family background information saved successfully. Please continue with your educational background.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while saving your family background information. Please try again.');
        }
    }
} 