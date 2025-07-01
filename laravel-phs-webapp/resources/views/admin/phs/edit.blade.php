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
            <p class="text-gray-600 mt-2">Update submission status and add administrative notes</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="text-sm text-gray-500 font-medium">Applicant</div>
                <div class="text-2xl font-bold text-[#1B365D]">{{ $submission->user->name }}</div>
                <div class="text-xs text-gray-500 mt-1">{{ $submission->user->username }}</div>
            </div>
            <a href="{{ route('admin.phs.show', $submission->id) }}" 
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
                    <p class="text-sm font-medium text-gray-600">Submitted</p>
                    <p class="text-lg font-bold text-gray-900">{{ $submission->created_at->format('M d, Y') }}</p>
                    <p class="text-sm text-gray-500">{{ $submission->created_at->format('h:i A') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500/20 to-green-600/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Last Updated</p>
                    <p class="text-lg font-bold text-gray-900">{{ $submission->updated_at->format('M d, Y') }}</p>
                    <p class="text-sm text-gray-500">{{ $submission->updated_at->format('h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
            <i class="fas fa-edit text-[#1B365D] mr-3"></i>
            Update Submission Status
        </h3>
        <form action="{{ route('admin.phs.update', $submission->id) }}" method="POST" class="space-y-6" id="phs-edit-form">
            @csrf
            @method('PUT')

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Submission Status</label>
                <select name="status" id="status" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50 transition-colors">
                    <option value="pending" {{ $submission->status === 'pending' ? 'selected' : '' }}>⏳ Pending Review</option>
                    <option value="reviewed" {{ $submission->status === 'reviewed' ? 'selected' : '' }}>👁️ Reviewed</option>
                    <option value="approved" {{ $submission->status === 'approved' ? 'selected' : '' }}>✅ Approved</option>
                    <option value="rejected" {{ $submission->status === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                </select>
                @error('status')
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
                    placeholder="Add any notes, comments, or feedback about this submission...">{{ old('admin_notes', $submission->admin_notes) }}</textarea>
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
                <a href="{{ route('admin.phs.show', $submission->id) }}" class="btn-secondary inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200">
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
            Submission Summary
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Applicant Info -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Applicant Information</h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Full Name:</span>
                        <span class="text-sm text-gray-900">{{ $submission->user->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Username:</span>
                        <span class="text-sm text-gray-900">{{ $submission->user->username }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Email Address:</span>
                        <span class="text-sm text-gray-900">{{ $submission->user->email }}</span>
                    </div>
                </div>
            </div>

            <!-- Submission Info -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Submission Information</h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Submitted:</span>
                        <span class="text-sm text-gray-900">{{ $submission->created_at->format('M d, Y h:i A') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Last Updated:</span>
                        <span class="text-sm text-gray-900">{{ $submission->updated_at->format('M d, Y h:i A') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Current Status:</span>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full 
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
                    </div>
                </div>
            </div>
        </div>

        @if($submission->admin_notes)
        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <h4 class="text-sm font-semibold text-yellow-800 mb-2 flex items-center">
                <i class="fas fa-sticky-note mr-2"></i>
                Current Admin Notes
            </h4>
            <p class="text-sm text-yellow-700">{{ $submission->admin_notes }}</p>
        </div>
        @endif
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
    const status = document.getElementById('status').value;
    const statusText = status.charAt(0).toUpperCase() + status.slice(1);
    
    showConfirmationModal(
        'phsUpdateModal',
        `Are you sure you want to update this PHS submission status to "${statusText}"? This action cannot be undone.`,
        function() {
            document.getElementById('phs-edit-form').submit();
        }
    );
}
</script>
@endpush 