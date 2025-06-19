<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EducationalBackgroundController extends Controller
{
    public function create()
    {
        return view('phs.educational-background');
    }

    public function index()
    {
        return view('phs.educational-background');
    }
} 