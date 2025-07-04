<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLogDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityLogsController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLogDetail::with('user')
            ->applyFilters($request->all())
            ->orderBy('act_date_time', 'desc');

        // Handle sorting
        $sort = $request->get('sort', 'act_date_time');
        $direction = $request->get('direction', 'desc');
        
        if (in_array($sort, ['act_date_time', 'action', 'act_stat'])) {
            $query->orderBy($sort, $direction);
        }

        $activityLogs = $query->paginate(20)->withQueryString();

        // Get filter options for dropdowns
        $actionLabels = [
            'access_own_phs' => 'Access',
            'return_to_admin' => 'Return',
            'login' => 'Login',
            'logout' => 'Logout',
            'create' => 'Create',
            'update' => 'Update',
            'delete' => 'Delete',
            'submit' => 'Submit',
            'enable' => 'Enable',
            'disable' => 'Disable',
            'password_reset' => 'Reset',
        ];
        $actions = ActivityLogDetail::distinct()->pluck('action')->filter()->sort()->mapWithKeys(function ($action) use ($actionLabels) {
            return [$action => $actionLabels[$action] ?? ucfirst(explode('_', $action)[0])];
        })->toArray();
        
        $statuses = ActivityLogDetail::distinct()->pluck('act_stat')->filter()->sort()->mapWithKeys(function ($status) {
            return [$status => ucfirst($status)];
        })->toArray();

        // Get searchable fields for the search bar
        $searchFields = collect((new ActivityLogDetail())->getSearchableFields())->mapWithKeys(function ($config, $field) {
            return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
        })->toArray();

        // Get statistics
        $stats = [
            'total' => ActivityLogDetail::count(),
            'today' => ActivityLogDetail::whereDate('act_date_time', today())->count(),
            'this_week' => ActivityLogDetail::whereBetween('act_date_time', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => ActivityLogDetail::whereMonth('act_date_time', now()->month)->count(),
        ];

        // Get activity distribution by action
        $actionStats = ActivityLogDetail::select('action', DB::raw('count(*) as count'))
            ->groupBy('action')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        $data = compact(
            'activityLogs',
            'actions',
            'statuses',
            'stats',
            'actionStats',
            'searchFields'
        );

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('admin.activity-logs.index', $data)->render();
        }

        return view('admin.activity-logs.index', $data);
    }

    public function show(ActivityLogDetail $activityLog)
    {
        $activityLog->load('user');
        
        return view('admin.activity-logs.show', compact('activityLog'));
    }

    public function export(Request $request)
    {
        $query = ActivityLogDetail::with('user')
            ->applyFilters($request->all())
            ->orderBy('act_date_time', 'desc');

        // Check if this is a preview request
        if ($request->has('preview')) {
            $totalRecords = $query->count();
            $previewData = $query->limit(10)->get()->map(function ($log) {
                return [
                    'user_name' => $log->user->username ?? 'N/A',
                    'username' => $log->user->username ?? 'N/A',
                    'action' => ucfirst(str_replace('_', ' ', $log->action)),
                    'description' => $log->act_desc,
                    'status' => $log->act_stat,
                    'created_at' => $log->act_date_time ? $log->act_date_time->format('M d, Y h:i A') : 'N/A'
                ];
            });

            return response()->json([
                'total_records' => $totalRecords,
                'preview_data' => $previewData
            ]);
        }

        $activityLogs = $query->get();

        $filename = 'activity_logs_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($activityLogs) {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, [
                'ID',
                'User',
                'Username',
                'Action',
                'Description',
                'Status',
                'IP Address',
                'User Agent',
                'Date Time'
            ]);

            // Add data
            foreach ($activityLogs as $log) {
                fputcsv($file, [
                    $log->act_id,
                    $log->user->username ?? 'N/A',
                    $log->user->username ?? 'N/A',
                    $log->action,
                    $log->act_desc,
                    $log->act_stat,
                    $log->ip_addr,
                    $log->user_agent,
                    $log->act_date_time ? $log->act_date_time->format('Y-m-d H:i:s') : 'N/A'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function clearOldLogs(Request $request)
    {
        // Use default of 30 days if not specified
        $days = $request->get('days', 30);
        
        // Validate the days parameter if provided
        if ($request->has('days')) {
            $request->validate([
                'days' => 'required|integer|min:30|max:365'
            ]);
        }

        $deletedCount = ActivityLogDetail::where('act_date_time', '<', now()->subDays($days))->delete();

        return redirect()->route('admin.activity-logs.index')
            ->with('success', "Successfully deleted {$deletedCount} activity logs older than {$days} days.");
    }
} 