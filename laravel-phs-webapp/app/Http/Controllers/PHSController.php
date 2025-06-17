<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PHS;
use Illuminate\Support\Facades\DB;

class PHSController extends Controller
{
    public function create()
    {
        return view('phs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'civil_status' => 'required|string|in:Single,Married,Widowed,Separated',
            'height' => 'nullable|string|max:10',
            'weight' => 'nullable|string|max:10',
            'blood_type' => 'nullable|string|max:5',
            'gsis_id' => 'nullable|string|max:50',
            'philhealth_no' => 'nullable|string|max:50',
            'tin_no' => 'nullable|string|max:50',
            'pagibig_id' => 'nullable|string|max:50',
            'sss_no' => 'nullable|string|max:50',
            'agency_employee_no' => 'nullable|string|max:50',
            'citizenship' => 'required|string|in:Filipino,Dual Citizenship',
            'dual_citizenship_by_birth' => 'nullable|boolean',
            'dual_citizenship_by_naturalization' => 'nullable|boolean',
            'dual_citizenship_country' => 'nullable|string|max:100',
            'residential_house_no' => 'nullable|string|max:50',
            'residential_street' => 'nullable|string|max:255',
            'residential_subdivision' => 'nullable|string|max:255',
            'residential_barangay' => 'nullable|string|max:255',
            'residential_city' => 'nullable|string|max:255',
            'residential_province' => 'nullable|string|max:255',
            'residential_zip' => 'nullable|string|max:10',
            'permanent_house_no' => 'nullable|string|max:50',
            'permanent_street' => 'nullable|string|max:255',
            'permanent_subdivision' => 'nullable|string|max:255',
            'permanent_barangay' => 'nullable|string|max:255',
            'permanent_city' => 'nullable|string|max:255',
            'permanent_province' => 'nullable|string|max:255',
            'permanent_zip' => 'nullable|string|max:10',
            'telephone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        try {
            DB::beginTransaction();

            $phs = PHS::create([
                'user_id' => auth()->id(),
                ...$validated
            ]);

            DB::commit();

            return redirect()->route('phs.personal-characteristics.create')
                ->with('success', 'Personal information saved successfully. Please continue with your personal characteristics.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while saving your personal information. Please try again.');
        }
    }

    public function edit(PHS $phs)
    {
        return view('phs.edit', compact('phs'));
    }

    public function update(Request $request, PHS $phs)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'civil_status' => 'required|string|in:Single,Married,Widowed,Separated',
            'height' => 'nullable|string|max:10',
            'weight' => 'nullable|string|max:10',
            'blood_type' => 'nullable|string|max:5',
            'gsis_id' => 'nullable|string|max:50',
            'philhealth_no' => 'nullable|string|max:50',
            'tin_no' => 'nullable|string|max:50',
            'pagibig_id' => 'nullable|string|max:50',
            'sss_no' => 'nullable|string|max:50',
            'agency_employee_no' => 'nullable|string|max:50',
            'citizenship' => 'required|string|in:Filipino,Dual Citizenship',
            'dual_citizenship_by_birth' => 'nullable|boolean',
            'dual_citizenship_by_naturalization' => 'nullable|boolean',
            'dual_citizenship_country' => 'nullable|string|max:100',
            'residential_house_no' => 'nullable|string|max:50',
            'residential_street' => 'nullable|string|max:255',
            'residential_subdivision' => 'nullable|string|max:255',
            'residential_barangay' => 'nullable|string|max:255',
            'residential_city' => 'nullable|string|max:255',
            'residential_province' => 'nullable|string|max:255',
            'residential_zip' => 'nullable|string|max:10',
            'permanent_house_no' => 'nullable|string|max:50',
            'permanent_street' => 'nullable|string|max:255',
            'permanent_subdivision' => 'nullable|string|max:255',
            'permanent_barangay' => 'nullable|string|max:255',
            'permanent_city' => 'nullable|string|max:255',
            'permanent_province' => 'nullable|string|max:255',
            'permanent_zip' => 'nullable|string|max:10',
            'telephone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $phs->update($validated);

        return redirect()->route('phs.edit', $phs->id)
            ->with('success', 'Personal History Statement updated successfully.');
    }
} 