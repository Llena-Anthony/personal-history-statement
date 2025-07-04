<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientHomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get PHS status - for now, we'll set it to pending since PHS submissions aren't implemented yet
        $phsStatus = 'pending';
        
        $data = [
            'user' => $user,
            'phsStatus' => $phsStatus,
            'pdsStatus' => null // Placeholder - always null
        ];
        
        // Return appropriate view based on route
        if (request()->routeIs('client.dashboard')) {
            return view('client.home', $data);
        } else {
            return view('dashboard', $data);
        }
    }
} 