@extends('layouts.admin')

@section('title', 'Add New User')

@section('header', 'Add New User')

@section('content')
<div class="max-w-4xl mx-auto py-4">
    <!-- Enhanced Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-[#1B365D] flex items-center gap-3">
                <div class="bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] text-white p-3 rounded-xl shadow-lg">
                    <i class="fas fa-user-plus text-xl"></i>
                </div>
                Add New User
            </h2>
            <p class="text-gray-600 mt-2">Create a new user account with the details below. All fields marked with <span class="text-red-500">*</span> are required.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-[#1B365D] text-[#1B365D] bg-white hover:bg-[#1B365D] hover:text-white rounded-xl font-medium shadow-sm transition-all duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Back to Users
        </a>
    </div>

    @if($errors->any())
    <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-xl p-4 mb-6 animate-fade-in">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-500 text-xl mt-1"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                <ul class="mt-2 list-disc list-inside text-sm text-red-700 space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Enhanced Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <i class="fas fa-user-edit text-[#1B365D]"></i>
                User Information
            </h3>
            <p class="text-sm text-gray-600 mt-1">Enter the user's personal and account details</p>
        </div>
        
        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-6" id="create-user-form">
            @csrf
            
            <!-- Personal Information Section -->
            <div class="space-y-6">
                <div class="border-b border-gray-200 pb-4">
                    <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-user text-blue-600"></i>
                        Personal Information
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- First Name -->
                        <div class="form-group">
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="first_name" 
                                   name="first_name" 
                                   value="{{ old('first_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-all duration-200 @error('first_name') border-red-300 focus:ring-red-200 @enderror"
                                   placeholder="Enter first name"
                                   oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                                   required>
                            @error('first_name')
                            <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Middle Name -->
                        <div class="form-group">
                            <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Middle Name
                            </label>
                            <input type="text" 
                                   id="middle_name" 
                                   name="middle_name" 
                                   value="{{ old('middle_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-all duration-200 @error('middle_name') border-red-300 focus:ring-red-200 @enderror"
                                   placeholder="Enter middle name (optional)"
                                   oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())">
                            @error('middle_name')
                            <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="form-group">
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="last_name" 
                                   name="last_name" 
                                   value="{{ old('last_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-all duration-200 @error('last_name') border-red-300 focus:ring-red-200 @enderror"
                                   placeholder="Enter last name"
                                   oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\b\w/g, l => l.toUpperCase())"
                                   required>
                            @error('last_name')
                            <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Account Information Section -->
                <div class="border-b border-gray-200 pb-4">
                    <h4 class="text-md font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-shield-alt text-green-600"></i>
                        Account Information
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-all duration-200 @error('email') border-red-300 focus:ring-red-200 @enderror"
                                   placeholder="Enter email address"
                                   required>
                            @error('email')
                            <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- User Type -->
                        <div class="form-group">
                            <label for="user_type" class="block text-sm font-medium text-gray-700 mb-2">
                                User Type <span class="text-red-500">*</span>
                            </label>
                            <select id="user_type" 
                                    name="user_type" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-all duration-200 @error('user_type') border-red-300 focus:ring-red-200 @enderror"
                                    required>
                                <option value="">Select user type</option>
                                <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                <option value="personnel" {{ old('user_type') == 'personnel' ? 'selected' : '' }}>Personnel</option>
                                <option value="client" {{ old('user_type') == 'client' ? 'selected' : '' }}>Client</option>
                            </select>
                            @error('user_type')
                            <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Organic Group -->
                    <div class="mt-6">
                        <label for="organic_group" class="block text-sm font-medium text-gray-700 mb-2">
                            Organic Group <span class="text-red-500">*</span>
                        </label>
                        <select id="organic_group" 
                                name="organic_group" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-all duration-200 @error('organic_group') border-red-300 focus:ring-red-200 @enderror"
                                required>
                            <option value="">Select organic group</option>
                            <option value="civilian" {{ old('organic_group') == 'civilian' ? 'selected' : '' }}>Civilian</option>
                            <option value="enlisted" {{ old('organic_group') == 'enlisted' ? 'selected' : '' }}>Enlisted</option>
                            <option value="officer" {{ old('organic_group') == 'officer' ? 'selected' : '' }}>Officer</option>
                        </select>
                        @error('organic_group')
                        <p class="mt-1 text-sm text-red-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <!-- Help Section -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-500 text-lg mt-1"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-medium text-blue-800">User Types & Organic Groups</h4>
                            <div class="mt-2 text-sm text-blue-700 space-y-1">
                                <p><strong>Administrator:</strong> Full system access, can manage users and view all data</p>
                                <p><strong>Personnel:</strong> Staff access, can view and manage PHS submissions</p>
                                <p><strong>Client:</strong> Standard user access, can create and edit their own PHS</p>
                                <p><strong>Organic Groups:</strong> Define the user's role within the organization structure</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center gap-3 justify-end w-full">
                <a href="{{ route('admin.users.index') }}" 
                   id="cancelBtn"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200 disabled:opacity-50 disabled:pointer-events-none"
                   tabindex="-1"
                   aria-disabled="true"
                   style="pointer-events: none; opacity: 0.5;"
                >
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] hover:from-[#2B4B7D] hover:to-[#1B365D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                        id="submitBtn">
                    <i class="fas fa-user-plus mr-2"></i>
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Form validation and enhancement
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('create-user-form');
    const submitBtn = document.getElementById('submitBtn');
    const inputs = form.querySelectorAll('input, select');
    const cancelBtn = document.getElementById('cancelBtn');
    let formChanged = false;
    
    // Real-time validation
    inputs.forEach(input => {
        input.addEventListener('blur', validateField);
        input.addEventListener('input', clearFieldError);
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            return false;
        }
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating User...';
        
        // Re-enable after 5 seconds in case of error
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-user-plus mr-2"></i>Create User';
        }, 5000);
    });

    // Enable Cancel button when any input/select changes
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (!formChanged) {
                formChanged = true;
                cancelBtn.removeAttribute('aria-disabled');
                cancelBtn.removeAttribute('tabindex');
                cancelBtn.style.pointerEvents = '';
                cancelBtn.style.opacity = '';
            }
        });
    });

    // Cancel button resets form and disables itself
    cancelBtn.addEventListener('click', function(e) {
        e.preventDefault();
        form.reset();
        // Remove all error styling and messages
        inputs.forEach(input => {
            input.classList.remove('border-red-300', 'focus:ring-red-200');
            input.classList.add('border-gray-300', 'focus:ring-[#1B365D]');
        });
        const errorMessages = document.querySelectorAll('#create-user-form .text-red-600');
        errorMessages.forEach(error => error.remove());
        // Disable Cancel button again
        formChanged = false;
        cancelBtn.setAttribute('aria-disabled', 'true');
        cancelBtn.setAttribute('tabindex', '-1');
        cancelBtn.style.pointerEvents = 'none';
        cancelBtn.style.opacity = '0.5';
    });
});

function validateField(event) {
    const field = event.target;
    const value = field.value.trim();
    const fieldName = field.name;
    
    // Remove existing error styling
    field.classList.remove('border-red-300', 'focus:ring-red-200');
    field.classList.add('border-gray-300', 'focus:ring-[#1B365D]');
    
    // Remove existing error message
    const existingError = field.parentNode.querySelector('.text-red-600');
    if (existingError) {
        existingError.remove();
    }
    
    // Validation rules
    let isValid = true;
    let errorMessage = '';
    
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = 'This field is required.';
    } else if (fieldName === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address.';
        }
    } else if (['first_name', 'middle_name', 'last_name'].includes(fieldName) && value) {
        if (value.length < 2) {
            isValid = false;
            errorMessage = 'Name must be at least 2 characters long.';
        } else if (!/^[a-zA-Z\s]+$/.test(value)) {
            isValid = false;
            errorMessage = 'Name can only contain letters and spaces.';
        }
    }
    
    if (!isValid) {
        field.classList.remove('border-gray-300', 'focus:ring-[#1B365D]');
        field.classList.add('border-red-300', 'focus:ring-red-200');
        
        const errorElement = document.createElement('p');
        errorElement.className = 'mt-1 text-sm text-red-600 flex items-center gap-1';
        errorElement.innerHTML = `<i class="fas fa-exclamation-circle"></i>${errorMessage}`;
        field.parentNode.appendChild(errorElement);
    }
    
    return isValid;
}

function clearFieldError(event) {
    const field = event.target;
    field.classList.remove('border-red-300', 'focus:ring-red-200');
    field.classList.add('border-gray-300', 'focus:ring-[#1B365D]');
    
    const existingError = field.parentNode.querySelector('.text-red-600');
    if (existingError) {
        existingError.remove();
    }
}

function validateForm() {
    const inputs = document.querySelectorAll('#create-user-form input[required], #create-user-form select[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!validateField({ target: input })) {
            isValid = false;
        }
    });
    
    return isValid;
}

function confirmReset() {
    if (confirm('Are you sure you want to reset the form? All entered data will be lost.')) {
        document.getElementById('create-user-form').reset();
        
        // Clear all error styling
        const inputs = document.querySelectorAll('#create-user-form input, #create-user-form select');
        inputs.forEach(input => {
            input.classList.remove('border-red-300', 'focus:ring-red-200');
            input.classList.add('border-gray-300', 'focus:ring-[#1B365D]');
        });
        
        // Remove all error messages
        const errorMessages = document.querySelectorAll('#create-user-form .text-red-600');
        errorMessages.forEach(error => error.remove());
        
        // Show success message
        showToast('Form has been reset', 'success');
    }
}

// Toast notification function
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-medium shadow-lg transform transition-all duration-300 translate-x-full ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 'bg-blue-500'
    }`;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
    }, 100);
    
    // Animate out and remove
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 5000);
    }, 5000);
}

// Auto-capitalize name fields
document.querySelectorAll('input[name*="name"]').forEach(input => {
    input.addEventListener('input', function() {
        this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
    });
});

// Prevent form submission on Enter key in text inputs
document.querySelectorAll('input[type="text"], input[type="email"]').forEach(input => {
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            // Find next input or submit button
            const nextInput = this.parentNode.nextElementSibling?.querySelector('input, select');
            if (nextInput) {
                nextInput.focus();
            } else {
                document.getElementById('submitBtn').click();
            }
        }
    });
});
</script>

<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Enhanced form styling */
.form-group {
    position: relative;
}

.form-group input:focus,
.form-group select:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(27, 54, 93, 0.1);
}

/* Smooth transitions */
.transition-all {
    transition: all 0.2s ease-in-out;
}

/* Custom select styling */
select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
}

/* Loading animation */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.fa-spin {
    animation: spin 1s linear infinite;
}
</style>
@endsection
