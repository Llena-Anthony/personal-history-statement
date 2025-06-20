<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForeignCountriesController extends Controller
{
    public function create()
    {
        $data = []; // Add any data you need to pass to the view

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.foreign-countries', $data)->render();
        }

        return view('phs.foreign-countries', $data);
    }

    public function store(Request $request)
    {
        // Validation and storage logic will be implemented later
        return redirect()->route('phs.credit-reputation')
            ->with('success', 'Foreign countries visited saved successfully. Please continue with your credit reputation.');
    }
} 