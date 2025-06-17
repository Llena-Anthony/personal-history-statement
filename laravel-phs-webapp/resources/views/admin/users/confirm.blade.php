@extends('layouts.admin')

@section('title', 'Confirm New User')

@section('content')
<div class="max-w-4xl mx-auto">
    @if(session('error'))
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-semibold text-[#1B365D]">Confirm New User Details</h2>
            <p class="mt-1 text-gray-600">Please review the generated credentials and make any necessary changes.</p>
        </div>

        <div class="p-6">
            <!-- User Information -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-[#1B365D] mb-4">User Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600">First Name</p>
                        <p class="font-medium">{{ $userData['first_name'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Middle Name</p>
                        <p class="font-medium">{{ $userData['middle_name'] ?: 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Last Name</p>
                        <p class="font-medium">{{ $userData['last_name'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-medium">{{ $userData['email'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">User Type</p>
                        <p class="font-medium capitalize">{{ $userData['user_type'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Organic Group</p>
                        <p class="font-medium capitalize">{{ $userData['organic_group'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Generated Credentials -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-[#1B365D] mb-4">Generated Credentials</h3>
                <div class="bg-gray-50 rounded-lg p-6">
                    <form method="POST" action="{{ route('admin.users.finalize') }}" class="space-y-6" id="createUserForm">
                        @csrf
                        <div>
                            <label for="username" class="block text-sm font-medium text-[#1B365D] mb-2">Username</label>
                            <div class="relative">
                                <input type="text" name="username" id="username" value="{{ $userData['generated_username'] }}"
                                    class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-[#1B365D] focus:border-[#1B365D]"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-[#1B365D] mb-2">Password</label>
                            <div class="relative">
                                <input type="text" name="password" id="password" value="{{ $userData['generated_password'] }}"
                                    class="block w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-[#1B365D] focus:border-[#1B365D]"
                                    required>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('admin.users.create') }}"
                                class="px-6 py-3 border border-gray-300 rounded-xl text-[#1B365D] hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                                Back
                            </a>
                            <button type="submit" id="submitButton"
                                class="px-6 py-3 bg-[#1B365D] text-white rounded-xl hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                                <span class="inline-flex items-center">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    Create User
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-lg text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#1B365D] mx-auto"></div>
        <p class="mt-4 text-gray-700">Creating user account...</p>
    </div>
</div>

<div id="successModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-8 rounded-xl shadow-lg text-center max-w-md mx-auto">
        <h2 class="text-2xl font-bold mb-4 text-green-700">User Created!</h2>
        <p id="successMessage" class="mb-4 text-gray-700"></p>
        <div class="mb-4">
            <p class="font-semibold">Username: <span id="modalUsername"></span></p>
            <p class="font-semibold">Password: <span id="modalPassword"></span></p>
            <p class="text-xs text-gray-500 mt-2">Please save these credentials as they won't be shown again.</p>
        </div>
        <button id="closeSuccessModal" class="px-6 py-2 bg-green-700 text-white rounded-xl">OK</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createUserForm');
    const submitButton = document.getElementById('submitButton');
    const loadingOverlay = document.getElementById('loadingOverlay');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        
        // Show loading state
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <span class="inline-flex items-center">
                <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
                Creating...
            </span>
        `;
        loadingOverlay.classList.remove('hidden');
        loadingOverlay.classList.add('flex');

        // Get form data
        const formData = new FormData(form);
        
        // Submit form using fetch
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Show modal with credentials
                showSuccessModal(data.credentials.username, data.credentials.password, data.message, data.redirect);
            } else if (data.redirect) {
                window.location.href = data.redirect;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Reset button state
            submitButton.disabled = false;
            submitButton.innerHTML = `
                <span class="inline-flex items-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Create User
                </span>
            `;
            loadingOverlay.classList.add('hidden');
            loadingOverlay.classList.remove('flex');
            
            // Show error message
            alert('An error occurred while creating the user. Please try again.');
        });
    });
});

function showSuccessModal(username, password, message, redirectUrl) {
    document.getElementById('modalUsername').textContent = username;
    document.getElementById('modalPassword').textContent = password;
    document.getElementById('successMessage').textContent = message;
    const modal = document.getElementById('successModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.getElementById('closeSuccessModal').onclick = function() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        window.location.href = redirectUrl;
    };
}
</script>
@endsection
