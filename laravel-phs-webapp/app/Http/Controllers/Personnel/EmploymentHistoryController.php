<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmploymentHistory;

class EmploymentHistoryController extends Controller
{
    public function create()
    {
        $employmentHistory = EmploymentHistory::where('user_id', auth()->id())->first();
        return view('phs.employment-history', [
            'employmentHistory' => $employmentHistory,
        ]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'employer' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            // Add other employment history fields as needed
        ]);
        $validated['user_id'] = auth()->id();
        $employmentHistory = EmploymentHistory::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );
        return redirect()->route('personnel.phs.places-of-residence.create')
            ->with('success', 'Employment history saved successfully. Please continue with your places of residence.');
    }
}
