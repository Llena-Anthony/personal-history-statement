<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientHomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('client.home', [
            'user' => $user
        ]);
    }
} 