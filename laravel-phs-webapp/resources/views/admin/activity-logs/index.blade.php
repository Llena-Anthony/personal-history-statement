@extends('layouts.admin')

@section('title', 'Activity Logs')

@section('header', 'Activity Logs')

@section('content')
<div class="space-y-6">
    <!-- Enhanced Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1B365D] flex items-center gap-3">
                <div class="bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] text-white p-3 rounded-xl shadow-lg">
                    <i class="fas fa-history text-xl"></i>
                </div>
                Activity Logs
            </h1>
            <p class="text-gray-600 mt-2">Monitor system activities, user actions, and security events</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-sm text-gray-500 font-medium">Total Activities</div>
                <div class="text-3xl font-bold text-[#1B365D]">{{ $stats['total'] }}</div>
                <div class="text-xs text-green-600 mt-1">
                    <i class="fas fa-arrow-up mr-1"></i>
                    {{ $stats['today'] }} today
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openClearLogsModal()" 
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-trash mr-2"></i>
                    <span class="hidden sm:inline">Clear Old Logs</span>
                    <span class="sm:hidden">Clear</span>
                </button>
                <button onclick="exportLogs()" 
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl hover:from-emerald-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-eye mr-2"></i>
                    <span class="hidden sm:inline">Export</span>
                    <span class="sm:hidden">Export</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Enhanced Search Bar with Filter Dropdowns -->
    <x-admin.search-bar 
        :route="route('admin.activity-logs.index')"
        placeholder="Search activities, users, IP addresses, or any field..."
        :filters="[
            'status' => $statuses,
            'action' => $actions,
            'date_range' => true
        ]"
    />

    <!-- Enhanced Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-[#1B365D]/10 to-[#2B4B7D]/10 rounded-xl shadow-sm p-6 border border-[#1B365D]/20 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-[#1B365D]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar-day text-[#1B365D] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Today's Activities</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['today']) }}</p>
                    <p class="text-xs text-[#1B365D] mt-1">
                        <i class="fas fa-clock mr-1"></i>
                        Recent activity
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-[#D4AF37]/10 to-[#B38F2A]/10 rounded-xl shadow-sm p-6 border border-[#D4AF37]/20 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-[#D4AF37]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar-week text-[#D4AF37] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">This Week</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['this_week']) }}</p>
                    <p class="text-xs text-[#D4AF37] mt-1">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        Weekly activity
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-[#1B365D]/10 to-[#2B4B7D]/10 rounded-xl shadow-sm p-6 border border-[#1B365D]/20 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-[#1B365D]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-[#1B365D] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">This Month</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['this_month']) }}</p>
                    <p class="text-xs text-[#1B365D] mt-1">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Monthly activity
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Results Count and Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-4 rounded-xl shadow-sm border border-gray-200">
        <div class="flex items-center gap-4">
            <div class="text-sm text-gray-600">
                <span class="font-medium">{{ $activityLogs->firstItem() ?? 0 }}</span> to 
                <span class="font-medium">{{ $activityLogs->lastItem() ?? 0 }}</span> of 
                <span class="font-medium">{{ $activityLogs->total() }}</span> results
            </div>
            @if($activityLogs->total() > 0)
            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500">Per page:</span>
                <select onchange="window.location.href='{{ request()->fullUrlWithQuery(['per_page' => '']) }}' + this.value" class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                    <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
            @endif
        </div>
    </div>

    <!-- Table View -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
        <table class="w-full table-fixed text-sm">
            <thead class="bg-gradient-to-r from-[#1B365D]/10 to-[#2B4B7D]/10">
                <tr>
                    <th class="px-3 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">User</th>
                    <th class="px-3 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-24">Action</th>
                    <th class="px-3 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-56 max-w-xs">Description</th>
                    <th class="px-3 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-20">Status</th>
                    <th class="px-3 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">IP Address</th>
                    <th class="px-3 py-2 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-32">Date & Time</th>
                    <th class="px-3 py-2 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider w-10">View</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($activityLogs as $log)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-3 py-2 truncate max-w-[8rem]">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center text-white text-base font-bold border border-gray-300 shadow-sm">
                                {{ strtoupper(substr(optional(optional($log->user->userDetail)->nameDetail)->first_name ?? $log->user->username ?? 'N/A', 0, 1)) }}
                            </div>
                            <div class="ml-2 truncate">
                                <div class="text-xs font-medium text-gray-900 truncate">{{ optional(optional($log->user->userDetail)->nameDetail)->first_name }} {{ optional(optional($log->user->userDetail)->nameDetail)->last_name }}</div>
                                <div class="text-xs text-gray-500 truncate">{{ $log->user->username ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-3 py-2 truncate max-w-[6rem]">
                        <div class="flex items-center">
                            <div class="p-1 rounded bg-[#1B365D]/20 text-[#1B365D] mr-2">
                                <i class="{{ $log->action_icon }} text-xs"></i>
                            </div>
                            <span class="text-xs font-medium text-gray-900 truncate">
                                @php
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
                                    echo $actionLabels[$log->action] ?? ucfirst(explode('_', $log->action)[0]);
                                @endphp
                            </span>
                        </div>
                    </td>
                    <td class="px-3 py-2 truncate max-w-[14rem]" title="{{ $log->act_desc }}">
                        <div class="text-xs text-gray-900 truncate">
                            {{ $log->act_desc }}
                        </div>
                    </td>
                    <td class="px-3 py-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            @if($log->act_stat === 'success') bg-green-100 text-green-800
                            @elseif($log->act_stat === 'warning') bg-[#D4AF37]/20 text-[#D4AF37]
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($log->act_stat) }}
                        </span>
                    </td>
                    <td class="px-3 py-2 truncate max-w-[8rem]" title="{{ $log->ip_addr ?? 'N/A' }}">
                        <span class="text-xs font-mono text-gray-500 truncate">
                            {{ $log->ip_addr ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="px-3 py-2">
                        <div class="text-xs text-gray-900">
                            <div class="font-medium">{{ $log->act_date_time ? $log->act_date_time->setTimezone('Asia/Manila')->format('M d, Y') : 'N/A' }}</div>
                            <div class="text-gray-500">{{ $log->act_date_time ? $log->act_date_time->setTimezone('Asia/Manila')->format('h:i A') : 'N/A' }}</div>
                        </div>
                    </td>
                    <td class="px-3 py-2 text-right">
                        <a href="{{ route('admin.activity-logs.show', $log->act_id) }}" 
                           class="inline-flex items-center text-xs text-[#1B365D] hover:text-[#2B4B7D] font-medium transition-colors">
                            <i class="fas fa-eye mr-1"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-3 py-8 text-center">
                        <div class="text-gray-500">
                            <i class="fas fa-search text-2xl mb-2"></i>
                            <p class="text-base font-medium">No activity logs found</p>
                            <p class="text-xs">Try adjusting your search criteria or filters.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Enhanced Pagination -->
    @if($activityLogs->hasPages())
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 p-4">
        {{ $activityLogs->links() }}
    </div>
    @endif
</div>

<!-- Enhanced Clear Logs Modal -->
<div id="clearLogsModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-2xl rounded-2xl bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-[#1B365D]/20 to-[#2B4B7D]/20">
                <i class="fas fa-exclamation-triangle text-[#1B365D] text-2xl"></i>
            </div>
            <h3 class="text-xl leading-6 font-bold text-gray-900 mt-4">Clear Old Logs</h3>
            <div class="mt-4 px-7 py-3">
                <p class="text-sm text-gray-600 leading-relaxed">
                    This will permanently delete activity logs older than 30 days. This action cannot be undone.
                </p>
            </div>
            <div class="flex items-center justify-center gap-3 px-4 py-4">
                <form action="{{ route('admin.activity-logs.clear-old') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-6 py-2 bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] text-white text-base font-medium rounded-xl shadow-lg hover:from-[#2B4B7D] hover:to-[#1B365D] focus:outline-none focus:ring-2 focus:ring-[#1B365D] transition-all duration-200 transform hover:scale-105">
                        Clear Logs
                    </button>
                </form>
                <button onclick="closeClearLogsModal()" class="px-6 py-2 bg-gradient-to-r from-[#D4AF37] to-[#B38F2A] text-white text-base font-medium rounded-xl shadow-lg hover:from-[#B38F2A] hover:to-[#D4AF37] focus:outline-none focus:ring-2 focus:ring-[#D4AF37] transition-all duration-200 transform hover:scale-105">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Enhanced animations */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.scale-in {
    animation: slideInUp 0.6s ease-out;
}
</style>

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