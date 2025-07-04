<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLogDetail;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        $reportType = $request->get('report_type', 'activity');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $userType = $request->get('user_type');
        $status = $request->get('status');
        $search = $request->get('search');

        $data = [];
        $summary = [];

        switch ($reportType) {
            case 'activity':
                $data = $this->getActivityReport($request);
                $summary = $this->getActivitySummary($dateFrom, $dateTo);
                break;
            case 'submissions':
                $data = $this->getSubmissionsReport($request);
                $summary = $this->getSubmissionsSummary($dateFrom, $dateTo);
                break;
            case 'users':
                $data = $this->getUsersReport($request);
                $summary = $this->getUsersSummary();
                break;
            case 'system':
                $data = $this->getSystemReport($request);
                $summary = $this->getSystemSummary($dateFrom, $dateTo);
                break;
        }

        // Get filter options
        $userTypes = User::distinct()->pluck('usertype')->filter()->sort();
        $statuses = ['pending', 'reviewed', 'approved', 'rejected'];
        $reportTypes = [
            'activity' => 'Activity Logs',
            'submissions' => 'Submissions Report',
            'users' => 'User Management',
            'system' => 'System Overview'
        ];

        // Get searchable fields based on report type
        $searchFields = [];
        switch ($reportType) {
            case 'activity':
                $searchFields = collect((new ActivityLog())->getSearchableFields())->mapWithKeys(function ($config, $field) {
                    return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
                })->toArray();
                break;
            case 'submissions':
                $phsFields = collect((new PHSSubmission())->getSearchableFields())->mapWithKeys(function ($config, $field) {
                    return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
                })->toArray();
                $pdsFields = collect((new PDSSubmission())->getSearchableFields())->mapWithKeys(function ($config, $field) {
                    return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
                })->toArray();
                $searchFields = array_merge($phsFields, $pdsFields);
                break;
            case 'users':
                $searchFields = collect((new User())->getSearchableFields())->mapWithKeys(function ($config, $field) {
                    return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
                })->toArray();
                break;
            case 'system':
                $searchFields = collect((new ActivityLog())->getSearchableFields())->mapWithKeys(function ($config, $field) {
                    return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
                })->toArray();
                break;
        }

        $data = compact(
            'data',
            'summary',
            'reportType',
            'dateFrom',
            'dateTo',
            'userType',
            'status',
            'search',
            'userTypes',
            'statuses',
            'reportTypes',
            'searchFields'
        );

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('admin.reports.index', $data)->render();
        }

        return view('admin.reports.index', $data);
    }

    private function getActivityReport(Request $request)
    {
        $query = ActivityLogDetail::with('user');
        
        // Apply all filters using the Searchable trait
        $query->applyFilters($request->all());

        return $query->orderBy('act_date_time', 'desc')->paginate(20)->withQueryString();
    }

    private function getSubmissionsReport(Request $request)
    {
        // Since PHSSubmission and PDSSubmission models don't exist in the new schema,
        // we'll return empty collections for now
        return [
            'phs' => collect()->paginate(10),
            'pds' => collect()->paginate(10)
        ];
    }

    private function getUsersReport(Request $request)
    {
        $query = User::query();
        
        // Apply all filters using the Searchable trait
        $query->applyFilters($request->all());

        return $query->orderBy('username', 'asc')->paginate(20)->withQueryString();
    }

    private function getSystemReport(Request $request)
    {
        $dateFrom = $request->date_from ? Carbon::parse($request->date_from) : now()->subDays(30);
        $dateTo = $request->date_to ? Carbon::parse($request->date_to) : now();

        return [
            'daily_activities' => ActivityLogDetail::select(
                DB::raw('DATE(act_date_time) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('act_date_time', [$dateFrom, $dateTo])
            ->groupBy('date')
            ->orderBy('date')
            ->get(),
            
            'action_distribution' => ActivityLogDetail::select('action', DB::raw('COUNT(*) as count'))
                ->whereBetween('act_date_time', [$dateFrom, $dateTo])
                ->groupBy('action')
                ->orderBy('count', 'desc')
                ->get(),
                
            'user_activity' => ActivityLogDetail::select(
                'changes_made_by',
                DB::raw('COUNT(*) as activity_count')
            )
            ->with('user:username,usertype')
            ->whereBetween('act_date_time', [$dateFrom, $dateTo])
            ->groupBy('changes_made_by')
            ->orderBy('activity_count', 'desc')
            ->limit(10)
            ->get()
        ];
    }

    private function getActivitySummary($dateFrom, $dateTo)
    {
        $query = ActivityLogDetail::query();
        
        if ($dateFrom) {
            $query->whereDate('act_date_time', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('act_date_time', '<=', $dateTo);
        }

        return [
            'total_activities' => $query->count(),
            'unique_users' => $query->distinct('changes_made_by')->count(),
            'success_rate' => $query->where('act_stat', 'success')->count(),
            'error_rate' => $query->where('act_stat', 'error')->count(),
        ];
    }

    private function getSubmissionsSummary($dateFrom, $dateTo)
    {
        // Since PHSSubmission and PDSSubmission models don't exist in the new schema,
        // we'll return zeros for now
        return [
            'total_phs' => 0,
            'total_pds' => 0,
            'phs_pending' => 0,
            'phs_approved' => 0,
            'pds_pending' => 0,
            'pds_approved' => 0,
        ];
    }

    private function getUsersSummary()
    {
        return [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'admin_users' => User::where('usertype', 'admin')->count(),
            'personnel_users' => User::where('usertype', 'personnel')->count(),
            'regular_users' => User::where('usertype', 'regular')->count(),
            'new_users_this_month' => 0, // Since users table doesn't have timestamps
        ];
    }

    private function getSystemSummary($dateFrom, $dateTo)
    {
        $query = ActivityLogDetail::query();
        
        if ($dateFrom) {
            $query->whereDate('act_date_time', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('act_date_time', '<=', $dateTo);
        }

        return [
            'total_activities' => $query->count(),
            'unique_users' => $query->distinct('changes_made_by')->count(),
            'avg_activities_per_day' => $query->count() / max(1, $dateFrom ? $dateFrom->diffInDays($dateTo ?: now()) : 30),
            'most_active_user' => $query->select('changes_made_by', DB::raw('COUNT(*) as count'))
                ->groupBy('changes_made_by')
                ->orderBy('count', 'desc')
                ->first(),
        ];
    }

    public function export(Request $request)
    {
        $reportType = $request->get('report_type', 'activity');
        $filename = "report_{$reportType}_" . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($request, $reportType) {
            $file = fopen('php://output', 'w');
            
            switch ($reportType) {
                case 'activity':
                    $this->exportActivityReport($file, $request);
                    break;
                case 'submissions':
                    $this->exportSubmissionsReport($file, $request);
                    break;
                case 'users':
                    $this->exportUsersReport($file, $request);
                    break;
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportActivityReport($file, Request $request)
    {
        fputcsv($file, [
            'ID', 'User', 'Username', 'User Type', 'Action', 'Description', 
            'Status', 'IP Address', 'Date & Time'
        ]);

        $activities = $this->getActivityReport($request);
        foreach ($activities as $activity) {
            fputcsv($file, [
                $activity->act_id,
                $activity->user->username ?? 'N/A',
                $activity->user->username ?? 'N/A',
                $activity->user->usertype ?? 'N/A',
                $activity->action,
                $activity->act_desc,
                $activity->act_stat,
                $activity->ip_addr,
                $activity->act_date_time ? $activity->act_date_time->format('Y-m-d H:i:s') : 'N/A'
            ]);
        }
    }

    private function exportSubmissionsReport($file, Request $request)
    {
        fputcsv($file, [
            'Type', 'Status', 'Note'
        ]);

        // Since PHSSubmission and PDSSubmission models don't exist in the new schema,
        // we'll add placeholder entries
        fputcsv($file, [
            'PHS',
            'Not Available',
            'PHS submissions not implemented in current schema'
        ]);
        
        fputcsv($file, [
            'PDS',
            'Not Available',
            'PDS submissions not implemented in current schema'
        ]);
    }

    private function exportUsersReport($file, Request $request)
    {
        fputcsv($file, [
            'Username', 'User Type', 'Organic Role', 'Status', 'Last Login'
        ]);

        $users = $this->getUsersReport($request);
        foreach ($users as $user) {
            fputcsv($file, [
                $user->username,
                $user->usertype,
                $user->organic_role ?? 'N/A',
                $user->is_active ? 'Active' : 'Inactive',
                $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i:s') : 'Never'
            ]);
        }
    }
} 