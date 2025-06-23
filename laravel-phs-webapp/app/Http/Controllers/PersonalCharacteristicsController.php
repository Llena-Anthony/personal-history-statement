<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalCharacteristic;

class PersonalCharacteristicsController extends Controller
{
    public function create()
    {
        $data = []; // Add any data you need to pass to the view

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.personal-characteristics', $data)->render();
        }

        return view('phs.personal-characteristics', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sex' => 'required|in:male,female',
            'age' => 'required|integer|min:1|max:120',
            'height' => 'required|numeric|min:0.50|max:2.50',
            'weight' => 'required|numeric|min:20|max:300',
            'body_build' => 'required|in:heavy,medium,light',
            'complexion' => 'required|in:dark,fair,light',
            'hair_color' => 'required|string|max:50',
            'eye_color' => 'required|string|max:50',
            'distinguishing_features' => 'nullable|string|max:1000',
            'health_status' => 'required|in:excellent,good,poor',
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'recent_illness' => 'nullable|string|max:1000',
        ]);

        // Add user_id to the validated data
        $validated['user_id'] = auth()->id();

        // Create or update personal characteristics
        PersonalCharacteristic::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        return redirect()->route('phs.marital-status.create')
            ->with('success', 'Personal characteristics saved successfully. Please continue with your marital status.');
    }
} 