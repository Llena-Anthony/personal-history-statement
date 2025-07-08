@extends('layouts.admin')

@section('title', 'PHS Submissions')

@section('header', 'PHS Submissions')

@section('content')
<div class="space-y-6">
    <!-- Enhanced Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1B365D] flex items-center gap-3">
                <div class="bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] text-white p-3 rounded-xl shadow-lg">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
                PHS Submissions
            </h1>
            <p class="text-gray-600 mt-2">Manage Personal History Statement submissions and review applicant data</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-sm text-gray-500 font-medium">Total Submissions</div>
                <div class="text-3xl font-bold text-[#1B365D]">{{ $submissions->total() }}</div>
                <div class="text-xs text-green-600 mt-1">
                    <i class="fas fa-arrow-up mr-1"></i>
                    {{ $submissions->where('created_at', '>=', now()->subDays(30))->count() }} this month
                </div>
            </div>
            <a href="#" onclick="printTemplateDirect(event)"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl hover:from-emerald-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 shadow-lg">
                <i class="fas fa-print mr-2"></i>
                Print Template
            </a>
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
        :route="route('admin.phs.index')"
        placeholder="Search by name, username, status, notes, or any field..."
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
                    <p class="text-2xl font-bold text-gray-900">{{ $submissions->where('created_at', '>=', now()->startOfDay())->count() }}</p>
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
                    <p class="text-2xl font-bold text-gray-900">{{ $submissions->where('created_at', '>=', now()->startOfWeek())->count() }}</p>
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
                    <p class="text-2xl font-bold text-gray-900">{{ $submissions->where('created_at', '>=', now()->startOfMonth())->count() }}</p>
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
                <span class="font-medium">{{ $submissions->total() }}</span> results
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
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Applicant</th>
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
                                    {{ strtoupper(substr(optional(optional($submission->userDetail)->nameDetail)->first_name ?? $submission->username, 0, 1)) }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ optional(optional($submission->userDetail)->nameDetail)->first_name }} {{ optional(optional($submission->userDetail)->nameDetail)->last_name }}
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $submission->username }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                @if($submission->phs_status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                @elseif($submission->phs_status === 'reviewed') bg-blue-100 text-blue-800 border border-blue-200
                                @elseif($submission->phs_status === 'approved') bg-green-100 text-green-800 border border-green-200
                                @else bg-red-100 text-red-800 border border-red-200
                                @endif">
                                <i class="fas 
                                    @if($submission->phs_status === 'pending') fa-clock
                                    @elseif($submission->phs_status === 'reviewed') fa-eye
                                    @elseif($submission->phs_status === 'approved') fa-check-circle
                                    @else fa-times-circle
                                    @endif mr-1"></i>
                                {{ ucfirst($submission->phs_status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $submission->last_login_at ? $submission->last_login_at->format('M d, Y') : 'N/A' }}</div>
                            <div class="text-sm text-gray-500">{{ $submission->last_login_at ? $submission->last_login_at->format('h:i A') : 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $submission->last_login_at ? $submission->last_login_at->format('M d, Y') : 'N/A' }}</div>
                            <div class="text-sm text-gray-500">{{ $submission->last_login_at ? $submission->last_login_at->format('h:i A') : 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.phs.show', $submission->username) }}" 
                                   class="inline-flex items-center p-2 text-[#1B365D] hover:text-[#2B4B7D] hover:bg-[#1B365D]/10 rounded-lg transition-colors" 
                                   title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.phs.edit', $submission->username) }}" 
                                   class="inline-flex items-center p-2 text-[#1B365D] hover:text-[#2B4B7D] hover:bg-[#1B365D]/10 rounded-lg transition-colors" 
                                   title="Edit Submission">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.phs.print', $submission->username) }}" 
                                   class="inline-flex items-center p-2 text-emerald-600 hover:text-emerald-700 hover:bg-emerald-50 rounded-lg transition-colors" 
                                   title="Print PHS" 
                                   target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
                                <button type="button" 
                                        onclick="confirmPHSDelete('{{ $submission->username }}', '{{ optional(optional($submission->userDetail)->nameDetail)->first_name }} {{ optional(optional($submission->userDetail)->nameDetail)->last_name }}')" 
                                        class="inline-flex items-center p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors" 
                                        title="Delete Submission">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-file-alt text-gray-400 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No PHS Submissions Found</h3>
                                <p class="text-gray-500">No submissions match your current search criteria.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Enhanced Pagination -->
        @if($submissions->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $submissions->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Confirmation Modal for PHS Delete -->
<x-confirmation-modal
    id="phsDeleteModal"
    title="Confirm PHS Deletion"
    message="Are you sure you want to delete this PHS submission? This action cannot be undone."
    confirmText="Delete Submission"
    cancelText="Cancel"
    confirmClass="bg-red-600 hover:bg-red-700"
/>

<!-- Hidden form for delete -->
<form id="delete-phs-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmPHSDelete(username, userName) {
    showConfirmationModal(
        'phsDeleteModal',
        `Are you sure you want to delete the PHS submission for "${userName}"? This action cannot be undone and will permanently remove all associated data.`,
        function() {
            const form = document.getElementById('delete-phs-form');
            form.action = '{{ route("admin.phs.destroy", ":username") }}'.replace(':username', username);
            form.submit();
        }
    );
}

function printTemplateDirect(event) {
    event.preventDefault();
    // Remove any existing iframe
    let oldIframe = document.getElementById('print-template-iframe');
    if (oldIframe) oldIframe.remove();
    // Create a hidden iframe
    let iframe = document.createElement('iframe');
    iframe.style.display = 'none';
    iframe.id = 'print-template-iframe';
    iframe.src = "{{ route('admin.phs.preview') }}";
    document.body.appendChild(iframe);
    iframe.onload = function() {
        setTimeout(function() {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        }, 300);
    };
}
</script>
@endsection
