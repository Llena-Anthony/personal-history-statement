@extends('layouts.admin')

@section('title', 'Reports')
@section('header', 'Reports')

@section('content')
<div class="space-y-6">
    <!-- Enhanced Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1B365D] flex items-center gap-3">
                <div class="bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] text-white p-3 rounded-xl shadow-lg">
                    <i class="fas fa-chart-bar text-xl"></i>
                </div>
                Reports
            </h1>
            <p class="text-gray-600 mt-2">Generate and view system reports and analytics</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-sm text-gray-500 font-medium">Report Type</div>
                <div class="text-lg font-bold text-[#1B365D]">{{ $reportTypes[$reportType] ?? 'Activity Logs' }}</div>
            </div>
            <a href="{{ route('admin.reports.export', request()->query()) }}" 
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl hover:from-emerald-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 shadow-lg">
                <i class="fas fa-download mr-2"></i>
                Export CSV
            </a>
        </div>
    </div>

    <!-- Report Type Selector -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
        <div class="flex flex-wrap gap-2">
            @foreach($reportTypes as $type => $label)
            <a href="{{ route('admin.reports.index', array_merge(request()->query(), ['report_type' => $type])) }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200
                      @if($reportType === $type)
                          bg-[#1B365D] text-white shadow-lg
                      @else
                          bg-gray-100 text-gray-700 hover:bg-gray-200
                      @endif">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>

    <!-- Search Bar with Filter Dropdowns -->
    <x-admin.search-bar 
        :route="route('admin.reports.index')"
        placeholder="Search user, action, file, or any field..."
        :filters="[
            'status' => $statuses,
            'user_type' => $userTypes,
            'date_range' => true
        ]"
    />

    <!-- Summary Cards -->
    @if(!empty($summary))
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($summary as $key => $value)
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-[#1B365D]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-chart-pie text-[#1B365D] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($value) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Reports Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        @if($reportType === 'activity')
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                        @elseif($reportType === 'submissions')
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                        @elseif($reportType === 'users')
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                        @else
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($data as $item)
                    <tr class="hover:bg-gray-50">
                        @if($reportType === 'activity')
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center text-white text-base font-bold">
                                        {{ strtoupper(substr(optional(optional($item->user->userDetail)->nameDetail)->first_name ?? $item->user->username ?? 'N/A', 0, 1)) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ optional(optional($item->user->userDetail)->nameDetail)->first_name }} {{ optional(optional($item->user->userDetail)->nameDetail)->last_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->user->username ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ ucfirst($item->action) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->act_desc }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($item->act_stat === 'success') bg-green-100 text-green-800
                                    @elseif($item->act_stat === 'warning') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($item->act_stat) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $item->act_date_time ? $item->act_date_time->format('M d, Y h:i A') : 'N/A' }}</td>
                        @elseif($reportType === 'submissions')
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] rounded-full flex items-center justify-center text-white text-base font-bold">
                                        {{ strtoupper(substr(optional(optional($item->userDetail)->nameDetail)->first_name ?? $item->username, 0, 1)) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ optional(optional($item->userDetail)->nameDetail)->first_name }} {{ optional(optional($item->userDetail)->nameDetail)->last_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->username }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($item->phs_status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($item->phs_status === 'in_progress') bg-blue-100 text-blue-800
                                    @elseif($item->phs_status === 'completed') bg-green-100 text-green-800
                                    @elseif($item->phs_status === 'reviewed') bg-purple-100 text-purple-800
                                    @elseif($item->phs_status === 'approved') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $item->phs_status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ ucfirst($item->usertype) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $item->last_login_at ? $item->last_login_at->format('M d, Y h:i A') : 'Never' }}</td>
                        @elseif($reportType === 'users')
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] rounded-full flex items-center justify-center text-white text-base font-bold">
                                        {{ strtoupper(substr(optional(optional($item->userDetail)->nameDetail)->first_name ?? $item->username, 0, 1)) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ optional(optional($item->userDetail)->nameDetail)->first_name }} {{ optional(optional($item->userDetail)->nameDetail)->last_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->username }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ ucfirst($item->usertype) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($item->is_active) bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $item->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $item->last_login_at ? $item->last_login_at->format('M d, Y h:i A') : 'Never' }}</td>
                        @else
                            <td class="px-6 py-4 text-sm text-gray-900">{{ json_encode($item) }}</td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-sm text-gray-500 text-center">
                            No records found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        @if(method_exists($data, 'links'))
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $data->links() }}
        </div>
        @endif
    </div>
</div>
@endsection 