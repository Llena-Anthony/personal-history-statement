@extends('layouts.personnel')

@section('title', 'Edit Profile - Personnel Portal')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Edit Profile</h1>
                <p class="text-blue-100">Update your personal information and account settings</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-user-edit text-6xl text-blue-200 opacity-50"></i>
            </div>
        </div>
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
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-purple-200">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-camera mr-3 text-purple-600"></i>
                Profile Picture
            </h2>
            <p class="text-gray-600 text-sm">Update your profile picture</p>
        </div>

        <div class="p-6">
            <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                <!-- Current Profile Picture -->
                <div class="text-center">
                    <div class="relative inline-block">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-full flex items-center justify-center mb-4 overflow-hidden">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                                     alt="Profile Picture" 
                                     class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-user text-white text-2xl"></i>
                            @endif
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-6 h-6 bg-purple-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-camera text-white text-xs"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">Current Picture</p>
                </div>

                <!-- Upload Form -->
                <div class="flex-1">
                    <form method="POST" action="{{ route('personnel.profile.picture') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-upload mr-2 text-blue-600"></i>
                                Upload New Picture
                            </label>
                            
                            <!-- Drag & Drop Upload Area -->
                            <div id="drag-drop-area" 
                                 class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-blue-600 hover:bg-blue-50 transition-all duration-300 cursor-pointer group">
                                <div id="drag-drop-content">
                                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:bg-indigo-700 transition-colors duration-300">
                                        <i class="fas fa-cloud-upload-alt text-white text-xl"></i>
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-700 mb-1">Drag & Drop your image here</h3>
                                    <p class="text-gray-500 text-sm mb-3">or click to browse files</p>
                                    <div class="flex items-center justify-center space-x-2 text-xs text-gray-400">
                                        <i class="fas fa-image"></i>
                                        <span>JPG, PNG, GIF (Max: 2MB)</span>
                                    </div>
                                </div>
                                
                                <!-- Loading State -->
                                <div id="upload-loading" class="hidden">
                                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-white"></div>
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-700 mb-1">Uploading...</h3>
                                    <p class="text-gray-500 text-sm">Please wait while we process your image</p>
                                </div>
                                
                                <!-- Success State -->
                                <div id="upload-success" class="hidden">
                                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-check text-white text-xl"></i>
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-700 mb-1">Upload Successful!</h3>
                                    <p class="text-gray-500 text-sm">Your profile picture has been updated</p>
                                </div>
                                
                                <!-- Error State -->
                                <div id="upload-error" class="hidden">
                                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-700 mb-1">Upload Failed</h3>
                                    <p id="error-message" class="text-gray-500 text-sm">Please try again</p>
                                </div>
                                
                                <input type="file" 
                                       name="profile_picture" 
                                       id="profile_picture"
                                       accept="image/*"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                       onchange="handleFileSelect(this)">
                            </div>
                            
                            <!-- Upload Button (shown when file is selected) -->
                            <div id="upload-button-container" class="hidden mt-4">
                                <button type="submit" 
                                        id="upload-button"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors duration-200 w-full justify-center">
                                    <i class="fas fa-save mr-2"></i>
                                    Upload Profile Picture
                                </button>
                            </div>
                            
                            <!-- File Info -->
                            <div id="file-info" class="hidden mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <i class="fas fa-image text-blue-600"></i>
                                        <div>
                                            <p id="file-name" class="text-sm font-medium text-gray-900"></p>
                                            <p id="file-size" class="text-xs text-gray-500"></p>
                                        </div>
                                    </div>
                                    <button type="button" 
                                            onclick="removeSelectedFile()"
                                            class="text-red-500 hover:text-red-700 transition-colors duration-200">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Image Preview -->
                    <div id="image-preview" class="hidden mt-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Preview</label>
                        <div class="w-20 h-20 bg-gray-100 rounded-full overflow-hidden">
                            <img id="preview-img" src="" alt="Preview" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Form -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-user-circle mr-3 text-blue-600"></i>
                Personal Information
            </h2>
            <p class="text-gray-600 text-sm">Update your basic profile information</p>
        </div>

        <form method="POST" action="{{ route('personnel.profile.update') }}" id="profile-form" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name Field (Read-only) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user mr-2 text-blue-600"></i>
                        Full Name
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', Auth::user()->first_name) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-500 cursor-not-allowed" 
                           readonly>
                    <p class="text-xs text-gray-500 mt-1">Name cannot be changed here. Edit your full name in the PHS Form</p>
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-blue-600"></i>
                        Email Address
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', Auth::user()->email) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors duration-200 @error('email') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
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
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 border border-blue-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lock mr-2 text-blue-600"></i>
                    Change Password
                </h3>
                <p class="text-gray-600 text-sm mb-4">Leave password fields blank if you don't want to change your password</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-key mr-2 text-blue-600"></i>
                            Current Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="current_password" 
                                   id="current_password"
                                   class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors duration-200 @error('current_password') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
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
                            <i class="fas fa-lock mr-2 text-blue-600"></i>
                            New Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   name="new_password" 
                                   id="new_password"
                                   class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors duration-200 @error('new_password') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
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
                        <i class="fas fa-check-circle mr-2 text-blue-600"></i>
                        Confirm New Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="new_password_confirmation" 
                               id="new_password_confirmation"
                               class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-colors duration-200"
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
                <a href="{{ route('personnel.dashboard') }}" 
                   class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Dashboard
                </a>
                <button type="button" 
                        onclick="confirmProfileUpdate()" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-all duration-200 hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i>
                    Update Profile
                </button>
            </div>
        </form>
    </div>

    <!-- Profile Information Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-green-200">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-info-circle mr-3 text-green-600"></i>
                Account Information
            </h2>
            <p class="text-gray-600 text-sm">Your current account details</p>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                        <span class="text-sm font-semibold text-gray-700">Member Since</span>
                    </div>
                    <p class="text-gray-900">{{ Auth::user()->created_at ? Auth::user()->created_at->format('F d, Y') : 'N/A' }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-clock text-blue-600 mr-2"></i>
                        <span class="text-sm font-semibold text-gray-700">Last Updated</span>
                    </div>
                    <p class="text-gray-900">{{ Auth::user()->updated_at ? Auth::user()->updated_at->format('F d, Y \a\t g:i A') : 'N/A' }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-shield-alt text-blue-600 mr-2"></i>
                        <span class="text-sm font-semibold text-gray-700">Account Status</span>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>
                        Active
                    </span>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-user-tag text-blue-600 mr-2"></i>
                        <span class="text-sm font-semibold text-gray-700">User Role</span>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-user-shield mr-1"></i>
                        Personnel
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
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
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                Update Profile
            </button>
        </div>
    </div>
</div>

<script>
// File upload handling
function handleFileSelect(input) {
    const file = input.files[0];
    if (file) {
        // Show file info
        document.getElementById('file-name').textContent = file.name;
        document.getElementById('file-size').textContent = formatFileSize(file.size);
        document.getElementById('file-info').classList.remove('hidden');
        document.getElementById('upload-button-container').classList.remove('hidden');
        
        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function removeSelectedFile() {
    document.getElementById('profile_picture').value = '';
    document.getElementById('file-info').classList.add('hidden');
    document.getElementById('upload-button-container').classList.add('hidden');
    document.getElementById('image-preview').classList.add('hidden');
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Password visibility toggle
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

// Profile update confirmation
function confirmProfileUpdate() {
    document.getElementById('confirmModal').classList.remove('hidden');
}

function closeConfirmModal() {
    document.getElementById('confirmModal').classList.add('hidden');
}

function submitProfileForm() {
    document.getElementById('profile-form').submit();
}

// Auto-hide success messages
document.addEventListener('DOMContentLoaded', function() {
    const successMessages = document.querySelectorAll('.fade-in');
    successMessages.forEach(function(message) {
        setTimeout(function() {
            message.style.opacity = '0';
            setTimeout(function() {
                message.style.display = 'none';
            }, 300);
        }, 3000);
    });
});
</script>
@endsection 