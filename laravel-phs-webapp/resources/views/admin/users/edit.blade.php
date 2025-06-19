@extends('layouts.admin')

@section('title', 'Edit User')

@section('header', 'Edit User')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <p class="text-gray-600">Modify user account details</p>
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

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Edit User Form -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6" id="edit-user-form">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" value="{{ $user->username }}" disabled
                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm sm:text-sm">
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required disabled
                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm sm:text-sm">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required disabled
                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm sm:text-sm">
                </div>

                <div>
                    <label for="usertype" class="block text-sm font-medium text-gray-700">User Type</label>
                    <select name="usertype" id="usertype" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D] sm:text-sm">
                        <option value="admin" {{ old('usertype', $user->usertype) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="personnel" {{ old('usertype', $user->usertype) == 'personnel' ? 'selected' : '' }}>Personnel</option>
                        <option value="client" {{ old('usertype', $user->usertype) == 'client' ? 'selected' : '' }}>Client</option>
                    </select>
                </div>

                <div>
                    <label for="branch" class="block text-sm font-medium text-gray-700">Branch</label>
                    <input type="text" name="branch" id="branch" value="{{ old('branch', $user->branch) }}" required disabled
                        class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm sm:text-sm">
                </div>

                <div>
                    <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-[#1B365D] shadow-sm focus:border-[#1B365D] focus:ring-[#1B365D]">
                            <span class="ml-2 text-sm text-gray-600">Active</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="button" onclick="confirmUserUpdate()" class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                    <i class="fas fa-save mr-2"></i>
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Confirmation Modal for User Update -->
<x-confirmation-modal 
    id="userUpdateModal"
    title="Confirm User Update"
    message="Are you sure you want to update this user's information? This action cannot be undone."
    confirmText="Update User"
    cancelText="Cancel"
    confirmClass="bg-[#1B365D] hover:bg-[#2B4B7D]"
/>

@endsection

@push('scripts')
<script>
function confirmUserUpdate() {
    showConfirmationModal(
        'userUpdateModal',
        'Are you sure you want to update this user\'s information? This action cannot be undone.',
        function() {
            document.getElementById('edit-user-form').submit();
        }
    );
}
</script>
@endpush 