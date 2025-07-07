<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MilitaryHistory;

class MilitaryHistoryController extends Controller
{
    public function create()
    {
        $militaryHistory = MilitaryHistory::where('user_id', auth()->id())->first();
        return view('phs.military-history', [
            'militaryHistory' => $militaryHistory,
        ]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'branch' => 'nullable|string|max:255',
            'rank' => 'nullable|string|max:255',
            // Add other military history fields as needed
        ]);
        $validated['user_id'] = auth()->id();
        $militaryHistory = MilitaryHistory::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );
        return redirect()->route('personnel.phs.employment-history.create')
            ->with('success', 'Military history saved successfully. Please continue with your employment history.');
    }
}
