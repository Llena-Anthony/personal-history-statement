@extends('layouts.personnel')

@section('title', 'PHS Form')

@section('header', 'PHS Form')

@section('content')
<div class="space-y-6">
    <!-- Enhanced Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1B365D] flex items-center gap-3">
                <div class="bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] text-white p-3 rounded-xl shadow-lg">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
                Personal History Statement (PHS) Form
            </h1>
            <p class="text-gray-600 mt-2">Fill out and track your Personal History Statement</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-sm text-gray-500 font-medium">Your Submissions</div>
                <div class="text-3xl font-bold text-[#1B365D]">{{ $submissions->total() ?? 0 }}</div>
                <div class="text-xs text-green-600 mt-1">
                    <i class="fas fa-arrow-up mr-1"></i>
                    {{ $submissions->where('created_at', '>=', now()->subDays(30))->count() ?? 0 }} this month
                </div>
            </div>
            <!-- Print button removed for personnel -->
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 fade-in mb-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Enhanced Search Bar with Filter Dropdowns -->
    <x-admin.search-bar
        :route="route('personnel.phs.index')"
        placeholder="Search by section, status, or any field..."
        :filters="[
            'status' => [
                'pending' => 'Pending',
                'reviewed' => 'Reviewed',
                'approved' => 'Approved',
                'rejected' => 'Rejected'
            ],
            'date_range' => true
        ]"
    />

    <!-- Enhanced Statistics Cards - Time-based -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-[#1B365D]/10 to-[#2B4B7D]/10 rounded-xl shadow-sm p-6 border border-[#1B365D]/20 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-[#1B365D]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar-day text-[#1B365D] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Today</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $submissions->where('created_at', '>=', now()->startOfDay())->count() ?? 0 }}</p>
                    <p class="text-xs text-[#1B365D] mt-1">
                        <i class="fas fa-clock mr-1"></i>
                        {{ now()->format('M d, Y') }}
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
                    <p class="text-2xl font-bold text-gray-900">{{ $submissions->where('created_at', '>=', now()->startOfWeek())->count() ?? 0 }}</p>
                    <p class="text-xs text-[#D4AF37] mt-1">
                        <i class="fas fa-calendar mr-1"></i>
                        Week {{ now()->weekOfYear }}
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
                    <p class="text-2xl font-bold text-gray-900">{{ $submissions->where('created_at', '>=', now()->startOfMonth())->count() ?? 0 }}</p>
                    <p class="text-xs text-[#1B365D] mt-1">
                        <i class="fas fa-calendar mr-1"></i>
                        {{ now()->format('M Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Results Count and Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-4 rounded-xl shadow-sm border border-gray-200">
        <div class="flex items-center gap-4">
            <div class="text-sm text-gray-600">
                <span class="font-medium">{{ $submissions->firstItem() ?? 0 }}</span> to 
                <span class="font-medium">{{ $submissions->lastItem() ?? 0 }}</span> of 
                <span class="font-medium">{{ $submissions->total() ?? 0 }}</span> results
            </div>
            @if($submissions->total() > 0)
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

    <!-- Enhanced Submissions Table -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-[#1B365D]/10 to-[#2B4B7D]/10">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Section</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Submitted Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Last Updated</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($submissions as $submission)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] rounded-full flex items-center justify-center text-white text-base font-bold border border-[#1B365D] shadow-sm">
                                    {{ strtoupper(substr($submission->user->first_name, 0, 1)) }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $submission->user->first_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $submission->user->username }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                @if($submission->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                @elseif($submission->status === 'reviewed') bg-blue-100 text-blue-800 border border-blue-200
                                @elseif($submission->status === 'approved') bg-green-100 text-green-800 border border-green-200
                                @else bg-red-100 text-red-800 border border-red-200
                                @endif">
                                <i class="fas 
                                    @if($submission->status === 'pending') fa-clock
                                    @elseif($submission->status === 'reviewed') fa-eye
                                    @elseif($submission->status === 'approved') fa-check-circle
                                    @else fa-times-circle
                                    @endif mr-1"></i>
                                {{ ucfirst($submission->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $submission->created_at->format('M d, Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $submission->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $submission->updated_at->format('M d, Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $submission->updated_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('personnel.phs.show', $submission->id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] text-white rounded-lg hover:from-[#2B4B7D] hover:to-[#1B365D] focus:outline-none focus:ring-2 focus:ring-[#1B365D] focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 shadow">
                                    <i class="fas fa-eye mr-1"></i> View
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-4"></i>
                            <div>No PHS submissions found.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 