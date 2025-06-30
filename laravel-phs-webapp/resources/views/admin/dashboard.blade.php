@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center">
                    <span class="text-sm font-medium text-green-600">
                        <i class="fas fa-arrow-up"></i> {{ $newUsersThisMonth }}
                    </span>
                    <span class="text-sm text-gray-500 ml-2">this month</span>
                </div>
            </div>
        </div>

        <!-- Active Users -->
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-user-check text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Active Users</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $enabledUsers }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center">
                    <span class="text-sm font-medium text-green-600">
                        @if ($totalUsers > 0)
                            {{ number_format(($enabledUsers / $totalUsers) * 100, 1) }}%
                        @else
                            0%
                        @endif
                    </span>
                    <span class="text-sm text-gray-500 ml-2">are active</span>
                </div>
            </div>
        </div>

        <!-- PHS Submissions -->
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-file-alt text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">PHS Submissions</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalPHSSubmissions }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center">
                    <span class="text-sm font-medium text-green-600">
                        <i class="fas fa-arrow-up"></i> {{ $newPHSSubmissionsThisMonth }}
                    </span>
                    <span class="text-sm text-gray-500 ml-2">this month</span>
                </div>
            </div>
        </div>

        <!-- PDS Submissions -->
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-file-pdf text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">PDS Submissions</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalPDSSubmissions }}</p>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center">
                    <span class="text-sm font-medium text-green-600">
                        <i class="fas fa-arrow-up"></i> {{ $newPDSSubmissionsThisMonth }}
                    </span>
                    <span class="text-sm text-gray-500 ml-2">this month</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Submission Status Distribution -->
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Submission Status Distribution</h3>
            <div class="h-80">
                <canvas id="submissionStatusChart"></canvas>
            </div>
        </div>

        <!-- Monthly Submissions -->
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Monthly Submissions</h3>
            <div class="h-80">
                <canvas id="monthlySubmissionsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-medium text-gray-900">Recent Activity</h3>
            <a href="#" class="text-sm font-medium text-[#1B365D] hover:text-[#2B4B7D]">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentActivities as $activity)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-[#1B365D] flex items-center justify-center text-white">
                                        {{ strtoupper(substr($activity->user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $activity->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $activity->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $activity->description }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $activity->created_at->diffForHumans() }}<br>
                            <span class="text-xs text-gray-400">{{ $activity->created_at->format('l, F d, Y, g:i:s A') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($activity->status === 'success') bg-green-100 text-green-800
                                @elseif($activity->status === 'warning') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($activity->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No recent activity found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Submission Status Chart
    const submissionStatusCtx = document.getElementById('submissionStatusChart').getContext('2d');
    new Chart(submissionStatusCtx, {
        type: 'pie',
        data: {
            labels: ['Pending', 'Reviewed', 'Approved', 'Rejected'],
            datasets: [{
                data: [
                    {{ $submissionStats['pending'] }},
                    {{ $submissionStats['reviewed'] }},
                    {{ $submissionStats['approved'] }},
                    {{ $submissionStats['rejected'] }}
                ],
                backgroundColor: [
                    '#FCD34D', // yellow
                    '#60A5FA', // blue
                    '#34D399', // green
                    '#F87171'  // red
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Monthly Submissions Chart
    const monthlySubmissionsCtx = document.getElementById('monthlySubmissionsChart').getContext('2d');
    new Chart(monthlySubmissionsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyStats->pluck('month')) !!},
            datasets: [{
                label: 'PHS Submissions',
                data: {!! json_encode($monthlyStats->pluck('phs_count')) !!},
                backgroundColor: '#1B365D'
            }, {
                label: 'PDS Submissions',
                data: {!! json_encode($monthlyStats->pluck('pds_count')) !!},
                backgroundColor: '#D4AF37'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

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