@extends('layouts.admin')

@section('title', 'Edit User')

@section('header', 'Edit User')

@section('content')
<div class="max-w-3xl mx-auto py-4">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
        <div>
            <h2 class="text-xl font-bold text-[#1B365D] flex items-center gap-2">
                <i class="fas fa-user-edit text-[#1B365D] text-base"></i> Edit User
            </h2>
            <p class="text-gray-500 mt-1 text-sm">Modify user account details below.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-[#1B365D] text-[#1B365D] bg-white hover:bg-[#1B365D] hover:text-white rounded-lg font-medium shadow-sm transition text-sm">
            <i class="fas fa-arrow-left mr-2"></i> Back to Users
        </a>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl p-3 fade-in mb-3 text-sm">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
            <span class="text-sm text-red-700 font-medium">Please correct the following errors:</span>
        </div>
        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-3 py-2 rounded-xl mb-3 flex items-center gap-2 text-sm" role="alert">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg p-4">
        <!-- Instruction -->
        <div class="mb-4 flex items-center gap-2">
            <i class="fas fa-info-circle text-blue-500 text-xs"></i>
            <span class="text-red-500 text-xs font-semibold">Only <strong>User Type</strong> and <strong>Status</strong> can be edited. Make changes to these fields to enable the Update button.</span>
        </div>
        <div class="border-b border-gray-200 mb-4"></div>
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5" id="edit-user-form">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="username" class="block text-xs font-semibold text-gray-700 mb-1">Username</label>
                    <div class="relative">
                        <input type="text" id="username" value="{{ $user->username }}" disabled
                            class="block w-full rounded-lg border border-gray-200 bg-gray-100 text-gray-500 px-3 py-1.5 shadow-sm focus:outline-none cursor-not-allowed text-xs">
                        <span class="absolute right-2 top-1.5 text-gray-400 text-xs" title="This field cannot be edited."><i class="fas fa-lock"></i></span>
                    </div>
                </div>
                <div>
                    <label for="name" class="block text-xs font-semibold text-gray-700 mb-1">Full Name</label>
                    <div class="relative">
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required disabled
                            class="block w-full rounded-lg border border-gray-200 bg-gray-100 text-gray-500 px-3 py-1.5 shadow-sm focus:outline-none cursor-not-allowed text-xs">
                        <span class="absolute right-2 top-1.5 text-gray-400 text-xs" title="This field cannot be edited."><i class="fas fa-lock"></i></span>
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required disabled
                            class="block w-full rounded-lg border border-gray-200 bg-gray-100 text-gray-500 px-3 py-1.5 shadow-sm focus:outline-none cursor-not-allowed text-xs">
                        <span class="absolute right-2 top-1.5 text-gray-400 text-xs" title="This field cannot be edited."><i class="fas fa-lock"></i></span>
                    </div>
                </div>
                <div>
                    <label for="branch" class="block text-xs font-semibold text-gray-700 mb-1">Branch</label>
                    <div class="relative">
                        <input type="text" name="branch" id="branch" value="{{ old('branch', $user->branch) }}" required disabled
                            class="block w-full rounded-lg border border-gray-200 bg-gray-100 text-gray-500 px-3 py-1.5 shadow-sm focus:outline-none cursor-not-allowed text-xs">
                        <span class="absolute right-2 top-1.5 text-gray-400 text-xs" title="This field cannot be edited."><i class="fas fa-lock"></i></span>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-1">
                <div>
                    <label for="usertype" class="block text-xs font-semibold text-gray-700 mb-1">User Type <span class="text-blue-500" title="Editable"><i class="fas fa-edit"></i></span></label>
                    <select name="usertype" id="usertype" required
                        class="mt-1 block w-full rounded-lg border border-blue-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white px-3 py-1.5">
                        <option value="admin" {{ old('usertype', $user->usertype) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="personnel" {{ old('usertype', $user->usertype) == 'personnel' ? 'selected' : '' }}>Personnel</option>
                        <option value="client" {{ old('usertype', $user->usertype) == 'client' ? 'selected' : '' }}>Client</option>
                    </select>
                </div>
                <div>
                    <label for="is_active" class="block text-xs font-semibold text-gray-700 mb-1">Status <span class="text-blue-500" title="Editable"><i class="fas fa-edit"></i></span></label>
                    <div class="flex items-center gap-3 mt-1">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" id="is_active_checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                class="rounded border-blue-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <span class="ml-2 text-xs text-gray-700">Active</span>
                        </label>
                        <span class="text-xs text-gray-400" title="Check to activate user, uncheck to disable."><i class="fas fa-info-circle"></i> Toggle user status</span>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" id="updateUserBtn" onclick="confirmUserUpdate()" class="inline-flex items-center gap-2 px-6 py-2 rounded-lg font-semibold text-base shadow transition bg-gradient-to-r from-blue-600 to-blue-800 text-white hover:from-blue-700 hover:to-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    <i class="fas fa-save"></i> Update User
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Confirmation Modal for User Update -->
<x-confirmation-modal 
    id="userUpdateModal"
    title="Confirm User Update"
    message="Are you sure you want to update this user's information? This action cannot be undone."
    confirmText="Update User"
    cancelText="Cancel"
    confirmClass="bg-[#1B365D] hover:bg-[#2B4B7D]"
/>

@endsection

@push('scripts')
<script>
// Track original values
const originalUsertype = "{{ old('usertype', $user->usertype) }}";
const originalIsActive = "{{ old('is_active', $user->is_active) ? '1' : '0' }}";

function checkIfChanged() {
    const usertype = document.getElementById('usertype').value;
    const isActive = document.getElementById('is_active_checkbox').checked ? '1' : '0';
    const updateBtn = document.getElementById('updateUserBtn');
    if (usertype !== originalUsertype || isActive !== originalIsActive) {
        updateBtn.disabled = false;
        updateBtn.style.opacity = 1;
        updateBtn.style.cursor = 'pointer';
    } else {
        updateBtn.disabled = true;
        updateBtn.style.opacity = 0.5;
        updateBtn.style.cursor = 'not-allowed';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('usertype').addEventListener('change', checkIfChanged);
    document.getElementById('is_active_checkbox').addEventListener('change', checkIfChanged);
    checkIfChanged();
});

function confirmUserUpdate() {
    showConfirmationModal(
        'userUpdateModal',
        'Are you sure you want to update this user\'s information? This action cannot be undone.',
        function() {
            document.getElementById('edit-user-form').submit();
        }
    );
}
</script>
@endpush 