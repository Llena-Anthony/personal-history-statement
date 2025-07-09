<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLogDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminHomeController extends Controller
{
    public function index()
    {
        // User Statistics
        $totalUsers = User::count();
        $enabledUsers = User::where('is_active', true)->count();
        $newUsersThisMonth = 0; // Since users table doesn't have timestamps, we'll set this to 0 for now

        // For now, we'll set these to 0 since PHS/PDS submissions are not implemented yet
        $totalPHSSubmissions = 0;
        $newPHSSubmissionsThisMonth = 0;
        $totalPDSSubmissions = 0;
        $newPDSSubmissionsThisMonth = 0;

        // Submission Status Distribution (placeholder for now)
        $submissionStats = [
            'pending' => 0,
            'reviewed' => 0,
            'approved' => 0,
            'rejected' => 0,
        ];

        // Monthly Statistics (placeholder for now)
        $monthlyStats = collect();

        // Recent Activity using ActivityLogDetail
        $recentActivities = ActivityLogDetail::with('user')
            ->orderBy('act_date_time', 'desc')
            ->take(10)
            ->get();

        // Get all users for user type distribution
        $users = User::all();

        // Get the authenticated admin's full name
        $admin = auth()->user();
        $adminName = 'Administrator';
        if ($admin) {
            $userDetail = $admin->userDetail;
            $nameDetail = $userDetail ? $userDetail->nameDetail : null;
            if ($nameDetail) {
                $adminName = $nameDetail->first_name;
                if ($nameDetail->middle_name) {
                    $adminName .= ' ' . strtoupper(substr($nameDetail->middle_name, 0, 1)) . '.';
                }
                $adminName .= ' ' . $nameDetail->last_name;
                if ($nameDetail->name_extension) {
                    $adminName .= ' ' . $nameDetail->name_extension;
                }
            } else {
                $adminName = $admin->username;
            }
        }

        $data = compact(
            'totalUsers',
            'enabledUsers',
            'newUsersThisMonth',
            'totalPHSSubmissions',
            'newPHSSubmissionsThisMonth',
            'totalPDSSubmissions',
            'newPDSSubmissionsThisMonth',
            'submissionStats',
            'monthlyStats',
            'recentActivities',
            'users',
            'adminName'
        );

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('admin.dashboard', $data)->render();
        }

        return view('admin.dashboard', $data);
    }

    public function switchToClient()
    {
        // Store admin session data to remember the switch
        session()->put('admin_switched_to_client', true);
        session()->put('admin_original_route', request()->headers->get('referer'));
        
        // Log the activity
        ActivityLogDetail::create([
            'changes_made_by' => auth()->user()->username,
            'action' => 'access_own_phs',
            'act_desc' => 'Admin accessed their own PHS as an Academy member',
            'act_stat' => 'success',
            'ip_addr' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        // Redirect to client dashboard
        return redirect()->route('client.dashboard')->with('success', 'Welcome to your PHS! You can now fill out and manage your Personal History Statement as an Academy member.');
    }
} 