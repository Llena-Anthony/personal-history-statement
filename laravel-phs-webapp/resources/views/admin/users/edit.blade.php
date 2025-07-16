@extends('layouts.admin')

@section('title', 'Edit User')

@section('header', 'Edit User')

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <!-- Enhanced Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6 gap-4">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
                <i class="fas fa-user-edit text-white text-xl"></i>
            </div>
        <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit User</h1>
                <p class="text-gray-600 mt-1">Update user account settings and permissions</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-[#1B365D] text-[#1B365D] bg-white hover:bg-[#1B365D] hover:text-white rounded-xl font-medium shadow-sm transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Users
            </a>
        </div>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-2xl p-4 mb-6 animate-fade-in">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
        </div>
            <div class="ml-3">
                <h3 class="text-sm font-semibold text-red-800">Please correct the following errors:</h3>
                <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-2xl mb-6 flex items-center gap-3 animate-fade-in" role="alert">
        <i class="fas fa-exclamation-circle text-lg"></i>
        <span class="font-medium">{{ session('error') }}</span>
    </div>
    @endif

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-2xl mb-6 flex items-center gap-3 animate-fade-in" role="alert">
        <i class="fas fa-check-circle text-lg"></i>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" id="updateUserForm">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Form Card -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden h-full" id="user-info-card">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-[#1B365D]/10 to-[#2B4B7D]/10 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-edit text-[#1B365D] mr-3"></i>
                                <h2 class="text-lg font-semibold text-gray-900">User Information</h2>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full @if($user->is_active) bg-green-500 @else bg-red-500 @endif border-2 border-white shadow-sm"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="p-6 space-y-6">
                        <!-- Read-only Information Section -->
                    <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-info-circle text-[#1B365D] mr-2"></i>
                                Account Details (Read-only)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                                    <div class="relative">
                                        <input type="text" value="{{ $user->username }}" disabled
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600 cursor-not-allowed">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                    <div class="relative">
                                        <input type="text" value="{{ $user->first_name }}" disabled
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600 cursor-not-allowed">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                                        <input type="email" value="{{ $user->userDetail->email_addr ?? '' }}" disabled
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600 cursor-not-allowed">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                        </div>
                    </div>
                                
                                <div class="form-group">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Organic Group</label>
                        <div class="relative">
                                        <input type="text" value="{{ $user->organic_role ?? 'N/A' }}" disabled
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600 cursor-not-allowed">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <i class="fas fa-lock text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Editable Settings Section -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                                <i class="fas fa-cog text-[#D4AF37] mr-2"></i>
                                Account Settings (Editable)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="form-group">
                                    <label for="usertype" class="block text-sm font-medium text-gray-700 mb-2">
                                        User Type <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select name="usertype" id="usertype" required
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-all duration-200">
                                            <option value="admin" {{ old('usertype', $user->usertype) == 'admin' ? 'selected' : '' }}>
                                                <i class="fas fa-shield-alt"></i> Admin
                                            </option>
                                            <option value="personnel" {{ old('usertype', $user->usertype) == 'personnel' ? 'selected' : '' }}>
                                                <i class="fas fa-user-tie"></i> Personnel
                                            </option>
                                            <option value="client" {{ old('usertype', $user->usertype) == 'client' ? 'selected' : '' }}>
                                                <i class="fas fa-user"></i> Client
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">
                                        Account Status <span class="text-red-500">*</span>
                                    </label>
                        <div class="relative">
                                        <select name="is_active" id="is_active" required
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-all duration-200">
                                            <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>
                                                <i class="fas fa-check-circle"></i> Active
                                            </option>
                                            <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>
                                                <i class="fas fa-times-circle"></i> Disabled
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden h-full flex flex-col" id="user-profile-card">
                    <!-- Card Header -->
                    <div class="bg-gradient-to-r from-[#D4AF37]/10 to-[#B38F2A]/10 px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-user-circle text-[#D4AF37] mr-3"></i>
                            User Profile
                        </h2>
                    </div>

                    <!-- Profile Content -->
                    <div class="p-6">
                        <!-- User Avatar -->
                        <div class="text-center mb-6">
                            <div class="w-20 h-20 rounded-full mx-auto mb-3 shadow-lg overflow-hidden">
                                <img src="{{ $user->userDetail && $user->userDetail->profile_path ? asset('storage/' . $user->userDetail->profile_path) : asset('images/default-avatar.svg') }}" 
                                     alt="{{ $user->first_name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <h3 class="font-semibold text-gray-900">{{ $user->first_name }}</h3>
                            <p class="text-sm text-gray-500">{{'@'. $user->username }}</p>
                        </div>

                        <!-- User Stats -->
                        <div class="space-y-4">
                            <div class="bg-[#1B365D]/10 rounded-xl p-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-[#1B365D]">User Type</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        @if($user->usertype == 'admin') bg-[#1B365D]/20 text-[#1B365D] border border-[#1B365D]/30
                                        @elseif($user->usertype == 'personnel') bg-[#D4AF37]/20 text-[#D4AF37] border border-[#D4AF37]/30
                                        @else bg-[#1B365D]/20 text-[#1B365D] border border-[#1B365D]/30 @endif">
                                        {{ ucfirst($user->usertype) }}
                                    </span>
                                </div>
                            </div>

                            <div class="bg-[#D4AF37]/10 rounded-xl p-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-[#D4AF37]">Account Status</span>
                                    <span class="text-sm font-medium @if($user->is_active) text-[#1B365D] @else text-[#D4AF37] @endif">
                                        {{ $user->is_active ? 'Active' : 'Disabled' }}
                                    </span>
                                </div>
                            </div>

                            <div class="bg-[#1B365D]/10 rounded-xl p-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-medium text-[#1B365D]">Member Since</span>
                                    <span class="text-sm text-gray-600">{{ $user->created_at ? $user->created_at->format('M Y') : 'N/A' }}</span>
                                </div>
                    </div>
                </div>
                
                        <!-- Action Buttons -->
                        <div class="mt-6 space-y-3">
                            <button type="button" id="updateBtn" 
                                    class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] text-white rounded-xl font-medium hover:from-[#2B4B7D] hover:to-[#1B365D] focus:outline-none focus:ring-2 focus:ring-[#1B365D] focus:ring-offset-2 transition-all duration-200 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-save mr-2"></i>
                        <span id="btnText">Update User</span>
                    </button>
                            
                            <a href="{{ route('admin.users.show', $user) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition-all duration-200">
                                <i class="fas fa-eye mr-2"></i>
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

.form-group {
    transition: all 0.2s ease;
}

.form-group:focus-within {
    transform: translateY(-1px);
}

/* Enhanced select styling */
select:focus {
    box-shadow: 0 0 0 3px rgba(27, 54, 93, 0.1);
}

/* Make user profile sidebar match user info card height */
@media (min-width: 1024px) {
  #user-profile-card {
    height: 100%;
    min-height: 100%;
    display: flex;
    flex-direction: column;
  }
  .grid-cols-3 > #user-profile-card {
    height: 100%;
  }
  .grid-cols-3 > #user-info-card {
    height: 100%;
  }
  .grid-cols-3 {
    align-items: stretch;
  }
}
</style>

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
            updateBtn.classList.remove('hover:from-[#2B4B7D]', 'hover:to-[#1B365D]', 'focus:ring-[#1B365D]');
            btnText.textContent = 'No Changes';
            updateBtn.querySelector('i').className = 'fas fa-check mr-2';
        } else {
            // Enable button when there are changes
            updateBtn.disabled = false;
            updateBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            updateBtn.classList.add('hover:from-[#2B4B7D]', 'hover:to-[#1B365D]', 'focus:ring-[#1B365D]');
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
            updateBtn.classList.remove('from-[#1B365D]', 'to-[#2B4B7D]', 'hover:from-[#2B4B7D]', 'hover:to-[#1B365D]', 'focus:ring-[#1B365D]');
            updateBtn.classList.add('from-[#D4AF37]', 'to-[#B38F2A]', 'hover:from-[#B38F2A]', 'hover:to-[#D4AF37]', 'focus:ring-[#D4AF37]');
            btnText.textContent = 'Confirm Update';
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
            updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';
            form.submit();
        }
    });

    function resetButton() {
        if (hasChanges) {
            updateBtn.classList.remove('from-[#D4AF37]', 'to-[#B38F2A]', 'hover:from-[#B38F2A]', 'hover:to-[#D4AF37]', 'focus:ring-[#D4AF37]');
            updateBtn.classList.add('from-[#1B365D]', 'to-[#2B4B7D]', 'hover:from-[#2B4B7D]', 'hover:to-[#1B365D]', 'focus:ring-[#1B365D]');
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