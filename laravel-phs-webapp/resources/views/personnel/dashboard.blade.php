@extends('layouts.admin')

@section('title', 'Personnel Dashboard')

@section('header', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden rounded-2xl shadow-xl">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat welcome-banner-bg" style="background-image: url('{{ asset('images/pmabg1.png') }}');">
            <div class="absolute inset-0 bg-gradient-to-r from-[#1B365D]/90 to-[#2B4B7D]/80"></div>
        </div>
        <div class="relative p-8 text-white z-10 welcome-banner-content">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2 welcome-banner-title">Welcome back, {{ auth()->user()->name }}!</h1>
                    <p class="text-white/80 text-lg welcome-banner-subtitle">Manage your Personal History Statement and track your progress.</p>
                    <div class="flex items-center mt-4 space-x-6 text-sm welcome-banner-stats">
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2 text-[#D4AF37]"></i>
                            <span id="current-time" class="loading">Loading...</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar mr-2 text-[#D4AF37]"></i>
                            <span id="current-date" class="loading">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-user-shield text-4xl text-[#D4AF37]"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <button disabled class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 cursor-not-allowed">
            <div class="flex items-center">
                <div class="p-3 bg-gray-100 rounded-xl">
                    <i class="fas fa-file-alt text-gray-400 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-gray-400">Start/Continue PHS</h3>
                    <p class="text-sm text-gray-400">Coming Soon</p>
                </div>
            </div>
        </button>
        <a href="{{ route('personnel.profile.edit') }}" class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-xl">
                    <i class="fas fa-user-circle text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-gray-900">Manage Profile</h3>
                    <p class="text-sm text-gray-500">Update your account info</p>
                </div>
            </div>
        </a>
        <button disabled class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 cursor-not-allowed">
            <div class="flex items-center">
                <div class="p-3 bg-gray-100 rounded-xl">
                    <i class="fas fa-file-signature text-gray-400 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-gray-400">PDS Status</h3>
                    <p class="text-sm text-gray-400">Coming Soon</p>
                </div>
            </div>
        </button>
    </div>

    <!-- PHS Progress Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">PHS Progress</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">0%</p>
                </div>
                <div class="p-4 bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] rounded-xl">
                    <i class="fas fa-file-alt text-white text-2xl"></i>
                </div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                <div class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-history text-blue-600 mr-2"></i>
            Recent Activity
        </h3>
        <div class="space-y-4">
            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                <div class="p-2 bg-blue-100 rounded-full mr-3">
                    <i class="fas fa-sign-in-alt text-blue-600 text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">Logged in to system</p>
                    <p class="text-xs text-gray-500">{{ now()->format('M d, Y g:i A') }}</p>
                </div>
            </div>
            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                <div class="p-2 bg-gray-100 rounded-full mr-3">
                    <i class="fas fa-user-plus text-gray-600 text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-800">Account created</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->created_at->format('M d, Y g:i A') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- System Information -->
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-info-circle text-blue-600 mr-2"></i>
            System Information
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <span class="text-gray-600">System Version:</span>
                <span class="font-medium">v1.0.0</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <span class="text-gray-600">Last Updated:</span>
                <span class="font-medium">{{ now()->format('M d, Y') }}</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <span class="text-gray-600">Support:</span>
                <span class="font-medium text-blue-600">Available</span>
            </div>
        </div>
    </div>
</div>
@endsection 