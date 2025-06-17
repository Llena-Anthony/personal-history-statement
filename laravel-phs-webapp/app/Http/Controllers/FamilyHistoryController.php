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
            'father_last_name' => 'required|string|max:255',
            'father_first_name' => 'required|string|max:255',
            'father_middle_name' => 'nullable|string|max:255',
            'father_occupation' => 'required|string|max:255',
            'father_employer' => 'required|string|max:255',
            'father_business_address' => 'required|string|max:255',
            'father_telephone' => 'nullable|string|max:20',

            'mother_last_name' => 'required|string|max:255',
            'mother_first_name' => 'required|string|max:255',
            'mother_middle_name' => 'nullable|string|max:255',
            'mother_occupation' => 'required|string|max:255',
            'mother_employer' => 'required|string|max:255',
            'mother_business_address' => 'required|string|max:255',
            'mother_telephone' => 'nullable|string|max:20',

            'spouse_last_name' => 'nullable|string|max:255',
            'spouse_first_name' => 'nullable|string|max:255',
            'spouse_middle_name' => 'nullable|string|max:255',
            'spouse_occupation' => 'nullable|string|max:255',
            'spouse_employer' => 'nullable|string|max:255',
            'spouse_business_address' => 'nullable|string|max:255',
            'spouse_telephone' => 'nullable|string|max:20',
        ]);

        try {
            DB::beginTransaction();

            $familyHistory = FamilyHistory::create([
                'user_id' => auth()->id(),
                'father_last_name' => $validated['father_last_name'],
                'father_first_name' => $validated['father_first_name'],
                'father_middle_name' => $validated['father_middle_name'],
                'father_occupation' => $validated['father_occupation'],
                'father_employer' => $validated['father_employer'],
                'father_business_address' => $validated['father_business_address'],
                'father_telephone' => $validated['father_telephone'],

                'mother_last_name' => $validated['mother_last_name'],
                'mother_first_name' => $validated['mother_first_name'],
                'mother_middle_name' => $validated['mother_middle_name'],
                'mother_occupation' => $validated['mother_occupation'],
                'mother_employer' => $validated['mother_employer'],
                'mother_business_address' => $validated['mother_business_address'],
                'mother_telephone' => $validated['mother_telephone'],

                'spouse_last_name' => $validated['spouse_last_name'],
                'spouse_first_name' => $validated['spouse_first_name'],
                'spouse_middle_name' => $validated['spouse_middle_name'],
                'spouse_occupation' => $validated['spouse_occupation'],
                'spouse_employer' => $validated['spouse_employer'],
                'spouse_business_address' => $validated['spouse_business_address'],
                'spouse_telephone' => $validated['spouse_telephone'],
            ]);

            DB::commit();

            return redirect()->route('phs.educational-background.create')
                ->with('success', 'Family history saved successfully. Please continue with your educational background.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while saving your family history. Please try again.');
        }
    }
} 