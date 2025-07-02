<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaritalStatus;
use App\Models\Child;

class MaritalStatusController extends Controller
{
    public function create()
    {
        $data = [];
        $maritalStatus = MaritalStatus::where('user_id', auth()->id())->first();
        if ($maritalStatus) {
            $data['maritalStatus'] = $maritalStatus;
            $children = Child::where('marital_status_id', $maritalStatus->id)
                ->with('nameDetails')
                ->get();
            $data['children'] = $children;
        }
        return view('phs.marital-status', $data);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'marital_status' => 'required|string',
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
        ]);
        $validated['user_id'] = auth()->id();
        $maritalStatus = MaritalStatus::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );
        return redirect()->route('personnel.phs.family-background')
            ->with('success', 'Marital status saved successfully. Please continue with your family background.');
    }
}
