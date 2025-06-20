<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForeignCountriesController extends Controller
{
    public function create()
    {
        return view('phs.foreign-countries');
    }

    public function store(Request $request)
    {
        // Validation and storage logic will be implemented later
        return redirect()->route('phs.credit-reputation')
            ->with('success', 'Foreign countries visited saved successfully. Please continue with your credit reputation.');
    }
} 