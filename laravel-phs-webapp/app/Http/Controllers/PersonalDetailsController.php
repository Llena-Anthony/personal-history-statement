<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalDetailsController extends Controller
{
    public function create()
    {
        return view('phs.personal-details');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'civil_status' => 'required|in:single,married,widowed,separated',
            'citizenship' => 'required|string|max:255',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'blood_type' => 'required|string|max:10',
            'gsis_id' => 'nullable|string|max:255',
            'pagibig_id' => 'nullable|string|max:255',
            'philhealth_id' => 'nullable|string|max:255',
            'sss_id' => 'nullable|string|max:255',
            'tin' => 'nullable|string|max:255',
            'agency_employee_no' => 'nullable|string|max:255',
            'residential_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'telephone_no' => 'nullable|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Store the personal details
        // TODO: Implement the storage logic

        return redirect()->route('phs.marital-status.create')
            ->with('success', 'Personal details saved successfully.');
    }
} 