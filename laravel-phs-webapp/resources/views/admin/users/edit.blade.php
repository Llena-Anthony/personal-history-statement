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
            <p class="text-gray-500 mt-1 text-sm">Edit user account details below.</p>
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

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-800 px-3 py-2 rounded-xl mb-3 flex items-center gap-2 text-sm" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" id="updateUserForm">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-2xl shadow-lg p-4">
            <!-- Instruction -->
            <div class="mb-4 flex items-center gap-2">
                <i class="fas fa-info-circle text-blue-500 text-xs"></i>
                <span class="text-gray-500 text-xs font-semibold">Only user type and status can be edited. Other fields are read-only.</span>
            </div>
            <div class="border-b border-gray-200 mb-4"></div>
            <div class="space-y-5">
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
                        <label for="usertype" class="block text-xs font-semibold text-gray-700 mb-1">User Type <span class="text-red-500">*</span></label>
                        <select name="usertype" id="usertype" required
                            class="block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white text-gray-900 px-3 py-1.5">
                            <option value="admin" {{ old('usertype', $user->usertype) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="personnel" {{ old('usertype', $user->usertype) == 'personnel' ? 'selected' : '' }}>Personnel</option>
                            <option value="client" {{ old('usertype', $user->usertype) == 'client' ? 'selected' : '' }}>Client</option>
                        </select>
                    </div>
                    <div>
                        <label for="is_active" class="block text-xs font-semibold text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                        <select name="is_active" id="is_active" required
                            class="block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white text-gray-900 px-3 py-1.5">
                            <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="flex justify-end pt-4 border-t border-gray-200">
                    <button type="button" id="updateBtn" class="inline-flex items-center px-4 py-2 bg-[#1B365D] border border-transparent rounded-lg font-medium text-white hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition text-sm">
                        <i class="fas fa-save mr-2"></i>
                        <span id="btnText">Update User</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const updateBtn = document.getElementById('updateBtn');
    const btnText = document.getElementById('btnText');
    const form = document.getElementById('updateUserForm');
    const usertypeSelect = document.getElementById('usertype');
    const isActiveSelect = document.getElementById('is_active');
    
    let isConfirming = false;
    let hasChanges = false;
    
    // Store original values
    const originalValues = {
        usertype: usertypeSelect.value,
        is_active: isActiveSelect.value
    };

    // Function to check if form has changes
    function checkForChanges() {
        const currentValues = {
            usertype: usertypeSelect.value,
            is_active: isActiveSelect.value
        };
        
        hasChanges = (currentValues.usertype !== originalValues.usertype || 
                     currentValues.is_active !== originalValues.is_active);
        
        updateButtonState();
    }

    // Function to update button state
    function updateButtonState() {
        if (!hasChanges) {
            // Disable button when no changes
            updateBtn.disabled = true;
            updateBtn.classList.add('opacity-50', 'cursor-not-allowed');
            updateBtn.classList.remove('hover:bg-[#2B4B7D]', 'focus:ring-[#1B365D]');
            btnText.textContent = 'Update User';
            updateBtn.querySelector('i').className = 'fas fa-save mr-2';
        } else {
            // Enable button when there are changes
            updateBtn.disabled = false;
            updateBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            updateBtn.classList.add('hover:bg-[#2B4B7D]', 'focus:ring-[#1B365D]');
            btnText.textContent = 'Update User';
            updateBtn.querySelector('i').className = 'fas fa-save mr-2';
        }
    }

    // Listen for changes on form fields
    usertypeSelect.addEventListener('change', checkForChanges);
    isActiveSelect.addEventListener('change', checkForChanges);

    updateBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Don't allow action if no changes
        if (!hasChanges) {
            return;
        }
        
        if (!isConfirming) {
            // First click - show confirmation
            updateBtn.classList.remove('bg-[#1B365D]', 'hover:bg-[#2B4B7D]', 'focus:ring-[#1B365D]');
            updateBtn.classList.add('bg-green-600', 'hover:bg-green-700', 'focus:ring-green-500');
            btnText.textContent = 'Save Changes';
            updateBtn.querySelector('i').className = 'fas fa-check mr-2';
            isConfirming = true;
            
            // Add a timeout to reset if user doesn't confirm within 10 seconds
            setTimeout(() => {
                if (isConfirming) {
                    resetButton();
                }
            }, 10000);
        } else {
            // Second click - submit the form
            form.submit();
        }
    });

    function resetButton() {
        if (hasChanges) {
            updateBtn.classList.remove('bg-green-600', 'hover:bg-green-700', 'focus:ring-green-500');
            updateBtn.classList.add('bg-[#1B365D]', 'hover:bg-[#2B4B7D]', 'focus:ring-[#1B365D]');
            btnText.textContent = 'Update User';
            updateBtn.querySelector('i').className = 'fas fa-save mr-2';
        } else {
            updateButtonState(); // Reset to disabled state
        }
        isConfirming = false;
    }

    // Reset button if user navigates away or clicks elsewhere
    document.addEventListener('click', function(e) {
        if (!updateBtn.contains(e.target) && isConfirming) {
            resetButton();
        }
    });

    // Initialize button state
    checkForChanges();
});
</script>

@endsection 