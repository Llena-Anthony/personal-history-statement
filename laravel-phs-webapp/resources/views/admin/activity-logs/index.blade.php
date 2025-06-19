@extends('layouts.admin')

@section('title', 'Activity Logs')

@section('header', 'Activity Logs')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-history text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Activities</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-calendar-day text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Today</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['today']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-calendar-week text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">This Week</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['this_week']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">This Month</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['this_month']) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar with Filter Dropdowns -->
    <x-admin.search-bar 
        :route="route('admin.activity-logs.index')"
        placeholder="Search activities, users, IP addresses, or any field..."
        :filters="[
            'status' => [
                'success' => 'Success',
                'warning' => 'Warning',
                'error' => 'Error'
            ],
            'action' => $actions,
            'user' => $users,
            'date_range' => true
        ]"
    />

    <!-- Action Buttons -->
    <div class="flex justify-between items-center">
        <div class="flex space-x-2">
            <a href="{{ route('admin.activity-logs.export', request()->query()) }}" 
               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                <i class="fas fa-download mr-2"></i>Export CSV
            </a>
            <button onclick="openClearLogsModal()" 
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                <i class="fas fa-trash mr-2"></i>Clear Old Logs
            </button>
        </div>
        <div class="text-sm text-gray-500">
            Showing {{ $activityLogs->firstItem() ?? 0 }} to {{ $activityLogs->lastItem() ?? 0 }} of {{ $activityLogs->total() }} results
        </div>
    </div>

    <!-- Activity Logs Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden scale-in">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>User</span>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'user_id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>Action</span>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'action', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>Status</span>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'status', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center space-x-1">
                                <span>Date & Time</span>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-gray-400 hover:text-gray-500">
                                    <i class="fas fa-sort"></i>
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($activityLogs as $log)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-[#1B365D] flex items-center justify-center text-white">
                                        {{ strtoupper(substr($log->user->name ?? 'N/A', 0, 1)) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $log->user->name ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">{{ $log->user->username ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <i class="{{ $log->action_icon }} text-[#1B365D] mr-2"></i>
                                <span class="text-sm font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $log->action)) }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $log->description }}">
                                {{ $log->description }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($log->status === 'success') bg-green-100 text-green-800
                                @elseif($log->status === 'warning') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($log->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $log->ip_address ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>
                                <div>{{ $log->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $log->created_at->format('h:i A') }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.activity-logs.show', $log->id) }}" 
                               class="text-[#1B365D] hover:text-[#2B4B7D] mr-3">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No activity logs found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($activityLogs->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $activityLogs->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Clear Logs Modal -->
<div id="clearLogsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Clear Old Logs</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">
                    This will permanently delete activity logs older than 30 days. This action cannot be undone.
                </p>
            </div>
            <div class="items-center px-4 py-3">
                <form action="{{ route('admin.activity-logs.clear-old') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-24 shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Clear
                    </button>
                </form>
                <button onclick="closeClearLogsModal()" class="ml-3 px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-24 shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openClearLogsModal() {
    document.getElementById('clearLogsModal').classList.remove('hidden');
}

function closeClearLogsModal() {
    document.getElementById('clearLogsModal').classList.add('hidden');
}
</script>
@endsection 