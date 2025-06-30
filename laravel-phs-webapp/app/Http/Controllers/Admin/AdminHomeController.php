<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PHSSubmission;
use App\Models\PDSSubmission;
use App\Models\ActivityLog;
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
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)->count();

        // Submission Statistics
        $totalPHSSubmissions = PHSSubmission::count();
        $newPHSSubmissionsThisMonth = PHSSubmission::whereMonth('created_at', now()->month)->count();
        $totalPDSSubmissions = PDSSubmission::count();
        $newPDSSubmissionsThisMonth = PDSSubmission::whereMonth('created_at', now()->month)->count();

        // Submission Status Distribution
        $submissionStats = [
            'pending' => PHSSubmission::where('status', 'pending')->count(),
            'reviewed' => PHSSubmission::where('status', 'reviewed')->count(),
            'approved' => PHSSubmission::where('status', 'approved')->count(),
            'rejected' => PHSSubmission::where('status', 'rejected')->count(),
        ];

        // Monthly Statistics
        $monthlyStats = DB::table('phs_submissions')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as phs_count')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $item->month = Carbon::createFromFormat('Y-m', $item->month)->format('M Y');
                return $item;
            });

        $pdsMonthlyStats = DB::table('pds_submissions')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('COUNT(*) as pds_count')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Merge PDS stats with PHS stats
        $monthlyStats = $monthlyStats->map(function ($item) use ($pdsMonthlyStats) {
            $pdsMonth = $pdsMonthlyStats->firstWhere('month', Carbon::createFromFormat('M Y', $item->month)->format('Y-m'));
            $item->pds_count = $pdsMonth ? $pdsMonth->pds_count : 0;
            return $item;
        });

        // Recent Activity
        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

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
            'recentActivities'
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
        ActivityLog::create([
            'user_id' => auth()->id(),
            'description' => 'Admin accessed their own PHS as an Academy member',
            'status' => 'success',
            'action' => 'access_own_phs'
        ]);

        // Redirect to client dashboard
        return redirect()->route('client.dashboard')->with('success', 'Welcome to your PHS! You can now fill out and manage your Personal History Statement as an Academy member.');
    }
} 