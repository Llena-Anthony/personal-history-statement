<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalCharacteristicsController extends Controller
{
    public function create()
    {
        return view('phs.personal-characteristics');
    }

    public function store(Request $request)
    {
        // Validation and storage logic will be implemented later
        return redirect()->route('phs.marital-status.create')
            ->with('success', 'Personal characteristics saved successfully. Please continue with your marital status.');
    }
} 