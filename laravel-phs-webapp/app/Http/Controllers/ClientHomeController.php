<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PHS;
use App\Models\PHSSubmission;

class ClientHomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get PHS status
        $phsStatus = null;
        $phsSubmission = PHSSubmission::where('user_id', $user->id)->first();
        if ($phsSubmission) {
            $phsStatus = $phsSubmission->status;
        }
        
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