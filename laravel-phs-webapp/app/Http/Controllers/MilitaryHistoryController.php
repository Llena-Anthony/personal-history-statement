<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MilitaryHistoryController extends Controller
{
    public function create()
    {
        return view('phs.military-history');
    }

    public function store(Request $request)
    {
        // Validation and storage logic will be implemented later
        return redirect()->route('phs.places-of-residence.create')
            ->with('success', 'Military history saved successfully. Please continue with your places of residence.');
    }
} 