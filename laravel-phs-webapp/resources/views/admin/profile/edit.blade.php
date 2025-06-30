@extends('layouts.admin')

@section('title', 'Manage Profile')

@section('header', 'Manage Profile')

@section('content')
<div class="max-w-4xl mx-auto">
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
        <form id="admin-profile-form" action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')

            <!-- Instruction -->
            <div class="mb-4 flex items-center gap-2">
                <i class="fas fa-info-circle text-blue-500 text-xs"></i>
                <span class="text-gray-500 text-xs font-semibold">Only username and password can be edited. Other fields are read-only.</span>
            </div>
            <div class="border-b border-gray-200 mb-4"></div>

            <!-- Profile Photo Upload Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 mb-4 flex items-center">
                    <i class="fas fa-camera mr-2 text-[#D4AF37]"></i>
                    Profile Photo
                </h3>
                
                <!-- Photo Requirements -->
                <div class="mb-4 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                        <div>
                            <h4 class="text-sm font-semibold text-blue-800 mb-1">Photo Requirements</h4>
                            <ul class="text-xs text-blue-700 space-y-1">
                                <li>• Must be a formal 2x2 ID photo</li>
                                <li>• Professional appearance with proper attire</li>
                                <li>• Clear, high-quality image</li>
                                <li>• Neutral background</li>
                                <li>• File formats: JPEG, PNG, JPG, GIF (Max: 2MB)</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
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
                            <p class="text-sm text-gray-600 font-medium">Click to upload formal 2x2 ID photo</p>
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

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Basic Information -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2 flex items-center">
                            <i class="fas fa-user mr-2 text-[#D4AF37]"></i>
                            Basic Information
                        </h3>
                        
                        <div>
                            <label for="name" class="block text-xs font-semibold text-gray-700 mb-1">Full Name</label>
                            <div class="relative">
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $user->name) }}"
                                       disabled
                                       class="block w-full rounded-lg border border-gray-200 bg-gray-100 text-gray-500 px-3 py-1.5 shadow-sm focus:outline-none cursor-not-allowed text-xs">
                                <span class="absolute right-2 top-1.5 text-gray-400 text-xs" title="This field cannot be edited.">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="username" class="block text-xs font-semibold text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   name="username" 
                                   id="username" 
                                   value="{{ old('username', $user->username) }}"
                                   placeholder="Enter your username"
                                   class="block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white text-gray-900 px-3 py-1.5">
                            @error('username')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">Email Address</label>
                            <div class="relative">
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email', $user->email) }}"
                                       disabled
                                       class="block w-full rounded-lg border border-gray-200 bg-gray-100 text-gray-500 px-3 py-1.5 shadow-sm focus:outline-none cursor-not-allowed text-xs">
                                <span class="absolute right-2 top-1.5 text-gray-400 text-xs" title="This field cannot be edited.">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
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
                            <label for="current_password" class="block text-xs font-semibold text-gray-700 mb-1">Current Password</label>
                            <div class="relative">
                                <input type="password" 
                                       name="current_password" 
                                       id="current_password"
                                       placeholder="Enter your current password"
                                       class="block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white text-gray-900 px-3 py-1.5 pr-10">
                                <button type="button" 
                                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                                        onclick="togglePasswordVisibility('current_password')">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="new_password" class="block text-xs font-semibold text-gray-700 mb-1">New Password</label>
                            <div class="relative">
                                <input type="password" 
                                       name="new_password" 
                                       id="new_password"
                                       placeholder="Enter your new password (min. 8 characters)"
                                       class="block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white text-gray-900 px-3 py-1.5 pr-10">
                                <button type="button" 
                                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                                        onclick="togglePasswordVisibility('new_password')">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                            </div>
                            @error('new_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="new_password_confirmation" class="block text-xs font-semibold text-gray-700 mb-1">Confirm New Password</label>
                            <div class="relative">
                                <input type="password" 
                                       name="new_password_confirmation" 
                                       id="new_password_confirmation"
                                       placeholder="Confirm your new password"
                                       class="block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white text-gray-900 px-3 py-1.5 pr-10">
                                <button type="button" 
                                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors"
                                        onclick="togglePasswordVisibility('new_password_confirmation')">
                                    <i class="fas fa-eye text-xs"></i>
                                </button>
                            </div>
                            @error('new_password_confirmation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-8 border-t border-gray-200 mt-8">
                <button type="button" id="cancelBtn" disabled
                        class="px-6 py-2.5 border border-gray-300 text-gray-400 rounded-lg transition-colors cursor-not-allowed">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </button>
                <button type="button" id="saveChangesBtn" disabled
                        class="px-6 py-2.5 bg-gray-400 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-all duration-200 shadow-md flex items-center justify-center cursor-not-allowed">
                    <i class="fas fa-save mr-2"></i>
                    <span>Save Changes</span>
                </button>
                <button type="submit" id="confirmSaveBtn" style="display:none;"
                        class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center animate-fade-in">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>Click to Confirm</span>
                </button>
            </div>
        </form>
    </div>
</div>

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
// Store original form values
let originalFormData = {};

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

function togglePasswordVisibility(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const toggleButton = passwordField.nextElementSibling;
    const eyeIcon = toggleButton.querySelector('i');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
        toggleButton.setAttribute('title', 'Hide password');
    } else {
        passwordField.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
        toggleButton.setAttribute('title', 'Show password');
    }
}

function confirmProfileUpdate() {
    showConfirmationModal(
        'profileUpdateModal',
        'Are you sure you want to update your profile information? This action cannot be undone.',
        function() {
            document.getElementById('admin-profile-form').submit();
        }
    );
}

// Function to check if form has changes
function checkFormChanges() {
    const form = document.getElementById('admin-profile-form');
    const saveBtn = document.getElementById('saveChangesBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    let hasChanges = false;
    
    // Only check editable fields: username and password fields
    const usernameField = form.querySelector('input[name="username"]');
    const passwordFields = form.querySelectorAll('input[type="password"]');
    
    // Check username field
    if (usernameField) {
        const currentValue = usernameField.value;
        const originalValue = originalFormData['username'] || '';
        
        if (currentValue !== originalValue) {
            hasChanges = true;
        }
    }
    
    // Check file input (profile photo)
    const fileInput = form.querySelector('input[type="file"]');
    if (fileInput && fileInput.files.length > 0) {
        hasChanges = true;
    }
    
    // Check password fields (if any are filled)
    passwordFields.forEach(field => {
        if (field.value.trim() !== '') {
            hasChanges = true;
        }
    });
    
    // Enable/disable both buttons
    if (hasChanges) {
        // Enable Save button
        saveBtn.disabled = false;
        saveBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
        saveBtn.classList.add('bg-[#D4AF37]', 'hover:bg-[#B38F2A]', 'focus:ring-[#D4AF37]');
        
        // Enable Cancel button
        cancelBtn.disabled = false;
        cancelBtn.classList.remove('text-gray-400', 'cursor-not-allowed');
        cancelBtn.classList.add('text-gray-700', 'hover:bg-gray-50');
    } else {
        // Disable Save button
        saveBtn.disabled = true;
        saveBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
        saveBtn.classList.remove('bg-[#D4AF37]', 'hover:bg-[#B38F2A]', 'focus:ring-[#D4AF37]');
        
        // Disable Cancel button
        cancelBtn.disabled = true;
        cancelBtn.classList.add('text-gray-400', 'cursor-not-allowed');
        cancelBtn.classList.remove('text-gray-700', 'hover:bg-gray-50');
    }
}

// Show image preview if there's already an image
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide success message after 5 seconds
    const successMessage = document.getElementById('successMessage');
    if (successMessage) {
        setTimeout(() => {
            successMessage.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
            successMessage.style.opacity = '0';
            successMessage.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                successMessage.remove();
            }, 500);
        }, 5000);
    }
    
    const currentImage = document.querySelector('.profile-container img');
    if (currentImage && currentImage.src !== '{{ asset("images/default-avatar.svg") }}') {
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('image-preview');
        preview.src = currentImage.src;
        previewContainer.classList.remove('hidden');
    }
    
    // Store original form values for editable fields only
    const form = document.getElementById('admin-profile-form');
    const usernameField = form.querySelector('input[name="username"]');
    
    if (usernameField) {
        originalFormData['username'] = usernameField.value;
    }
    
    // Add event listeners for editable fields only
    if (usernameField) {
        usernameField.addEventListener('input', checkFormChanges);
        usernameField.addEventListener('change', checkFormChanges);
    }
    
    // Add event listener for file input
    const fileInput = form.querySelector('input[type="file"]');
    if (fileInput) {
        fileInput.addEventListener('change', checkFormChanges);
    }
    
    // Add event listeners for password fields
    const passwordFields = form.querySelectorAll('input[type="password"]');
    passwordFields.forEach(field => {
        field.addEventListener('input', checkFormChanges);
    });

    // Confirmation button logic
    const saveBtn = document.getElementById('saveChangesBtn');
    const confirmBtn = document.getElementById('confirmSaveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    let confirmTimeout;
    
    if (saveBtn && confirmBtn) {
        saveBtn.addEventListener('click', function() {
            if (!saveBtn.disabled) {
                saveBtn.style.display = 'none';
                confirmBtn.style.display = 'flex';
                confirmBtn.classList.add('scale-105');
                confirmTimeout = setTimeout(() => {
                    confirmBtn.style.display = 'none';
                    saveBtn.style.display = 'flex';
                }, 5000); // 5 seconds to confirm
            }
        });
        confirmBtn.addEventListener('click', function() {
            clearTimeout(confirmTimeout);
        });
    }
    
    // Cancel button functionality
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            if (!cancelBtn.disabled) {
                // Reset form to original values
                const usernameField = form.querySelector('input[name="username"]');
                if (usernameField) {
                    usernameField.value = originalFormData['username'] || '';
                }
                
                // Clear password fields
                const passwordFields = form.querySelectorAll('input[type="password"]');
                passwordFields.forEach(field => {
                    field.value = '';
                });
                
                // Clear file input
                const fileInput = form.querySelector('input[type="file"]');
                if (fileInput) {
                    fileInput.value = '';
                }
                
                // Hide image preview
                const previewContainer = document.getElementById('image-preview');
                if (previewContainer) {
                    previewContainer.classList.add('hidden');
                }
                
                // Check form changes to update button states
                checkFormChanges();
            }
        });
    }
    
    // Initialize form state
    checkFormChanges();
});
</script>
@endsection 