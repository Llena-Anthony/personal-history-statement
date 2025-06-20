<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function preview() {
        return view("admin.phs.phs-template");
    }
}
