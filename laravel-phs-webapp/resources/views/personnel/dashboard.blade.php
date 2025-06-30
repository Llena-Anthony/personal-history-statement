@extends('layouts.personnel')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="text-blue-100">Manage your Personal History Statement and track your progress.</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-user-shield text-6xl text-blue-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- PHS Progress Card -->
        <a href="{{ route('personnel.phs') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow focus:outline-none focus:ring-2 focus:ring-blue-400 cursor-pointer block">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">PHS Status</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Personal History Statement</h3>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Progress</span>
                <span class="text-lg font-semibold text-blue-600">0%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                <div class="bg-blue-600 h-2 rounded-full" style="width: 0%"></div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg group-hover:bg-blue-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start PHS
            </span>
        </a>

        <!-- PDS Status Card -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-gray-100 rounded-lg">
                    <i class="fas fa-file-signature text-gray-400 text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">PDS Status</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Personnel Data Sheet</h3>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-600">Status</span>
                <span class="text-lg font-semibold text-gray-400">Coming Soon</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                <div class="bg-gray-300 h-2 rounded-full" style="width: 0%"></div>
            </div>
            <button disabled class="mt-4 inline-flex items-center px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                <i class="fas fa-clock mr-2"></i>
                Not Available
            </button>
        </div>

        <!-- Profile Card -->
        <a href="{{ route('personnel.profile.edit') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow focus:outline-none focus:ring-2 focus:ring-green-400 cursor-pointer block">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-green-100 rounded-lg">
                    <i class="fas fa-user-circle text-green-600 text-xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">Profile</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Account Info</h3>
            <div class="space-y-2 text-sm text-gray-600">
                <div class="flex justify-between">
                    <span>Username:</span>
                    <span class="font-medium">{{ Auth::user()->username }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Role:</span>
                    <span class="font-medium text-green-600">Personnel</span>
                </div>
                <div class="flex justify-between">
                    <span>Last Login:</span>
                    <span class="font-medium">{{ Auth::user()->last_login_at ? \Carbon\Carbon::parse(Auth::user()->last_login_at)->diffForHumans() : 'Never' }}</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg group-hover:bg-green-700 transition-colors">
                <i class="fas fa-cog mr-2"></i>
                Manage Profile
            </span>
        </a>
    </div>

    <!-- Recent Activity & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-bolt text-yellow-600 mr-2"></i>
                Quick Actions
            </h3>
            <div class="grid grid-cols-1 gap-3">
                <a href="{{ route('personnel.phs') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <i class="fas fa-file-alt text-blue-600 mr-3 text-lg"></i>
                    <div>
                        <p class="font-medium text-gray-800">Start PHS Form</p>
                        <p class="text-sm text-gray-600">Begin filling out your Personal History Statement</p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                </a>
                
                <button disabled class="flex items-center p-4 bg-gray-50 rounded-lg cursor-not-allowed">
                    <i class="fas fa-download text-gray-400 mr-3 text-lg"></i>
                    <div>
                        <p class="font-medium text-gray-400">Download PHS Template</p>
                        <p class="text-sm text-gray-400">Get a printable version (Coming Soon)</p>
                    </div>
                    <i class="fas fa-lock text-gray-400 ml-auto"></i>
                </button>
                
                <button disabled class="flex items-center p-4 bg-gray-50 rounded-lg cursor-not-allowed">
                    <i class="fas fa-print text-gray-400 mr-3 text-lg"></i>
                    <div>
                        <p class="font-medium text-gray-400">Print PHS</p>
                        <p class="text-sm text-gray-400">Print your completed form (Coming Soon)</p>
                    </div>
                    <i class="fas fa-lock text-gray-400 ml-auto"></i>
                </button>
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