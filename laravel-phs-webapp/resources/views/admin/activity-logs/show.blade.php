@extends('layouts.admin')

@section('title', 'Activity Log Details')
@section('header', 'Activity Log Details')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Navigation -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.activity-logs.index') }}" 
           class="inline-flex items-center text-[#1B365D] hover:text-[#2B4B7D] font-medium transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Activity Logs
        </a>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                @if($activityLog->act_stat === 'success') bg-green-100 text-green-800
                @elseif($activityLog->act_stat === 'warning') bg-[#D4AF37]/20 text-[#D4AF37]
                @else bg-red-100 text-red-800
                @endif">
                {{ ucfirst($activityLog->act_stat) }}
            </span>
        </div>
    </div>

    <!-- Main Activity Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-[#1B365D]/10 to-[#2B4B7D]/10 px-8 py-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] text-white shadow-lg">
                        <i class="{{ $activityLog->action_icon }} text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold text-gray-900">
                            @php
                                $actionLabels = [
                                    'access_own_phs' => 'Access',
                                    'return_to_admin' => 'Return',
                                    'login' => 'Login',
                                    'logout' => 'Logout',
                                    'create' => 'Create',
                                    'update' => 'Update',
                                    'delete' => 'Delete',
                                    'submit' => 'Submit',
                                    'enable' => 'Enable',
                                    'disable' => 'Disable',
                                    'password_reset' => 'Reset',
                                ];
                                echo $actionLabels[$activityLog->action] ?? ucfirst(explode('_', $activityLog->action)[0]);
                            @endphp
                        </h1>
                        <p class="text-gray-600">
                            @if($activityLog->act_date_time)
                                {{ $activityLog->act_date_time->setTimezone('Asia/Manila')->format('F d, Y \a\t h:i:s A') }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Activity ID</p>
                    <p class="font-mono text-sm text-gray-700">#{{ $activityLog->act_id }}</p>
                </div>
            </div>
        </div>

        <!-- Card Content -->
        <div class="p-8">
            <!-- User Information Section -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user mr-2 text-[#1B365D]"></i>
                    User Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center text-white text-lg font-semibold">
                                {{ substr($activityLog->user->name ?? 'N/A', 0, 1) }}
                            </div>
                            <div class="ml-4">
                                <h3 class="font-semibold text-gray-900">{{ $activityLog->user->name ?? 'N/A' }}</h3>
                                <p class="text-sm text-gray-500">{{ $activityLog->user->username ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium text-gray-900">{{ $activityLog->user->email ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">User Type:</span>
                                <span class="font-medium text-gray-900">{{ ucfirst($activityLog->user->usertype ?? 'N/A') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-[#1B365D]"></i>
                            Activity Details
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Action:</span>
                                <span class="font-medium text-gray-900">
                                    @php
                                        $actionLabels = [
                                            'access_own_phs' => 'Access',
                                            'return_to_admin' => 'Return',
                                            'login' => 'Login',
                                            'logout' => 'Logout',
                                            'create' => 'Create',
                                            'update' => 'Update',
                                            'delete' => 'Delete',
                                            'submit' => 'Submit',
                                            'enable' => 'Enable',
                                            'disable' => 'Disable',
                                            'password_reset' => 'Reset',
                                        ];
                                        echo $actionLabels[$activityLog->action] ?? ucfirst(explode('_', $activityLog->action)[0]);
                                    @endphp
                                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Status:</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                    @if($activityLog->act_stat === 'success') bg-green-100 text-green-800
                    @elseif($activityLog->act_stat === 'warning') bg-[#D4AF37]/20 text-[#D4AF37]
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($activityLog->act_stat) }}
                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Date:</span>
                                <span class="font-medium text-gray-900">
                                    @if($activityLog->act_date_time)
                                        {{ $activityLog->act_date_time->setTimezone('Asia/Manila')->format('M d, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Time:</span>
                                <span class="font-medium text-gray-900">
                                    @if($activityLog->act_date_time)
                                        {{ $activityLog->act_date_time->setTimezone('Asia/Manila')->format('h:i:s A') }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-align-left mr-2 text-[#1B365D]"></i>
                    Activity Description
                </h2>
                <div class="bg-gray-50 rounded-xl p-6">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $activityLog->act_desc }}</p>
        </div>
        </div>

            <!-- Technical Details Section -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-cogs mr-2 text-[#1B365D]"></i>
                    Technical Details
                </h2>
                <div class="bg-gray-50 rounded-xl p-6">
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-600">IP Address:</span>
                            <p class="font-mono text-sm text-gray-900 bg-white px-3 py-2 rounded-lg border">{{ $activityLog->ip_addr ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">User Agent:</span>
                            <p class="text-sm text-gray-900 bg-white px-3 py-2 rounded-lg border break-all">{{ $activityLog->user_agent ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Actions -->
            <div class="border-t border-gray-200 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-link mr-2 text-[#1B365D]"></i>
                    Related Actions
                </h2>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.activity-logs.index', ['user_id' => $activityLog->user->username]) }}" 
                       class="inline-flex items-center px-4 py-2 bg-[#1B365D]/10 text-[#1B365D] rounded-lg hover:bg-[#1B365D]/20 transition-colors border border-[#1B365D]/20">
                        <i class="fas fa-list mr-2"></i>
                        View All Logs
                    </a>
                    @if($activityLog->user)
                    <a href="{{ route('admin.users.show', $activityLog->user) }}" 
                       class="inline-flex items-center px-4 py-2 bg-[#D4AF37]/10 text-[#D4AF37] rounded-lg hover:bg-[#D4AF37]/20 transition-colors border border-[#D4AF37]/20">
                        <i class="fas fa-user mr-2"></i>
                        View User Profile
                    </a>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<style>
/* Print styles */
@media print {
    .admin-layout {
        background: white !important;
    }
    
    .sidebar, .admin-header {
        display: none !important;
    }
    
    .main-content-wrapper {
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .bg-gray-50 {
        background-color: #f9fafb !important;
    }
    
    .shadow-lg {
        box-shadow: none !important;
    }
    
    .border {
        border: 1px solid #e5e7eb !important;
    }
}

/* Enhanced animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.bg-white {
    animation: fadeInUp 0.6s ease-out;
}
</style>

<script>
// Add any additional JavaScript functionality here
document.addEventListener('DOMContentLoaded', function() {
    // Highlight the current activity log in any lists
    console.log('Activity log details loaded');
});
</script>
@endsection 