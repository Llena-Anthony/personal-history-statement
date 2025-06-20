<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Validation and storage logic will be implemented later
        return redirect()->route('phs.marital-status.create')
            ->with('success', 'Personal characteristics saved successfully. Please continue with your marital status.');
    }
} 