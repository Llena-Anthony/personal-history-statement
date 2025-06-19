@extends('layouts.admin')

@section('title', 'Add New User')

@section('header', 'Add New User')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <p class="text-gray-600">Create a new user account</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Users
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

    <!-- Create User Form -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D] sm:text-sm bg-white text-gray-900 px-4 py-3 placeholder-gray-400"
                        placeholder="Enter first name">
                </div>

                <div>
                    <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D] sm:text-sm bg-white text-gray-900 px-4 py-3 placeholder-gray-400"
                        placeholder="Enter middle name (optional)">
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D] sm:text-sm bg-white text-gray-900 px-4 py-3 placeholder-gray-400"
                        placeholder="Enter last name">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D] sm:text-sm bg-white text-gray-900 px-4 py-3 placeholder-gray-400"
                        placeholder="Enter email address">
                </div>

                <div>
                    <label for="user_type" class="block text-sm font-medium text-gray-700">Type of User</label>
                    <select name="user_type" id="user_type" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D] sm:text-sm">
                        <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="personnel" {{ old('user_type') == 'personnel' ? 'selected' : '' }}>Personnel</option>
                        <option value="regular" {{ old('user_type') == 'client' ? 'selected' : '' }}>Client</option>
                    </select>
                </div>

                <div>
                    <label for="organic_group" class="block text-sm font-medium text-gray-700">Organic Group</label>
                    <select name="organic_group" id="organic_group" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D] sm:text-sm">
                        <option value="civilian" {{ old('organic_group') == 'civilian' ? 'selected' : '' }}>Civilian</option>
                        <option value="enlisted" {{ old('organic_group') == 'enlisted' ? 'selected' : '' }}>Enlisted</option>
                        <option value="officer" {{ old('organic_group') == 'officer' ? 'selected' : '' }}>Officer</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                    <i class="fas fa-user-plus mr-2"></i>
                    Okay
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
