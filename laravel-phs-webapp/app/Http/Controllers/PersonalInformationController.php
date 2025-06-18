<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PersonalInformationController extends Controller
{
    public function create()
    {
        return view('phs.create', [
            'progress' => 0
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate the request data
            $validated = $request->validate([
                'last_name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'name_extension' => 'nullable|string|max:255',
                'date_of_birth' => 'required|date',
                'place_of_birth' => 'required|string|max:255',
                'sex' => 'required|in:male,female',
                'civil_status' => 'required|in:single,married,widowed,separated',
                'height' => 'required|numeric',
                'weight' => 'required|numeric',
                'blood_type' => 'required|string|max:10',
                'gsis_id_no' => 'nullable|string|max:255',
                'pag_ibig_id_no' => 'nullable|string|max:255',
                'philhealth_no' => 'nullable|string|max:255',
                'sss_no' => 'nullable|string|max:255',
                'tin' => 'nullable|string|max:255',
                'agency_employee_no' => 'nullable|string|max:255',
                'citizenship' => 'required|string|max:255',
                'dual_citizenship' => 'required|boolean',
                'dual_citizenship_country' => 'required_if:dual_citizenship,true|nullable|string|max:255',
                'residential_address' => 'required|string|max:255',
                'residential_zip_code' => 'required|string|max:10',
                'residential_tel_no' => 'nullable|string|max:20',
                'permanent_address' => 'required|string|max:255',
                'permanent_zip_code' => 'required|string|max:10',
                'permanent_tel_no' => 'nullable|string|max:20',
                'email' => 'required|email|max:255',
                'cellphone_no' => 'required|string|max:20',
            ]);

            // Store the data
            DB::table('personal_information')->updateOrInsert(
                ['user_id' => auth()->id()],
                array_merge($validated, ['user_id' => auth()->id()])
            );

            DB::commit();

            return redirect()->route('phs.family-background.create')
                ->with('success', 'Personal information saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving personal information: ' . $e->getMessage());

            return back()->with('error', 'An error occurred while saving your information. Please try again.');
        }
    }
}
