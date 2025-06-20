@extends('layouts.admin')

@section('title', 'User Management')

@section('header', 'User Management')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold text-[#1B365D]">User Management</h1>
            <p class="text-gray-600">Manage system users and their access levels</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
            <i class="fas fa-plus mr-2"></i>
            Add New User
        </a>
    </div>

    <!-- Search Bar with Filter Dropdowns -->
    <x-admin.search-bar 
        :route="route('admin.users.index')"
        placeholder="Search by name, username, email, or any field..."
        :filters="[
            'status' => [
                'active' => 'Active',
                'disabled' => 'Disabled'
            ],
            'user_type' => [
                'admin' => 'Admin',
                'personnel' => 'Personnel',
                'client' => 'Client'
            ],
            'date_range' => true
        ]"
    />

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('generated_credentials'))
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium">Generated Credentials</h3>
                <div class="mt-2 text-sm">
                    <p><strong>Username:</strong> {{ session('generated_credentials.username') }}</p>
                    <p><strong>Password:</strong> {{ session('generated_credentials.password') }}</p>
                    <p class="mt-2 text-xs">Please save these credentials as they won't be shown again.</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('new_user'))
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 fade-in">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-500 mt-1"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">New User Created Successfully</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <p class="font-medium">Please save these credentials:</p>
                    <div class="mt-2 space-y-2">
                        <div class="flex items-center">
                            <span class="w-24 text-gray-600">Username:</span>
                            <span class="font-mono bg-blue-100 px-2 py-1 rounded">{{ session('new_user')['username'] }}</span>
                            <button onclick="copyToClipboard('{{ session('new_user')['username'] }}')" class="ml-2 p-1 text-blue-600 hover:text-blue-800 focus:outline-none">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <div class="flex items-center">
                            <span class="w-24 text-gray-600">Password:</span>
                            <span class="font-mono bg-blue-100 px-2 py-1 rounded">{{ session('new_user')['password'] }}</span>
                            <button onclick="copyToClipboard('{{ session('new_user')['password'] }}')" class="ml-2 p-1 text-blue-600 hover:text-blue-800 focus:outline-none">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-3 text-sm text-blue-600">These credentials will be needed for the user's first login.</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Results Count -->
    <div class="flex justify-end items-center">
        <div class="text-sm text-gray-500">
            Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} results
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="w-full">
            <table class="w-full table-fixed divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="w-1/6 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="w-1/6 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th scope="col" class="w-1/5 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="w-1/8 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Type</th>
                        <th scope="col" class="w-1/8 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Organic Group</th>
                        <th scope="col" class="w-1/8 px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="w-1/12 px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-4">
                            <div class="text-sm font-medium text-gray-900 truncate" title="{{ $user->name }}">{{ $user->name }}</div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="text-sm text-gray-900 truncate" title="{{ $user->username }}">{{ $user->username }}</div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="text-sm text-gray-900 truncate" title="{{ $user->email }}">{{ $user->email }}</div>
                        </td>
                        <td class="px-4 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 capitalize">
                                {{ $user->usertype }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 capitalize">
                                {{ $user->organic_role }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->is_active ? 'Active' : 'Disabled' }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-center">
                            <div class="flex justify-center">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-[#1B365D] hover:text-[#2B4B7D]" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Confirmation Modal for User Delete -->
<!-- Removed delete modal and form -->

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
