<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminHomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalUsers = User::where('usertype', 'client')->count();
        $activeUsers = User::where('usertype', 'client')->where('is_active', true)->count();
        $inactiveUsers = User::where('usertype', 'client')->where('is_active', false)->count();
        
        return view('admin.home', [
            'user' => $user,
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers
        ]);
    }
} 