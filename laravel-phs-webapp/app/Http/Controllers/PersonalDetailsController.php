<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonalDetailsController extends Controller
{
    public function create()
    {
        return view('phs.create');
    }

    public function store(Request $request)
    {
        // Validation and storage logic will be implemented later
        return redirect()->route('phs.personal-characteristics.create')
            ->with('success', 'Personal details saved successfully. Please continue with your personal characteristics.');
    }
} 