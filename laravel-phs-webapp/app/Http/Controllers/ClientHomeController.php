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
        
        // Compute full name (first, middle initial, last, extension)
        $fullName = $user->username;
        if ($user && $user->userDetail && $user->userDetail->nameDetail) {
            $nameDetail = $user->userDetail->nameDetail;
            $fullName = $nameDetail->first_name;
            if ($nameDetail->middle_name) {
                $fullName .= ' ' . strtoupper(substr($nameDetail->middle_name, 0, 1)) . '.';
            }
            $fullName .= ' ' . $nameDetail->last_name;
            if ($nameDetail->name_extension) {
                $fullName .= ' ' . $nameDetail->name_extension;
            }
        }
        
        $data = [
            'user' => $user,
            'phsStatus' => $phsStatus,
            'pdsStatus' => null, // Placeholder - always null
            'fullName' => $fullName,
        ];
        
        // Return appropriate view based on route
        if (request()->routeIs('client.dashboard')) {
            return view('client.home', $data);
        } else {
            return view('dashboard', $data);
        }
    }
} 