@extends('layouts.client')

@section('title', 'Edit Profile - Personal History Statement')
@section('header', 'Edit Profile')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] rounded-2xl p-8 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Edit Profile</h1>
                    <p class="text-[#D4AF37] text-lg">Update your personal information and account settings</p>
                </div>
                <div class="hidden md:block">
                    <div class="w-20 h-20 bg-[#D4AF37] rounded-full flex items-center justify-center">
                        <i class="fas fa-user-edit text-[#1B365D] text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#D4AF37] opacity-10 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#D4AF37] opacity-10 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 fade-in">
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

    <!-- Profile Picture Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-8 py-6 border-b border-purple-200">
            <h2 class="text-2xl font-bold text-[#1B365D] flex items-center">
                <i class="fas fa-camera mr-3 text-[#D4AF37]"></i>
                Profile Picture
            </h2>
            <p class="text-gray-600 mt-1">Update your profile picture</p>
        </div>

        <div class="p-8">
            <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                <!-- Current Profile Picture -->
                <div class="text-center">
                    <div class="relative inline-block">
                        <div class="w-32 h-32 bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] rounded-full flex items-center justify-center mb-4 overflow-hidden">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                                     alt="Profile Picture" 
                                     class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-user text-[#D4AF37] text-4xl"></i>
                            @endif
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-[#D4AF37] rounded-full flex items-center justify-center">
                            <i class="fas fa-camera text-[#1B365D] text-sm"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Current Picture</p>
                </div>

                <!-- Upload Form -->
                <div class="flex-1">
                    <form method="POST" action="{{ route('profile.picture') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-upload mr-2 text-[#1B365D]"></i>
                                Upload New Picture
                            </label>
                            <!-- Drag and Drop Area -->
                            <div 
                                id="drop-area"
                                class="flex flex-col items-center justify-center border-2 border-dashed border-[#D4AF37] rounded-xl p-6 mb-4 cursor-pointer bg-yellow-50 hover:bg-yellow-100 transition"
                                onclick="document.getElementById('profile_picture').click();"
                                ondragover="event.preventDefault(); this.classList.add('bg-yellow-100');"
                                ondragleave="this.classList.remove('bg-yellow-100');"
                                ondrop="handleDrop(event);"
                            >
                                <i class="fas fa-cloud-upload-alt text-3xl text-[#D4AF37] mb-2"></i>
                                <span class="font-medium text-[#D4AF37]">Drag your file here or click to choose</span>
                                <span class="text-xs text-gray-500 mt-1">Supported formats: JPG, PNG, GIF (Max: 2MB)</span>
                                <input 
                                    type="file" 
                                    id="profile_picture" 
                                    name="profile_picture" 
                                    class="hidden"
                                    accept="image/*"
                                    onchange="previewImage(this); showFileName(this);"
                                >
                                <span id="file-name" class="text-xs text-gray-700 mt-2"></span>
                            </div>
                            <!-- End Drag and Drop Area -->
                            <div class="flex items-center space-x-4">
                                <!-- Remove old input, now handled above -->
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-[#1B365D] text-white text-sm font-medium rounded-xl hover:bg-[#2B4B7D] transition-colors duration-200">
                                    <i class="fas fa-save mr-2"></i>
                                    Upload
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Image Preview -->
                    <div id="image-preview" class="hidden mt-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Preview</label>
                        <div class="w-24 h-24 bg-gray-100 rounded-full overflow-hidden">
                            <img id="preview-img" src="" alt="Preview" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Form -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-[#1B365D] flex items-center">
                <i class="fas fa-user-circle mr-3 text-[#D4AF37]"></i>
                Personal Information
            </h2>
            <p class="text-gray-600 mt-1">Update your basic profile information</p>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" id="profile-form" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name Field (Read-only) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-[#1B365D]"></i>
                        Full Name
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $user->name) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-500 cursor-not-allowed" 
                           readonly>
                    <p class="text-xs text-gray-500 mt-1">Name cannot be here. Edit your full name in the PHS Form</p>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-[#1B365D]"></i>
                        Email Address
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', $user->email) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors duration-200 @error('email') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                           placeholder="Enter your email address">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Password Change Section -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
                <h3 class="text-lg font-semibold text-[#1B365D] mb-4 flex items-center">
                    <i class="fas fa-lock mr-2 text-[#D4AF37]"></i>
                    Change Password
                </h3>
                <p class="text-gray-600 text-sm mb-4">Leave password fields blank if you don't want to change your password</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-key mr-2 text-[#1B365D]"></i>
                            Current Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="current_password" 
                                   id="current_password"
                                   class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors duration-200 @error('current_password') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                   placeholder="Enter current password">
                            <button type="button" 
                                    onclick="togglePasswordVisibility('current_password', 'current_password_toggle')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye" id="current_password_toggle"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-[#1B365D]"></i>
                            New Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="new_password" 
                                   id="new_password"
                                   class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors duration-200 @error('new_password') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                   placeholder="Enter new password">
                            <button type="button" 
                                    onclick="togglePasswordVisibility('new_password', 'new_password_toggle')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye" id="new_password_toggle"></i>
                            </button>
                        </div>
                        @error('new_password')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="new_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-check-circle mr-2 text-[#1B365D]"></i>
                        Confirm New Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="new_password_confirmation" 
                               id="new_password_confirmation"
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors duration-200"
                               placeholder="Confirm new password">
                        <button type="button" 
                                onclick="togglePasswordVisibility('new_password_confirmation', 'confirm_password_toggle')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="confirm_password_toggle"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('client.dashboard') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Dashboard
                </a>
                <button type="button" 
                        onclick="confirmProfileUpdate()" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-[#1B365D] text-white font-medium rounded-xl hover:bg-[#2B4B7D] transition-all duration-200 hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i>
                    Update Profile
                </button>
            </div>
        </form>
    </div>

    <!-- Profile Information Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-8 py-6 border-b border-green-200">
            <h2 class="text-2xl font-bold text-[#1B365D] flex items-center">
                <i class="fas fa-info-circle mr-3 text-[#D4AF37]"></i>
                Account Information
            </h2>
            <p class="text-gray-600 mt-1">Your current account details</p>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-calendar-alt text-[#1B365D] mr-2"></i>
                        <span class="text-sm font-semibold text-gray-700">Member Since</span>
                    </div>
                    <p class="text-gray-900">{{ $user->created_at->format('F d, Y') }}</p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-clock text-[#1B365D] mr-2"></i>
                        <span class="text-sm font-semibold text-gray-700">Last Updated</span>
                    </div>
                    <p class="text-gray-900">{{ $user->updated_at->format('F d, Y \a\t g:i A') }}</p>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-shield-alt text-[#1B365D] mr-2"></i>
                        <span class="text-sm font-semibold text-gray-700">Account Status</span>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>
                        Active
                    </span>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user-tag text-[#1B365D] mr-2"></i>
                        <span class="text-sm font-semibold text-gray-700">User Role</span>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-user mr-1"></i>
                        Client
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6">
        <div class="flex items-center mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-question-circle text-blue-600 text-xl"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Confirm Profile Update</h3>
                <p class="text-sm text-gray-600">Are you sure you want to update your profile?</p>
            </div>
        </div>
        
        <div class="flex justify-end space-x-3">
            <button onclick="closeConfirmModal()" 
                    class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                Cancel
            </button>
            <button onclick="submitProfileForm()" 
                    class="px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] transition-colors duration-200">
                Update Profile
            </button>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility(inputId, toggleId) {
    const input = document.getElementById(inputId);
    const toggle = document.getElementById(toggleId);
    
    if (input.type === 'password') {
        input.type = 'text';
        toggle.classList.remove('fa-eye');
        toggle.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        toggle.classList.remove('fa-eye-slash');
        toggle.classList.add('fa-eye');
    }
}

function handleDrop(event) {
    event.preventDefault();
    event.currentTarget.classList.remove('bg-yellow-100');
    const files = event.dataTransfer.files;
    if (files.length > 0) {
        const input = document.getElementById('profile_picture');
        input.files = files;
        showFileName(input);
        previewImage(input);
    }
}

function showFileName(input) {
    const fileNameSpan = document.getElementById('file-name');
    if (input.files && input.files.length > 0) {
        fileNameSpan.textContent = input.files[0].name;
    } else {
        fileNameSpan.textContent = '';
    }
}

function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const img = document.getElementById('preview-img');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        img.src = '';
        preview.classList.add('hidden');
    }
}

function confirmProfileUpdate() {
    document.getElementById('confirmModal').classList.remove('hidden');
}

function closeConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
}

function submitProfileForm() {
    document.getElementById('profile-form').submit();
}

// Close modal when clicking outside
document.getElementById('confirmModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeConfirmModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeConfirmModal();
    }
});
</script>
@endsection 