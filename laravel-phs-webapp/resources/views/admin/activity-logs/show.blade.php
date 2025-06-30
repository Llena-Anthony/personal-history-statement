@extends('layouts.admin')

@section('title', 'Activity Log Details')
@section('header', 'Activity Log Details')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Back Navigation -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.activity-logs.index') }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Activity Logs
        </a>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                @if($activityLog->status === 'success') bg-green-100 text-green-800
                @elseif($activityLog->status === 'warning') bg-yellow-100 text-yellow-800
                @else bg-red-100 text-red-800
                @endif">
                {{ ucfirst($activityLog->status) }}
            </span>
        </div>
    </div>

    <!-- Main Activity Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200/50 overflow-hidden">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-8 py-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-lg">
                        <i class="{{ $activityLog->action_icon }} text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold text-gray-900">{{ ucfirst(str_replace('_', ' ', $activityLog->action)) }}</h1>
                        <p class="text-gray-600">{{ $activityLog->created_at->setTimezone('Asia/Manila')->format('F d, Y \a\t h:i:s A') }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Activity ID</p>
                    <p class="font-mono text-sm text-gray-700">#{{ $activityLog->id }}</p>
                </div>
            </div>
        </div>

        <!-- Card Content -->
        <div class="p-8">
            <!-- User Information Section -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user mr-2 text-blue-500"></i>
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
                                <span class="text-gray-600">Role:</span>
                                <span class="font-medium text-gray-900">{{ ucfirst($activityLog->user->role ?? 'N/A') }}</span>
                            </div>
        </div>
        </div>
                    
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                            Activity Details
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Action:</span>
                                <span class="font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $activityLog->action)) }}</span>
        </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Status:</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                    @if($activityLog->status === 'success') bg-green-100 text-green-800
                    @elseif($activityLog->status === 'warning') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($activityLog->status) }}
                </span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Date:</span>
                                <span class="font-medium text-gray-900">{{ $activityLog->created_at->setTimezone('Asia/Manila')->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Time:</span>
                                <span class="font-medium text-gray-900">{{ $activityLog->created_at->setTimezone('Asia/Manila')->format('h:i:s A') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-align-left mr-2 text-blue-500"></i>
                    Activity Description
                </h2>
                <div class="bg-gray-50 rounded-xl p-6">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $activityLog->description }}</p>
        </div>
        </div>

            <!-- Technical Details Section -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-cogs mr-2 text-blue-500"></i>
                    Technical Details
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-network-wired mr-2 text-green-500"></i>
                            Network Information
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm text-gray-600">IP Address:</span>
                                <p class="font-mono text-sm text-gray-900 bg-white px-3 py-2 rounded-lg border">{{ $activityLog->ip_address ?? 'N/A' }}</p>
        </div>
                <div>
                                <span class="text-sm text-gray-600">User Agent:</span>
                                <p class="text-sm text-gray-900 bg-white px-3 py-2 rounded-lg border break-all">{{ $activityLog->user_agent ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-clock mr-2 text-purple-500"></i>
                            Timestamp Information
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Created:</span>
                                <span class="font-medium text-gray-900">{{ $activityLog->created_at->setTimezone('Asia/Manila')->format('M d, Y h:i:s A') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Updated:</span>
                                <span class="font-medium text-gray-900">{{ $activityLog->updated_at->setTimezone('Asia/Manila')->format('M d, Y h:i:s A') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Time Ago:</span>
                                <span class="font-medium text-gray-900">{{ $activityLog->created_at->setTimezone('Asia/Manila')->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Actions -->
            <div class="border-t border-gray-200 pt-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-link mr-2 text-blue-500"></i>
                    Related Actions
                </h2>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.activity-logs.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-list mr-2"></i>
                        View All Logs
                    </a>
                    @if($activityLog->user)
                    <a href="{{ route('admin.users.show', $activityLog->user->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
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