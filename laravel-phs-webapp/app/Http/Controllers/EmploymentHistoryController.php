<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmploymentHistoryController extends Controller
{
    public function create()
    {
        return view('phs.employment-history');
    }

    public function store(Request $request)
    {
        // Validation and storage logic will be implemented later
        return redirect()->route('phs.foreign-countries.create')
            ->with('success', 'Employment history saved successfully. Please continue with your foreign countries visited.');
    }
} 