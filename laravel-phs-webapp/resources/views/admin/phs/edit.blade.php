@extends('layouts.admin')

@section('title', 'Edit PHS Submission')

@section('header', 'Edit PHS Submission')

@section('content')
<div class="space-y-6">
    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <form action="{{ route('admin.phs.update', $submission->id) }}" method="POST" class="space-y-6" id="phs-edit-form">
            @csrf
            @method('PUT')

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50">
                    <option value="pending" {{ $submission->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="reviewed" {{ $submission->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                    <option value="approved" {{ $submission->status === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $submission->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Admin Notes -->
            <div>
                <label for="admin_notes" class="block text-sm font-medium text-gray-700">Admin Notes</label>
                <textarea name="admin_notes" id="admin_notes" rows="4" 
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring focus:ring-[#1B365D] focus:ring-opacity-50"
                    placeholder="Add any notes or comments about this submission...">{{ old('admin_notes', $submission->admin_notes) }}</textarea>
                @error('admin_notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.phs.show', $submission->id) }}" class="btn-secondary inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
                <button type="button" onclick="confirmPHSUpdate()" class="btn-primary inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                    <i class="fas fa-save mr-2"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Submission Preview -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Submission Preview</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Applicant Info -->
            <div>
                <h4 class="text-sm font-medium text-gray-700 mb-2">Applicant Information</h4>
                <div class="space-y-2">
                    <p class="text-sm text-gray-900"><span class="font-medium">Name:</span> {{ $submission->user->name }}</p>
                    <p class="text-sm text-gray-900"><span class="font-medium">Username:</span> {{ $submission->user->username }}</p>
                    <p class="text-sm text-gray-900"><span class="font-medium">Email:</span> {{ $submission->user->email }}</p>
                </div>
            </div>

            <!-- Submission Info -->
            <div>
                <h4 class="text-sm font-medium text-gray-700 mb-2">Submission Information</h4>
                <div class="space-y-2">
                    <p class="text-sm text-gray-900"><span class="font-medium">Submitted:</span> {{ $submission->created_at->format('M d, Y h:i A') }}</p>
                    <p class="text-sm text-gray-900"><span class="font-medium">Last Updated:</span> {{ $submission->updated_at->format('M d, Y h:i A') }}</p>
                    <p class="text-sm text-gray-900">
                        <span class="font-medium">Current Status:</span>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                            @if($submission->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($submission->status === 'reviewed') bg-blue-100 text-blue-800
                            @elseif($submission->status === 'approved') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($submission->status) }}
                        </span>
                    </p>
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