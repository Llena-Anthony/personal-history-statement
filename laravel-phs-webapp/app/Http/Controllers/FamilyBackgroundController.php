<?php

namespace App\Http\Controllers;

use App\Models\FamilyBackground;
use Illuminate\Http\Request;

class FamilyBackgroundController extends Controller
{
    public function create()
    {
        return view('phs.family-background');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'spouse_first_name' => 'required|string|max:255',
            'spouse_middle_name' => 'required|string|max:255',
            'spouse_last_name' => 'required|string|max:255',
            'spouse_suffix' => 'nullable|string|max:255',
            'spouse_occupation' => 'nullable|string|max:255',
            'spouse_employer' => 'nullable|string|max:255',
            'spouse_business_address' => 'nullable|string|max:255',
            'spouse_telephone' => 'nullable|string|max:255',
            
            'father_first_name' => 'required|string|max:255',
            'father_middle_name' => 'required|string|max:255',
            'father_last_name' => 'required|string|max:255',
            'father_suffix' => 'nullable|string|max:255',
            
            'mother_first_name' => 'required|string|max:255',
            'mother_middle_name' => 'required|string|max:255',
            'mother_last_name' => 'required|string|max:255',
            
            'children' => 'nullable|array',
            'children.*.full_name' => 'required|string|max:255',
            'children.*.date_of_birth' => 'required|date',
        ]);

        $familyBackground = FamilyBackground::create([
            'user_id' => auth()->id(),
            'spouse_first_name' => $validated['spouse_first_name'],
            'spouse_middle_name' => $validated['spouse_middle_name'],
            'spouse_last_name' => $validated['spouse_last_name'],
            'spouse_suffix' => $validated['spouse_suffix'],
            'spouse_occupation' => $validated['spouse_occupation'],
            'spouse_employer' => $validated['spouse_employer'],
            'spouse_business_address' => $validated['spouse_business_address'],
            'spouse_telephone' => $validated['spouse_telephone'],
            
            'father_first_name' => $validated['father_first_name'],
            'father_middle_name' => $validated['father_middle_name'],
            'father_last_name' => $validated['father_last_name'],
            'father_suffix' => $validated['father_suffix'],
            
            'mother_first_name' => $validated['mother_first_name'],
            'mother_middle_name' => $validated['mother_middle_name'],
            'mother_last_name' => $validated['mother_last_name'],
        ]);

        // Store children information
        if (isset($validated['children'])) {
            foreach ($validated['children'] as $child) {
                $familyBackground->children()->create([
                    'full_name' => $child['full_name'],
                    'date_of_birth' => $child['date_of_birth'],
                ]);
            }
        }

        return redirect()->route('phs.educational-background.create');
    }
} 