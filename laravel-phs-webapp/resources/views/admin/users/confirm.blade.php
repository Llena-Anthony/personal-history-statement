@extends('layouts.admin')

@section('title', 'Confirm User Creation')

@section('header', 'Confirm User Creation')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <p class="text-gray-600">Review and confirm the new user details</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Form
        </a>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 fade-in">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-500"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">Please correct the following errors:</p>
                <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 fade-in">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-500"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- User Details Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- User Information -->
            <div class="space-y-4">
                <h3 class="text-lg font-medium text-gray-900">User Information</h3>
                <div class="space-y-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Full Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $userData['first_name'] }} {{ $userData['middle_name'] }} {{ $userData['last_name'] }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Email Address</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $userData['email'] }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">User Type</label>
                        <p class="mt-1 text-sm text-gray-900">{{ ucfirst($userData['user_type']) }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Organic Group</label>
                        <p class="mt-1 text-sm text-gray-900">{{ ucfirst($userData['organic_group']) }}</p>
                    </div>
                </div>
            </div>

            <!-- Generated Credentials -->
            <div class="space-y-4">
                <h3 class="text-lg font-medium text-gray-900">Generated Credentials</h3>
                <form action="{{ route('admin.users.finalize') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="custom_username" class="block text-sm font-medium text-gray-700">Username</label>
                        <div class="mt-1 flex items-center">
                            <input type="text" name="custom_username" id="custom_username" value="{{ old('custom_username', $userData['generated_username']) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D] sm:text-sm">
                            <button type="button" onclick="copyToClipboard('{{ $userData['generated_username'] }}')"
                                class="ml-2 p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">You can modify the generated username if needed</p>
                    </div>

                    <div>
                        <label for="custom_password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1 flex items-center">
                            <input type="text" name="custom_password" id="custom_password" value="{{ old('custom_password', $userData['generated_password']) }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D] sm:text-sm">
                            <button type="button" onclick="copyToClipboard('{{ $userData['generated_password'] }}')"
                                class="ml-2 p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">You can modify the generated password if needed</p>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full btn-primary inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                            <i class="fas fa-check mr-2"></i>
                            Confirm and Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        // Show a temporary success message
        const button = event.currentTarget;
        const originalIcon = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => {
            button.innerHTML = originalIcon;
        }, 2000);
    });
}
</script>
@endsection 