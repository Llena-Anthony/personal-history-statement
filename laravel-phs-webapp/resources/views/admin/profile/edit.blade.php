@extends('layouts.admin')

@section('title', 'Manage Profile')

@section('header', 'Manage Profile')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center animate-fade-in">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg overflow-hidden animate-scale-in">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] px-8 py-6 relative overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative flex items-center space-x-6">
                <div class="relative group">
                    <img src="{{ $user->profile_photo_url }}" 
                         alt="Profile Picture" 
                         class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover transition-transform group-hover:scale-105">
                    <div class="absolute -bottom-2 -right-2 bg-[#D4AF37] rounded-full p-2 shadow-lg">
                        <i class="fas fa-camera text-white text-sm"></i>
                    </div>
                </div>
                <div class="text-white">
                    <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                    <p class="text-gray-200">{{ $user->email }}</p>
                    <p class="text-sm text-gray-300">{{ $user->organic_role ?? 'Administrator' }}</p>
                </div>
            </div>
        </div>

        <!-- Profile Form -->
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Profile Photo Upload -->
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-gray-700">Profile Photo</label>
                        <div class="flex flex-col space-y-4">
                            <div class="relative">
                                <input type="file" 
                                       name="profile_photo" 
                                       id="profile_photo" 
                                       accept="image/*"
                                       class="hidden"
                                       onchange="previewImage(this)">
                                <label for="profile_photo" 
                                       class="cursor-pointer bg-gray-50 hover:bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg p-6 text-center transition-all duration-200 hover:border-[#D4AF37] hover:bg-[#D4AF37]/5 block">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                    <p class="text-sm text-gray-600 font-medium">Click to upload photo</p>
                                    <p class="text-xs text-gray-500 mt-1">JPEG, PNG, JPG, GIF up to 2MB</p>
                                </label>
                            </div>
                            <div id="image-preview" class="hidden">
                                <div class="flex items-center space-x-3">
                                    <img id="preview" class="w-16 h-16 rounded-full object-cover border-2 border-gray-200 shadow-md">
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">Preview</p>
                                        <p class="text-xs text-gray-500">Your new profile photo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('profile_photo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Basic Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 flex items-center">
                            <i class="fas fa-user mr-2 text-[#D4AF37]"></i>
                            Basic Information
                        </h3>
                        
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $user->name) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4AF37] focus:ring-[#D4AF37] transition-colors">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <input type="text" 
                                   name="username" 
                                   id="username" 
                                   value="{{ old('username', $user->username) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4AF37] focus:ring-[#D4AF37] transition-colors">
                            @error('username')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', $user->email) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4AF37] focus:ring-[#D4AF37] transition-colors">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Additional Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-[#D4AF37]"></i>
                            Additional Information
                        </h3>
                        
                        <div>
                            <label for="organic_role" class="block text-sm font-medium text-gray-700">Organic Role</label>
                            <select name="organic_role" 
                                    id="organic_role" 
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4AF37] focus:ring-[#D4AF37] transition-colors"
                                    onchange="toggleBranchField()">
                                <option value="">Select Organic Role</option>
                                <option value="civilian" {{ old('organic_role', $user->organic_role) == 'civilian' ? 'selected' : '' }}>Civilian</option>
                                <option value="enlisted" {{ old('organic_role', $user->organic_role) == 'enlisted' ? 'selected' : '' }}>Enlisted</option>
                                <option value="officer" {{ old('organic_role', $user->organic_role) == 'officer' ? 'selected' : '' }}>Officer</option>
                            </select>
                            @error('organic_role')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="branch-field" class="{{ old('organic_role', $user->organic_role) == 'civilian' ? 'hidden' : '' }}">
                            <label for="branch" class="block text-sm font-medium text-gray-700">Branch</label>
                            <select name="branch" 
                                    id="branch" 
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4AF37] focus:ring-[#D4AF37] transition-colors">
                                <option value="ARMY" {{ old('branch', $user->branch) == 'ARMY' ? 'selected' : '' }}>ARMY</option>
                                <option value="NAVY" {{ old('branch', $user->branch) == 'NAVY' ? 'selected' : '' }}>NAVY</option>
                                <option value="AIRFORCE" {{ old('branch', $user->branch) == 'AIRFORCE' ? 'selected' : '' }}>AIRFORCE</option>
                            </select>
                            @error('branch')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Change -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 flex items-center">
                            <i class="fas fa-lock mr-2 text-[#D4AF37]"></i>
                            Change Password
                        </h3>
                        <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg border-l-4 border-[#D4AF37]">
                            <i class="fas fa-info-circle mr-1"></i>
                            Leave blank if you don't want to change your password
                        </p>
                        
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                            <input type="password" 
                                   name="current_password" 
                                   id="current_password"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4AF37] focus:ring-[#D4AF37] transition-colors">
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                            <input type="password" 
                                   name="new_password" 
                                   id="new_password"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4AF37] focus:ring-[#D4AF37] transition-colors">
                            @error('new_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                            <input type="password" 
                                   name="new_password_confirmation" 
                                   id="new_password_confirmation"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#D4AF37] focus:ring-[#D4AF37] transition-colors">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-8 border-t border-gray-200 mt-8">
                <a href="{{ route('admin.dashboard') }}" 
                   class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
                <button type="button" onclick="confirmProfileUpdate()" 
                        class="px-6 py-2.5 bg-[#D4AF37] text-white rounded-lg hover:bg-[#B38F2A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4AF37] transition-all duration-200 shadow-md hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Confirmation Modal for Profile Update -->
<x-confirmation-modal 
    id="profileUpdateModal"
    title="Confirm Profile Update"
    message="Are you sure you want to update your profile information? This action cannot be undone."
    confirmText="Update Profile"
    cancelText="Cancel"
    confirmClass="bg-[#D4AF37] hover:bg-[#B38F2A]"
/>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scale-in {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out;
}

.animate-scale-in {
    animation: scale-in 0.6s ease-out;
}
</style>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('image-preview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

function toggleBranchField() {
    const organicRole = document.getElementById('organic_role').value;
    const branchField = document.getElementById('branch-field');
    
    if (organicRole === 'civilian') {
        branchField.classList.add('hidden');
        // Clear branch value when hidden
        document.getElementById('branch').value = '';
    } else {
        branchField.classList.remove('hidden');
    }
}

function confirmProfileUpdate() {
    showConfirmationModal(
        'profileUpdateModal',
        'Are you sure you want to update your profile information? This action cannot be undone.',
        function() {
            document.querySelector('form').submit();
        }
    );
}

// Show image preview if there's already an image
document.addEventListener('DOMContentLoaded', function() {
    const currentImage = document.querySelector('.profile-container img');
    if (currentImage && currentImage.src !== '{{ asset("images/default-avatar.svg") }}') {
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('image-preview');
        preview.src = currentImage.src;
        previewContainer.classList.remove('hidden');
    }
    
    // Initialize branch field visibility on page load
    toggleBranchField();
});
</script>
@endsection 