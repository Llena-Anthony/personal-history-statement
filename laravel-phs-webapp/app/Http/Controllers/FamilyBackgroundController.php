<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FamilyBackgroundController extends Controller
{
    public function create()
    {
        return view('phs.family-background');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validation rules
            $validated = $request->validate([
                'father_name' => 'required|string|max:255',
                'father_occupation' => 'nullable|string|max:255',
                'father_employer' => 'nullable|string|max:255',
                'father_business_address' => 'nullable|string|max:255',
                'father_telephone' => 'nullable|string|max:20',
                'mother_name' => 'required|string|max:255',
                'mother_occupation' => 'nullable|string|max:255',
                'mother_employer' => 'nullable|string|max:255',
                'mother_business_address' => 'nullable|string|max:255',
                'mother_telephone' => 'nullable|string|max:20',
                'spouse_name' => 'nullable|string|max:255',
                'spouse_occupation' => 'nullable|string|max:255',
                'spouse_employer' => 'nullable|string|max:255',
                'spouse_business_address' => 'nullable|string|max:255',
                'spouse_telephone' => 'nullable|string|max:20',
            ]);

            // Store the family background information
            DB::table('family_backgrounds')->updateOrInsert(
                ['user_id' => auth()->id()],
                array_merge($validated, [
                    'user_id' => auth()->id(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );

            DB::commit();

            return redirect()->route('phs.educational-background.create')
                ->with('success', 'Family background information saved successfully. Please continue with your educational background.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving family background: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'There was an error saving your family background information. Please try again.');
        }
    }
}
