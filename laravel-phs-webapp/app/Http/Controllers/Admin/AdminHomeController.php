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
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Submission Status Distribution (from users table)
        $submissionStats = [
            'pending'   => User::where('phs_status', 'pending')->count(),
            'reviewed'  => User::where('phs_status', 'reviewed')->count(),
            'approved'  => User::where('phs_status', 'approved')->count(),
            'rejected'  => User::where('phs_status', 'rejected')->count(),
        ];

        // PHS Submissions (total and this month) - only count real submissions
        $realStatuses = ['reviewed', 'approved', 'submitted'];
        $totalPHSSubmissions = User::whereIn('phs_status', $realStatuses)->count();
        $newPHSSubmissionsThisMonth = User::whereIn('phs_status', $realStatuses)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        // Remove PDS stats since pds_status does not exist
        $totalPDSSubmissions = 0;
        $newPDSSubmissionsThisMonth = 0;

        // Monthly Statistics for charts (group by month for real PHS submissions only)
        $monthlyStats = collect();
        $months = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month')
            ->whereIn('phs_status', $realStatuses)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('month');
        if ($months->isEmpty()) {
            // No data: provide a default month and zero count
            $monthlyStats->push([
                'month' => now()->format('M Y'),
                'phs_count' => 0
            ]);
        } else {
            foreach ($months as $month) {
                if (empty($month) || !preg_match('/^\d{4}-\d{2}$/', $month)) {
                    continue; // Skip invalid or empty months
                }
                $monthlyStats->push([
                    'month' => Carbon::createFromFormat('Y-m', $month)->format('M Y'),
                    'phs_count' => User::whereIn('phs_status', $realStatuses)
                        ->whereYear('created_at', substr($month, 0, 4))
                        ->whereMonth('created_at', substr($month, 5, 2))
                        ->count(),
                ]);
            }
        }
        $monthlyStats = collect($monthlyStats);

        // Recent Activity using ActivityLogDetail
        $recentActivities = ActivityLogDetail::with('user')
            ->orderBy('act_date_time', 'desc')
            ->take(10)
            ->get();

        // Get all users for user type distribution
        $users = User::all();

        // Get the authenticated admin's full name
        $adminName = auth()->user()->first_name ?? 'Administrator';

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