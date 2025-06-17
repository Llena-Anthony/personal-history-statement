<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlacesOfResidenceController extends Controller
{
    public function create()
    {
        return view('phs.places-of-residence');
    }

    public function store(Request $request)
    {
        // Validation and storage logic will be implemented later
        return redirect()->route('phs.employment-history.create')
            ->with('success', 'Places of residence saved successfully. Please continue with your employment history.');
    }
} 