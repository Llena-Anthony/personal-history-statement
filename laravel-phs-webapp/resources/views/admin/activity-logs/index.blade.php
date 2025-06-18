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

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <form action="{{ route('admin.activity-logs.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50"
                    placeholder="Search activities, users...">
            </div>
            <div>
                <label for="action" class="block text-sm font-medium text-gray-700 mb-1">Action</label>
                <select name="action" id="action" 
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
                    <option value="">All Actions</option>
                    @foreach($actions as $action)
                        <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $action)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" 
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
                    <option value="">All Status</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User</label>
                <select name="user_id" id="user_id" 
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->username }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" 
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
            </div>
            <div>
                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" 
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
            </div>
            <div class="flex items-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-[#1B365D] focus:ring-opacity-50">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="{{ route('admin.activity-logs.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                    <i class="fas fa-times mr-2"></i>Clear
                </a>
            </div>
        </form>
    </div>

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
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $activityLogs->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Clear Old Logs Modal -->
<div id="clearLogsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Clear Old Activity Logs</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        This will permanently delete activity logs older than the specified number of days. This action cannot be undone.
                    </p>
                </div>
                <form action="{{ route('admin.activity-logs.clear-old') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="days" class="block text-sm font-medium text-gray-700 mb-1">Delete logs older than (days)</label>
                        <input type="number" name="days" id="days" min="30" max="365" value="90" required
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeClearLogsModal()" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            Clear Logs
                        </button>
                    </div>
                </form>
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

// Close modal when clicking outside
document.getElementById('clearLogsModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeClearLogsModal();
    }
});
</script>
@endsection 