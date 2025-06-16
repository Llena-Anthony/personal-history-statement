@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-3xl font-bold text-[#1B365D] mt-2">{{ $totalUsers }}</p>
                </div>
                <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-users text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Active Users -->
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Users</p>
                    <p class="text-3xl font-bold text-[#1B365D] mt-2">{{ $activeUsers }}</p>
                </div>
                <div class="h-12 w-12 rounded-full bg-green-50 flex items-center justify-center">
                    <i class="fas fa-user-check text-green-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Inactive Users -->
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Inactive Users</p>
                    <p class="text-3xl font-bold text-[#1B365D] mt-2">{{ $inactiveUsers }}</p>
                </div>
                <div class="h-12 w-12 rounded-full bg-red-50 flex items-center justify-center">
                    <i class="fas fa-user-times text-red-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <h2 class="text-lg font-semibold text-[#1B365D] mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.users.create') }}" class="btn-primary inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                <i class="fas fa-user-plus mr-2"></i>
                Add New User
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn-primary inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                <i class="fas fa-users-cog mr-2"></i>
                Manage Users
            </a>
        </div>
    </div>
</div>
@endsection 