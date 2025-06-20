<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityLogsController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')
            ->applyFilters($request->all())
            ->orderBy('created_at', 'desc');

        // Handle sorting
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        
        if (in_array($sort, ['created_at', 'action', 'status'])) {
            $query->orderBy($sort, $direction);
        }

        $activityLogs = $query->paginate(20)->withQueryString();

        // Get filter options for dropdowns
        $actions = ActivityLog::distinct()->pluck('action')->filter()->sort()->mapWithKeys(function ($action) {
            return [$action => ucfirst(str_replace('_', ' ', $action))];
        })->toArray();
        
        $statuses = ActivityLog::distinct()->pluck('status')->filter()->sort()->mapWithKeys(function ($status) {
            return [$status => ucfirst($status)];
        })->toArray();

        // Get searchable fields for the search bar
        $searchFields = collect((new ActivityLog())->getSearchableFields())->mapWithKeys(function ($config, $field) {
            return [$field => $config['label'] ?? ucfirst(str_replace('_', ' ', $field))];
        })->toArray();

        // Get statistics
        $stats = [
            'total' => ActivityLog::count(),
            'today' => ActivityLog::whereDate('created_at', today())->count(),
            'this_week' => ActivityLog::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => ActivityLog::whereMonth('created_at', now()->month)->count(),
        ];

        // Get activity distribution by action
        $actionStats = ActivityLog::select('action', DB::raw('count(*) as count'))
            ->groupBy('action')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        return view('admin.activity-logs.index', compact(
            'activityLogs',
            'actions',
            'statuses',
            'stats',
            'actionStats',
            'searchFields'
        ));
    }

    public function show(ActivityLog $activityLog)
    {
        $activityLog->load('user');
        
        return view('admin.activity-logs.show', compact('activityLog'));
    }

    public function export(Request $request)
    {
        $query = ActivityLog::with('user')
            ->applyFilters($request->all())
            ->orderBy('created_at', 'desc');

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
                'Email',
                'Action',
                'Description',
                'Status',
                'IP Address',
                'User Agent',
                'Created At'
            ]);

            // Add data
            foreach ($activityLogs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->user->name ?? 'N/A',
                    $log->user->username ?? 'N/A',
                    $log->user->email ?? 'N/A',
                    $log->action,
                    $log->description,
                    $log->status,
                    $log->ip_address,
                    $log->user_agent,
                    $log->created_at->format('Y-m-d H:i:s')
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

        $deletedCount = ActivityLog::where('created_at', '<', now()->subDays($days))->delete();

        return redirect()->route('admin.activity-logs.index')
            ->with('success', "Successfully deleted {$deletedCount} activity logs older than {$days} days.");
    }
} 