<?php

namespace App\Http\Controllers;

use App\Models\PersonalCharacteristic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalCharacteristicController extends Controller
{
    public function create()
    {
        return view('phs.personal-characteristics');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sex' => 'required|in:Male,Female',
            'age' => 'required|integer|min:18|max:100',
            'height' => 'required|string|max:10',
            'weight' => 'required|string|max:10',
            'body_build' => 'required|string|max:50',
            'complexion' => 'required|string|max:50',
            'blood_type' => 'required|string|max:5',
            'hair_color' => 'required|string|max:50',
            'distinguishing_features' => 'nullable|string|max:255',
            'health_status' => 'required|string|max:255',
            'recent_illness' => 'nullable|string|max:255',
            'shoe_size' => 'required|in:5,6,7,8,9,10,11,12,13',
            'cap_size' => 'required|in:XS,S,M,L,XL,XXL',
        ]);

        try {
            DB::beginTransaction();

            $personalCharacteristic = PersonalCharacteristic::create([
                'user_id' => auth()->id(),
                'sex' => $validated['sex'],
                'age' => $validated['age'],
                'height' => $validated['height'],
                'weight' => $validated['weight'],
                'body_build' => $validated['body_build'],
                'complexion' => $validated['complexion'],
                'blood_type' => $validated['blood_type'],
                'hair_color' => $validated['hair_color'],
                'distinguishing_features' => $validated['distinguishing_features'],
                'health_status' => $validated['health_status'],
                'recent_illness' => $validated['recent_illness'],
                'shoe_size' => $validated['shoe_size'],
                'cap_size' => $validated['cap_size'],
            ]);

            DB::commit();

            return redirect()->route('phs.marital-status.create')
                ->with('success', 'Personal characteristics saved successfully. Please continue with your marital status.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while saving your personal characteristics. Please try again.');
        }
    }
} 