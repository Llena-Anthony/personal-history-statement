@extends('layouts.admin')

@section('title', 'Add New User')

@section('header', 'Add New User')

@section('content')
<div class="max-w-3xl mx-auto py-4">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
        <div>
            <h2 class="text-xl font-bold text-[#1B365D] flex items-center gap-2">
                <i class="fas fa-user-plus text-[#1B365D] text-base"></i> Add New User
            </h2>
            <p class="text-gray-500 mt-1 text-sm">Create a new user account with the details below.</p>
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
            <span class="text-blue-500 text-xs font-semibold">Fill in all required fields to create a new user account.</span>
        </div>
        <div class="border-b border-gray-200 mb-4"></div>
        
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5" id="create-user-form">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-xs font-semibold text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                        class="block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white text-gray-900 px-3 py-1.5 placeholder-gray-400"
                        placeholder="Enter first name">
                </div>

                <div>
                    <label for="middle_name" class="block text-xs font-semibold text-gray-700 mb-1">Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}"
                        class="block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white text-gray-900 px-3 py-1.5 placeholder-gray-400"
                        placeholder="Enter middle name (optional)">
                </div>

                <div>
                    <label for="last_name" class="block text-xs font-semibold text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                        class="block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white text-gray-900 px-3 py-1.5 placeholder-gray-400"
                        placeholder="Enter last name">
                </div>

                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white text-gray-900 px-3 py-1.5 placeholder-gray-400"
                        placeholder="Enter email address">
                </div>

                <div>
                    <label for="user_type" class="block text-xs font-semibold text-gray-700 mb-1">User Type <span class="text-red-500">*</span></label>
                    <select name="user_type" id="user_type" required
                        class="mt-1 block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white px-3 py-1.5">
                        <option value="">Select user type</option>
                        <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="personnel" {{ old('user_type') == 'personnel' ? 'selected' : '' }}>Personnel</option>
                        <option value="regular" {{ old('user_type') == 'client' ? 'selected' : '' }}>Client</option>
                    </select>
                </div>

                <div>
                    <label for="organic_group" class="block text-xs font-semibold text-gray-700 mb-1">Organic Group <span class="text-red-500">*</span></label>
                    <select name="organic_group" id="organic_group" required
                        class="mt-1 block w-full rounded-lg border border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs bg-white px-3 py-1.5">
                        <option value="">Select organic group</option>
                        <option value="civilian" {{ old('organic_group') == 'civilian' ? 'selected' : '' }}>Civilian</option>
                        <option value="enlisted" {{ old('organic_group') == 'enlisted' ? 'selected' : '' }}>Enlisted</option>
                        <option value="officer" {{ old('organic_group') == 'officer' ? 'selected' : '' }}>Officer</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 rounded-lg font-semibold text-base shadow transition bg-gradient-to-r from-blue-600 to-blue-800 text-white hover:from-blue-700 hover:to-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700">
                    <i class="fas fa-user-plus"></i> <span>Create User</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function capitalizeWords(str) {
    return str.replace(/\b\w/g, function(char) { return char.toUpperCase(); });
}

document.addEventListener('DOMContentLoaded', function() {
    // Auto-capitalize name fields
    ['first_name', 'middle_name', 'last_name'].forEach(function(id) {
        var input = document.getElementById(id);
        if (input) {
            input.addEventListener('input', function(e) {
                var start = input.selectionStart;
                var end = input.selectionEnd;
                input.value = capitalizeWords(input.value.toLowerCase());
                input.setSelectionRange(start, end);
            });
        }
    });
});
</script>
@endpush
