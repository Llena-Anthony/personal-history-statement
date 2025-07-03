<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationalBackground;

class EducationalBackgroundController extends Controller
{
    public function create()
    {
        $educationalBackground = EducationalBackground::where('user_id', auth()->id())->first();
        return view('phs.educational-background', [
            'educationalBackground' => $educationalBackground,
        ]);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'elementary_school' => 'nullable|string|max:255',
            'high_school' => 'nullable|string|max:255',
            'college' => 'nullable|string|max:255',
            // Add other educational background fields as needed
        ]);
        $validated['user_id'] = auth()->id();
        $educationalBackground = EducationalBackground::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );
        return redirect()->route('personnel.phs.military-history')
            ->with('success', 'Educational background saved successfully. Please continue with your military history.');
    }
}
