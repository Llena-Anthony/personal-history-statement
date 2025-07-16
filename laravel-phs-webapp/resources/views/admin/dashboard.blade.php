@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Enhanced Header with Welcome Message -->
    <div class="relative overflow-hidden rounded-2xl shadow-xl">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat welcome-banner-bg" style="background-image: url('{{ asset('images/pmabg1.png') }}');">
            <div class="absolute inset-0 bg-gradient-to-r from-[#1B365D]/90 to-[#2B4B7D]/80"></div>
        </div>
        
        <!-- Welcome Content -->
        <div class="relative p-8 text-white z-10 welcome-banner-content">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2 welcome-banner-title">Welcome back, {{ $adminName }}! 👋</h1>
                    <p class="text-white/80 text-lg welcome-banner-subtitle">Here's what's happening with your system today</p>
                    <div class="flex items-center mt-4 space-x-6 text-sm welcome-banner-stats">
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-2 text-[#D4AF37]"></i>
                            <span id="current-time" class="loading">Loading...</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-users mr-2 text-[#D4AF37]"></i>
                            <span>{{ $totalUsers ?? 0 }} total users</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar mr-2 text-[#D4AF37]"></i>
                            <span id="current-date" class="loading">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-chart-line text-4xl text-[#D4AF37]"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.users.create') }}" class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1">
            <div class="flex items-center">
                <div class="p-3 bg-[#1B365D]/10 rounded-xl">
                    <i class="fas fa-user-plus text-[#1B365D] text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-gray-900">Add User</h3>
                    <p class="text-sm text-gray-500">Create new account</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.activity-logs.index') }}" class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1">
            <div class="flex items-center">
                <div class="p-3 bg-[#D4AF37]/10 rounded-xl">
                    <i class="fas fa-history text-[#D4AF37] text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-gray-900">Activity Logs</h3>
                    <p class="text-sm text-gray-500">View system activity</p>
                </div>
            </div>
        </a>
        
        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1">
            <div class="flex items-center">
                <div class="p-3 bg-[#1B365D]/10 rounded-xl">
                    <i class="fas fa-users-cog text-[#1B365D] text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-gray-900">Manage Users</h3>
                    <p class="text-sm text-gray-500">User management</p>
                </div>
            </div>
        </a>
        
        <a href="#" class="bg-white rounded-xl p-6 shadow-sm border border-gray-200 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-1">
                <div class="flex items-center">
                <div class="p-3 bg-[#D4AF37]/10 rounded-xl">
                    <i class="fas fa-file-alt text-[#D4AF37] text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-gray-900">Reports</h3>
                    <p class="text-sm text-gray-500">Generate reports</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalUsers) }}</p>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] rounded-xl">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-sm font-semibold text-[#D4AF37] flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        {{ $newUsersThisMonth }}
                    </span>
                    <span class="text-sm text-gray-500 ml-2">this month</span>
                </div>
            </div>
            <div class="bg-gradient-to-r from-[#1B365D]/10 to-[#2B4B7D]/10 px-6 py-3">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-[#1B365D]">Active: {{ $enabledUsers }}</span>
                    <span class="text-[#2B4B7D]">{{ $totalUsers > 0 ? number_format(($enabledUsers / $totalUsers) * 100, 1) : 0 }}%</span>
                </div>
            </div>
        </div>

        <!-- Active Users -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Users</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($enabledUsers) }}</p>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-[#D4AF37] to-[#B38F2A] rounded-xl">
                        <i class="fas fa-user-check text-white text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-sm font-semibold text-[#D4AF37] flex items-center">
                        <i class="fas fa-check-circle mr-1"></i>
                        {{ $totalUsers > 0 ? number_format(($enabledUsers / $totalUsers) * 100, 1) : 0 }}%
                    </span>
                    <span class="text-sm text-gray-500 ml-2">of total users</span>
                </div>
            </div>
            <div class="bg-gradient-to-r from-[#D4AF37]/10 to-[#B38F2A]/10 px-6 py-3">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-[#B38F2A]">Inactive: {{ $totalUsers - $enabledUsers }}</span>
                    <span class="text-[#D4AF37]">{{ $totalUsers > 0 ? number_format((($totalUsers - $enabledUsers) / $totalUsers) * 100, 1) : 0 }}%</span>
                </div>
            </div>
        </div>

        <!-- PHS Submissions -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">PHS Submissions</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalPHSSubmissions) }}</p>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] rounded-xl">
                        <i class="fas fa-file-alt text-white text-2xl"></i>
                </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-sm font-semibold text-[#D4AF37] flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        {{ $newPHSSubmissionsThisMonth }}
                    </span>
                    <span class="text-sm text-gray-500 ml-2">this month</span>
                </div>
            </div>
            <div class="bg-gradient-to-r from-[#1B365D]/10 to-[#2B4B7D]/10 px-6 py-3">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-[#1B365D]">Pending: {{ $submissionStats['pending'] ?? 0 }}</span>
                    <span class="text-[#2B4B7D]">Approved: {{ $submissionStats['approved'] ?? 0 }}</span>
                </div>
            </div>
        </div>

        <!-- PDS Submissions -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">PDS Submissions</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalPDSSubmissions) }}</p>
                    </div>
                    <div class="p-4 bg-gradient-to-br from-[#D4AF37] to-[#B38F2A] rounded-xl">
                        <i class="fas fa-file-pdf text-white text-2xl"></i>
                </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-sm font-semibold text-[#D4AF37] flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>
                        {{ $newPDSSubmissionsThisMonth }}
                    </span>
                    <span class="text-sm text-gray-500 ml-2">this month</span>
                </div>
            </div>
            <div class="bg-gradient-to-r from-[#D4AF37]/10 to-[#B38F2A]/10 px-6 py-3">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-[#B38F2A]">This Week: {{ $newPDSSubmissionsThisMonth }}</span>
                    <span class="text-[#D4AF37]">Total: {{ $totalPDSSubmissions }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Submission Status Distribution -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-900">Submission Status</h3>
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 bg-[#D4AF37] rounded-full"></span>
                        <span class="text-sm text-gray-600">Distribution</span>
                    </div>
                </div>
            </div>
            <div class="p-6">
            <div class="h-80">
                <canvas id="submissionStatusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Monthly Submissions Trend -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-900">Monthly Trends</h3>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <span class="w-3 h-3 bg-[#1B365D] rounded-full"></span>
                            <span class="text-sm text-gray-600">PHS</span>
                        </div>
                        <div class="flex items-center space-x-2 opacity-50 cursor-not-allowed" title="PDS in development by another team">
                            <span class="w-3 h-3 bg-gray-400 rounded-full"></span>
                            <span class="text-sm text-gray-400">PDS (coming soon)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6">
            <div class="h-80">
                <canvas id="monthlySubmissionsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- User Type Distribution & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- User Type Distribution -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-xl font-semibold text-gray-900">User Types</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-[#1B365D]/10 rounded-xl">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-[#1B365D] rounded-full mr-3"></div>
                            <span class="font-medium text-gray-900">Administrators</span>
                        </div>
                        <span class="text-2xl font-bold text-[#1B365D]">{{ $users->where('usertype', 'admin')->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-[#D4AF37]/10 rounded-xl">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-[#D4AF37] rounded-full mr-3"></div>
                            <span class="font-medium text-gray-900">Personnel</span>
                        </div>
                        <span class="text-2xl font-bold text-[#D4AF37]">{{ $users->where('usertype', 'personnel')->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-[#1B365D]/10 rounded-xl">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-[#1B365D] rounded-full mr-3"></div>
                            <span class="font-medium text-gray-900">Clients</span>
                        </div>
                        <span class="text-2xl font-bold text-[#1B365D]">{{ $users->where('usertype', 'client')->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-900">Recent Activity</h3>
                    <a href="{{ route('admin.activity-logs.index') }}" class="text-sm font-medium text-[#1B365D] hover:text-[#D4AF37] transition-colors">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @forelse($recentActivities as $activity)
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] rounded-full flex items-center justify-center text-white font-semibold">
                                        {{ strtoupper(substr($activity->changes_made_by ?? 'U', 0, 1)) }}
                                    </div>
                                </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900">{{ $activity->changes_made_by ?? 'Unknown User' }}</p>
                                <span class="text-xs text-gray-500">{{ $activity->act_date_time ? $activity->act_date_time->diffForHumans() : 'Unknown' }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $activity->act_desc ?? 'No description' }}</p>
                            <div class="flex items-center mt-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                @if($activity->act_stat === 'success') bg-green-100 text-green-800
                                @elseif($activity->act_stat === 'warning') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                    <i class="fas fa-circle mr-1 text-xs"></i>
                                {{ ucfirst($activity->act_stat ?? 'unknown') }}
                            </span>
                                <span class="text-xs text-gray-500 ml-3">{{ $activity->act_date_time ? $activity->act_date_time->format('M d, g:i A') : 'Unknown' }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">No recent activity found</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- System Health & Performance -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- System Health -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-xl font-semibold text-gray-900">System Health</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-600">Database Status</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>
                            Healthy
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-600">Server Load</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-[#1B365D]/10 text-[#1B365D]">
                            <i class="fas fa-server mr-1"></i>
                            Normal
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-600">Last Backup</span>
                        <span class="text-sm text-gray-900">{{ now()->subDays(1)->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h3 class="text-xl font-semibold text-gray-900">Quick Stats</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-4 bg-[#1B365D]/10 rounded-xl">
                        <div class="text-2xl font-bold text-[#1B365D]">{{ $totalUsers }}</div>
                        <div class="text-sm text-gray-600">Total Users</div>
                    </div>
                    <div class="text-center p-4 bg-[#D4AF37]/10 rounded-xl">
                        <div class="text-2xl font-bold text-[#D4AF37]">{{ $totalPHSSubmissions + $totalPDSSubmissions }}</div>
                        <div class="text-sm text-gray-600">Total Submissions</div>
                    </div>
                    <div class="text-center p-4 bg-[#1B365D]/10 rounded-xl">
                        <div class="text-2xl font-bold text-[#1B365D]">{{ $submissionStats['pending'] ?? 0 }}</div>
                        <div class="text-sm text-gray-600">Pending Review</div>
                    </div>
                    <div class="text-center p-4 bg-[#D4AF37]/10 rounded-xl">
                        <div class="text-2xl font-bold text-[#D4AF37]">{{ $recentActivities->count() }}</div>
                        <div class="text-sm text-gray-600">Today's Activities</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Switch to Client View Info Modal -->
<div id="switchInfoModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="switchInfoModalContent">
        <div class="p-6">
            <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mx-auto mb-4">
                <i class="fas fa-file-alt text-2xl text-blue-600"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 text-center mb-4">Access My PHS</h3>
            
            <div class="space-y-4 text-sm text-gray-600">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-blue-900 mb-2">What this feature does:</h4>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-blue-600 mt-1 mr-2"></i>
                            <span>Access your own Personal History Statement as an Academy member</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-blue-600 mt-1 mr-2"></i>
                            <span>Fill out and manage your PHS forms using the client interface</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-blue-600 mt-1 mr-2"></i>
                            <span>Submit your completed PHS for review and processing</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-blue-600 mt-1 mr-2"></i>
                            <span>Switch back to admin view anytime using the "Return to Admin" button</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-yellow-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-yellow-900 mb-2">Important Notes:</h4>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-2"></i>
                            <span>You'll be working on your own PHS as an Academy member</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-2"></i>
                            <span>Your PHS submission will be processed like any other member's submission</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-2"></i>
                            <span>Ensure all information is accurate and complete before submission</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="flex space-x-3 mt-6">
                <button onclick="hideSwitchInfo()" class="flex-1 px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors">
                    Got it
                </button>
                <a href="{{ route('admin.switch.to.client') }}" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors text-center">
                    Access My PHS
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Welcome Banner Styles */
.welcome-banner-bg {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    transition: all 0.3s ease;
    min-height: 200px;
}

.welcome-banner-bg.fallback {
    background-image: linear-gradient(135deg, #1B365D 0%, #2B4B7D 100%) !important;
}

/* Ensure proper text contrast */
.text-white\/80 {
    color: rgba(255, 255, 255, 0.8);
}

/* Loading animation for time/date */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.loading {
    animation: pulse 1.5s ease-in-out infinite;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .welcome-banner-bg {
        background-position: center center;
    }
    
    .welcome-banner-content {
        padding: 1rem !important;
    }
    
    .welcome-banner-title {
        font-size: 1.5rem !important;
        line-height: 1.2 !important;
    }
    
    .welcome-banner-stats {
        flex-direction: column !important;
        gap: 0.5rem !important;
    }
}

@media (max-width: 480px) {
    .welcome-banner-title {
        font-size: 1.25rem !important;
    }
    
    .welcome-banner-subtitle {
        font-size: 0.875rem !important;
    }
}

/* Enhanced animations */
.fade-in {
    animation: fadeIn 0.6s ease-out;
}

.slide-in {
    animation: slideIn 0.6s ease-out;
}

.scale-in {
    animation: scaleIn 0.6s ease-out;
}

@keyframes fadeIn {
    from { 
        opacity: 0; 
        transform: translateY(10px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

@keyframes slideIn {
    from { 
        transform: translateX(-20px); 
        opacity: 0; 
    }
    to { 
        transform: translateX(0); 
        opacity: 1; 
    }
}

@keyframes scaleIn {
    from { 
        transform: scale(0.95); 
        opacity: 0; 
    }
    to { 
        transform: scale(1); 
        opacity: 1; 
    }
}

/* Fallback styles for older browsers */
.welcome-banner-bg {
    background-color: #1B365D;
}

/* Ensure text is always readable */
.welcome-banner-content {
    position: relative;
    z-index: 10;
}

.welcome-banner-content h1,
.welcome-banner-content p,
.welcome-banner-content span {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script>
    // Register the DataLabels plugin globally
    if (window.Chart && window.ChartDataLabels) {
        Chart.register(window.ChartDataLabels);
    }

    // Welcome Banner Enhancement
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Welcome banner initialization started');
        
        // Handle background image error
        const bgElement = document.querySelector('.welcome-banner-bg');
        if (bgElement) {
            console.log('Background element found, setting up image error handling');
            const bgImage = new Image();
            bgImage.onerror = function() {
                console.log('Background image failed to load, using fallback');
                bgElement.classList.add('fallback');
            };
            bgImage.onload = function() {
                console.log('Background image loaded successfully');
            };
            bgImage.src = '{{ asset('images/pmabg1.png') }}';
        } else {
            console.warn('Background element not found');
        }

        // Handle user name display with better fallback
        const welcomeTitle = document.querySelector('.welcome-banner-title');
        if (welcomeTitle) {
            console.log('Welcome title found:', welcomeTitle.textContent);
            const userName = '{{ $adminName }}';
            if (userName && userName.trim() !== '') {
                console.log('User name is set:', userName);
            } else {
                console.log('Using fallback administrator name');
                welcomeTitle.textContent = 'Welcome back, {{ $adminName }}! 👋';
            }
        } else {
            console.warn('Welcome title not found');
        }

        // Enhanced time and date update with error handling
        function updateWelcomeTime() {
            try {
                const now = new Date();
                const timeElement = document.getElementById('current-time');
                const dateElement = document.getElementById('current-date');
                
                if (timeElement) {
                    timeElement.textContent = now.toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: true
                    });
                    timeElement.classList.remove('loading');
                } else {
                    console.warn('Time element not found');
                }
                
                if (dateElement) {
                    dateElement.textContent = now.toLocaleDateString('en-US', {
                        weekday: 'short',
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric'
                    });
                    dateElement.classList.remove('loading');
                } else {
                    console.warn('Date element not found');
                }
            } catch (error) {
                console.error('Error updating time/date:', error);
            }
        }

        // Update time immediately and then every second
        console.log('Setting up time updates');
        updateWelcomeTime();
        const timeInterval = setInterval(updateWelcomeTime, 1000);

        // Add animation classes to welcome banner
        const welcomeBanner = document.querySelector('.relative.overflow-hidden.rounded-2xl.shadow-xl');
        if (welcomeBanner) {
            console.log('Adding animation to welcome banner');
            welcomeBanner.classList.add('fade-in');
        } else {
            console.warn('Welcome banner element not found');
        }
        
        // Cleanup function for interval
        window.addEventListener('beforeunload', function() {
            clearInterval(timeInterval);
        });
        
        console.log('Welcome banner initialization completed');
    });

    // Update current time (legacy function for compatibility)
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = now.toLocaleString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        }
    }

    // Enhanced Submission Status Chart
    const submissionStatusCtx = document.getElementById('submissionStatusChart');
    if (submissionStatusCtx) {
        new Chart(submissionStatusCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Reviewed', 'Approved', 'Rejected'],
                datasets: [{
                    data: [
                        {{ $submissionStats['pending'] ?? 0 }},
                        {{ $submissionStats['reviewed'] ?? 0 }},
                        {{ $submissionStats['approved'] ?? 0 }},
                        {{ $submissionStats['rejected'] ?? 0 }}
                    ],
                    backgroundColor: [
                        '#D4AF37', // PMA Gold
                        '#1B365D', // PMA Navy
                        '#34D399', // Green
                        '#F87171'  // Red
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    title: {
                        display: true,
                        text: 'PHS Submission Status Distribution',
                        font: { size: 18, weight: 'bold' },
                        color: '#1B365D',
                        padding: { top: 10, bottom: 20 }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(27, 54, 93, 0.9)',
                        titleColor: '#D4AF37',
                        bodyColor: '#fff',
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                const total = context.chart._metasets[0].total;
                                const percent = total ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value} (${percent}%)`;
                            }
                        }
                    },
                    datalabels: {
                        display: true,
                        color: '#222',
                        font: { weight: 'bold', size: 14 },
                        formatter: (value, ctx) => value > 0 ? value : '',
                        anchor: 'end',
                        align: 'end',
                        offset: 8,
                        borderRadius: 4,
                        backgroundColor: 'rgba(255,255,255,0.8)',
                        padding: 4,
                        borderWidth: 1,
                        borderColor: '#D4AF37',
                        shadowBlur: 2
                    },
                    animation: {
                        animateRotate: true,
                        animateScale: true
                    }
                },
                cutout: '60%'
            },
            plugins: [ChartDataLabels]
        });
    }

    // Reverted Monthly Submissions Chart (no click-to-filter)
    const monthlySubmissionsCtx = document.getElementById('monthlySubmissionsChart');
    if (monthlySubmissionsCtx) {
        new Chart(monthlySubmissionsCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyStats->pluck('month')) !!},
                datasets: [{
                    label: 'PHS Submissions',
                    data: {!! json_encode($monthlyStats->pluck('phs_count')) !!},
                    borderColor: '#1B365D',
                    backgroundColor: 'rgba(27, 54, 93, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#1B365D',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            font: { size: 14 },
                            color: '#1B365D',
                            usePointStyle: true
                        }
                    },
                    title: {
                        display: true,
                        text: 'Monthly PHS Submissions Trend',
                        font: { size: 18, weight: 'bold' },
                        color: '#1B365D',
                        padding: { top: 10, bottom: 20 }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(27, 54, 93, 0.9)',
                        titleColor: '#D4AF37',
                        bodyColor: '#fff',
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.parsed.y}`;
                            }
                        }
                    },
                    datalabels: {
                        display: true,
                        color: '#1B365D',
                        font: { weight: 'bold', size: 13 },
                        align: 'top',
                        anchor: 'end',
                        offset: 4,
                        backgroundColor: 'rgba(255,255,255,0.85)',
                        borderRadius: 4,
                        borderWidth: 1,
                        borderColor: '#1B365D',
                        padding: 4,
                        formatter: (value, ctx) => value > 0 ? value : ''
                    },
                    animation: {
                        duration: 1200,
                        easing: 'easeInOutQuart'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Submissions',
                            font: { size: 14, weight: 'bold' },
                            color: '#1B365D'
                        },
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Month',
                            font: { size: 14, weight: 'bold' },
                            color: '#1B365D'
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            },
            plugins: [window.ChartDataLabels]
        });
    }

    // Switch to Client View Info Modal
    function showSwitchInfo() {
        const modal = document.getElementById('switchInfoModal');
        const modalContent = document.getElementById('switchInfoModalContent');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Trigger animation
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function hideSwitchInfo() {
        const modal = document.getElementById('switchInfoModal');
        const modalContent = document.getElementById('switchInfoModalContent');
        
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    // Close modal when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('switchInfoModal');
        if (modal) {
            modal.addEventListener('click', function(event) {
                if (event.target === this) {
                    hideSwitchInfo();
                }
            });
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            hideSwitchInfo();
        }
    });
</script>
@endpush

@endsection 