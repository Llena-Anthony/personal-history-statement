<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FamilyBackgroundController extends Controller
{
    /**
     * Show the form for creating a new family background.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('phs.family-background');
    }

    /**
     * Store a newly created family background in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // TODO: Add validation and storage logic
        return redirect()->route('phs.educational-background.create');
    }
} 