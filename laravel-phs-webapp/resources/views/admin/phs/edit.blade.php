@extends('layouts.admin')

@section('title', 'Edit PHS Submission')

@section('header', 'Edit PHS Submission')

@section('content')
<div class="space-y-6">
    <!-- Enhanced Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1B365D] flex items-center gap-3">
                <div class="bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] text-white p-3 rounded-xl shadow-lg">
                    <i class="fas fa-edit text-xl"></i>
                </div>
                Edit PHS Submission
            </h1>
            <p class="text-gray-600 mt-2">Update submission status and admin notes</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.phs.show', $user->username) }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:from-gray-600 hover:to-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 shadow-lg">
                <i class="fas fa-eye mr-2"></i>
                View Details
            </a>
        </div>
    </div>

    <!-- Current Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#1B365D]/20 to-[#2B4B7D]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-flag text-[#1B365D] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Current Status</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                        @if($user->phs_status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                        @elseif($user->phs_status === 'in_progress') bg-blue-100 text-blue-800 border border-blue-200
                        @elseif($user->phs_status === 'completed') bg-green-100 text-green-800 border border-green-200
                        @elseif($user->phs_status === 'reviewed') bg-purple-100 text-purple-800 border border-purple-200
                        @elseif($user->phs_status === 'approved') bg-green-100 text-green-800 border border-green-200
                        @else bg-red-100 text-red-800 border border-red-200
                        @endif">
                        <i class="fas 
                            @if($user->phs_status === 'pending') fa-clock
                            @elseif($user->phs_status === 'in_progress') fa-spinner
                            @elseif($user->phs_status === 'completed') fa-check
                            @elseif($user->phs_status === 'reviewed') fa-eye
                            @elseif($user->phs_status === 'approved') fa-check-circle
                            @else fa-times-circle
                            @endif mr-1"></i>
                        {{ ucfirst(str_replace('_', ' ', $user->phs_status)) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#D4AF37]/20 to-[#B38F2A]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar text-[#D4AF37] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Last Login</p>
                    <p class="text-lg font-bold text-gray-900">{{ $user->last_login_at ? $user->last_login_at->format('M d, Y') : 'Never' }}</p>
                    <p class="text-sm text-gray-500">{{ $user->last_login_at ? $user->last_login_at->format('h:i A') : 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500/20 to-green-600/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">User Type</p>
                    <p class="text-lg font-bold text-gray-900">{{ ucfirst($user->usertype) }}</p>
                    <p class="text-sm text-gray-500">{{ $user->organic_role }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
            <i class="fas fa-edit text-[#1B365D] mr-3"></i>
            Update PHS Status
        </h3>
        <form action="{{ route('admin.phs.update', $user->username) }}" method="POST" class="space-y-6" id="phs-edit-form">
            @csrf
            @method('PUT')

            <!-- Status -->
            <div>
                <label for="phs_status" class="block text-sm font-semibold text-gray-700 mb-2">PHS Status</label>
                <select name="phs_status" id="phs_status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50 transition-colors">
                    <option value="pending" {{ $user->phs_status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="in_progress" {{ $user->phs_status === 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                    <option value="completed" {{ $user->phs_status === 'completed' ? 'selected' : '' }}>✅ Completed</option>
                    <option value="reviewed" {{ $user->phs_status === 'reviewed' ? 'selected' : '' }}>👁️ Reviewed</option>
                    <option value="approved" {{ $user->phs_status === 'approved' ? 'selected' : '' }}>✅ Approved</option>
                    <option value="rejected" {{ $user->phs_status === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                </select>
                @error('phs_status')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Admin Notes -->
            <div>
                <label for="admin_notes" class="block text-sm font-semibold text-gray-700 mb-2">Administrative Notes</label>
                <textarea name="admin_notes" id="admin_notes" rows="4" 
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50 transition-colors"
                    placeholder="Add any notes, comments, or feedback about this submission...">{{ old('admin_notes') }}</textarea>
                <p class="mt-2 text-sm text-gray-500">Optional notes for internal reference or applicant feedback</p>
                @error('admin_notes')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.phs.show', $user->username) }}" class="btn-secondary inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
                <button type="button" onclick="confirmPHSUpdate()" class="btn-primary inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200">
                    <i class="fas fa-save mr-2"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Submission Preview -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
            <i class="fas fa-info-circle text-[#1B365D] mr-3"></i>
            User Information
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Applicant Info -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Applicant Information</h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Full Name:</span>
                        <span class="text-sm text-gray-900">{{ optional(optional($user->userDetail)->nameDetail)->first_name }} {{ optional(optional($user->userDetail)->nameDetail)->last_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Username:</span>
                        <span class="text-sm text-gray-900">{{ $user->username }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Email Address:</span>
                        <span class="text-sm text-gray-900">{{ $user->userDetail->email_addr ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Submission Info -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Account Information</h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">User Type:</span>
                        <span class="text-sm text-gray-900">{{ ucfirst($user->usertype) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Organic Role:</span>
                        <span class="text-sm text-gray-900">{{ $user->organic_role }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Current Status:</span>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full 
                            @if($user->phs_status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                            @elseif($user->phs_status === 'in_progress') bg-blue-100 text-blue-800 border border-blue-200
                            @elseif($user->phs_status === 'completed') bg-green-100 text-green-800 border border-green-200
                            @elseif($user->phs_status === 'reviewed') bg-purple-100 text-purple-800 border border-purple-200
                            @elseif($user->phs_status === 'approved') bg-green-100 text-green-800 border border-green-200
                            @else bg-red-100 text-red-800 border border-red-200
                            @endif">
                            <i class="fas 
                                @if($user->phs_status === 'pending') fa-clock
                                @elseif($user->phs_status === 'in_progress') fa-spinner
                                @elseif($user->phs_status === 'completed') fa-check
                                @elseif($user->phs_status === 'reviewed') fa-eye
                                @elseif($user->phs_status === 'approved') fa-check-circle
                                @else fa-times-circle
                                @endif mr-1"></i>
                            {{ ucfirst(str_replace('_', ' ', $user->phs_status)) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal for PHS Update -->
<x-confirmation-modal 
    id="phsUpdateModal"
    title="Confirm PHS Status Update"
    message="Are you sure you want to update this PHS submission status? This action cannot be undone."
    confirmText="Update Status"
    cancelText="Cancel"
    confirmClass="bg-[#1B365D] hover:bg-[#2B4B7D]"
/>

@endsection

@push('scripts')
<script>
function confirmPHSUpdate() {
    const status = document.getElementById('phs_status').value;
    const statusText = status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
    
    showConfirmationModal(
        'phsUpdateModal',
        `Are you sure you want to update this PHS status to "${statusText}"? This action cannot be undone.`,
        function() {
            document.getElementById('phs-edit-form').submit();
        }
    );
}
</script>
@endpush 