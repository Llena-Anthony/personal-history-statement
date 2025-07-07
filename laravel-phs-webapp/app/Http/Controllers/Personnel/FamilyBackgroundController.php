<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FamilyBackground;
use App\Models\FamilyMember;

class FamilyBackgroundController extends Controller
{
    public function create()
    {
        $familyBackground = FamilyBackground::where('user_id', auth()->id())->first();
        $family_members = FamilyMember::where('user_id', auth()->id())->with('nameDetails')->get()->keyBy('role');
        $siblings = $familyBackground ? $familyBackground->siblings()->with('name')->get() : collect();
        return view('phs.family-background', [
            'familyBackground' => $familyBackground,
            'family_members' => $family_members,
            'siblings' => $siblings,
        ]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            // Add other family background fields as needed
        ]);
        $validated['user_id'] = auth()->id();
        $familyBackground = FamilyBackground::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );
        return redirect()->route('personnel.phs.educational-background.create')
            ->with('success', 'Family background saved successfully. Please continue with your educational background.');
    }
}
