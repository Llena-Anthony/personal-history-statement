<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FamilyHistoryDetail;
use App\Models\FamilyMember;

class FamilyBackgroundController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $familyBackground = FamilyHistoryDetail::where('username', $user->username)->first();
        $family_members = collect(); // Will be populated from FamilyDetail models
        $siblings = \App\Models\SiblingDetail::where('username', $user->username)->get();
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
        $user = auth()->user();
        $familyBackground = FamilyHistoryDetail::updateOrCreate(
            ['username' => $user->username],
            []
        );
        return redirect()->route('personnel.phs.educational-background.create')
            ->with('success', 'Family background saved successfully. Please continue with your educational background.');
    }
}
