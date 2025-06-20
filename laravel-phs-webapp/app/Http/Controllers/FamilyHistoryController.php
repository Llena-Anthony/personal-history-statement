<?php

namespace App\Http\Controllers;

use App\Models\FamilyHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyHistoryController extends Controller
{
    public function create()
    {
        return view('phs.family-history');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'father_first_name' => 'required|string|max:255',
            'father_middle_name' => 'nullable|string|max:255',
            'father_last_name' => 'required|string|max:255',
            'father_suffix' => 'nullable|string|max:255',
            'father_birth_date' => 'required|date',
            'father_birth_place' => 'required|string|max:255',
            'father_occupation' => 'required|string|max:255',
            'father_employer' => 'required|string|max:255',
            'father_employment_place' => 'required|string|max:255',
            'father_citizenship' => 'required|string|max:255',
            'father_other_citizenship' => 'nullable|string|max:255',
            'father_naturalization_date' => 'nullable|date',
            'father_naturalization_place' => 'nullable|string|max:255',
            'mother_first_name' => 'required|string|max:255',
            'mother_middle_name' => 'nullable|string|max:255',
            'mother_last_name' => 'required|string|max:255',
            'mother_suffix' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $familyHistory = FamilyHistory::create($validated);

            DB::commit();

            return redirect()->route('phs.educational-background')
                ->with('success', 'Family history information saved successfully. Please continue with your educational background.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while saving your family history. Please try again.');
        }
    }
} 