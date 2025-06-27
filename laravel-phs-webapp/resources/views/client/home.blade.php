@extends('layouts.client')

@section('title', 'Dashboard - Personal History Statement')
@section('header', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] rounded-2xl p-8 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h1>
                    <p class="text-[#D4AF37] text-lg">Complete your Personal History Statement and Personal Data Sheet</p>
                </div>
                <div class="w-20 h-20 bg-[#D4AF37] rounded-full flex items-center justify-center overflow-hidden ml-8 shadow-lg border-4 border-white">
                    @if(auth()->user()->profile_picture)
                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" 
                             alt="Profile" 
                             class="w-full h-full object-cover rounded-full">
                    @else
                        <i class="fas fa-user text-[#1B365D] text-4xl"></i>
                    @endif
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#D4AF37] opacity-10 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#D4AF37] opacity-10 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Progress Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- PHS Progress Card -->
        <a href="{{ route('phs.create') }}" class="block group cursor-pointer bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Personal History Statement</h3>
                        <p class="text-sm text-gray-500">Document Status</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                        @if($phsStatus == 'completed') bg-green-100 text-green-800
                        @elseif($phsStatus == 'in_progress') bg-yellow-100 text-yellow-800
                        @else bg-gray-100 text-gray-800 @endif">
                        @if($phsStatus) {{ ucfirst(str_replace('_', ' ', $phsStatus)) }} @else Not Started @endif
                    </span>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-2">
                    <span>Progress</span>
                    <span>
                        @if($phsStatus == 'completed') 100%
                        @elseif($phsStatus == 'in_progress') 65%
                        @else 0% @endif
                    </span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="h-2 rounded-full transition-all duration-500
                        @if($phsStatus == 'completed') bg-green-500 w-full
                        @elseif($phsStatus == 'in_progress') bg-yellow-500 w-2/3
                        @else bg-gray-300 w-0 @endif">
                    </div>
                </div>
            </div>
            
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    <i class="fas fa-clock mr-1"></i>
                    Last updated: {{ now()->format('M d, Y') }}
                </div>
                <span class="inline-flex items-center px-4 py-2 bg-[#1B365D] text-white text-sm font-medium rounded-lg pointer-events-none opacity-80">
                    <i class="fas fa-edit mr-2"></i>
                    @if($phsStatus == 'completed') Review @else Start @endif
                </span>
            </div>
        </a>

        <!-- PDS Progress Card (Grayed Out Placeholder) -->
        <div class="bg-gray-100 rounded-2xl shadow-lg p-6 border border-gray-200 opacity-60">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gray-300 rounded-xl flex items-center justify-center">
                        <i class="fas fa-id-card text-gray-500 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-500">Personal Data Sheet</h3>
                        <p class="text-sm text-gray-400">Coming Soon</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-200 text-gray-500">
                        Not Available
                    </span>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-400 mb-2">
                    <span>Progress</span>
                    <span>0%</span>
                </div>
                <div class="w-full bg-gray-300 rounded-full h-2">
                    <div class="h-2 rounded-full bg-gray-400 w-0"></div>
                </div>
            </div>
            
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-400">
                    <i class="fas fa-clock mr-1"></i>
                    Feature coming soon
                </div>
                <button class="inline-flex items-center px-4 py-2 bg-gray-400 text-gray-600 text-sm font-medium rounded-lg cursor-not-allowed opacity-50">
                    <i class="fas fa-lock mr-2"></i>
                    Start
                </button>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
        <h2 class="text-2xl font-bold text-[#1B365D] mb-6 flex items-center">
            <i class="fas fa-bolt mr-3 text-[#D4AF37]"></i>
            Quick Actions
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- PHS Action -->
            <div class="group relative bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all duration-300 hover:scale-105 cursor-pointer">
                <a href="{{ route('phs.create') }}" class="absolute inset-0 z-10" aria-label="Go to PHS"></a>
                <div class="flex items-center justify-center w-16 h-16 bg-[#1B365D] rounded-full mb-4 mx-auto group-hover:bg-[#2B4B7D] transition-colors duration-300">
                    <i class="fas fa-file-alt text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-center text-[#1B365D] mb-3">Personal History Statement</h3>
                <p class="text-gray-600 text-center mb-6 text-sm">
                    Complete your comprehensive PHS form with detailed personal, educational, and professional information.
                </p>
                <div class="text-center">
                    <span class="inline-flex items-center px-6 py-3 bg-[#1B365D] text-white font-medium rounded-lg pointer-events-none opacity-80">
                        <i class="fas fa-edit mr-2"></i>
                        @if($phsStatus == 'completed') Review PHS @else Start PHS @endif
                    </span>
                </div>
            </div>

            <!-- PDS Action (Grayed Out) -->
            <div class="group relative bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200 opacity-60">
                <div class="flex items-center justify-center w-16 h-16 bg-gray-400 rounded-full mb-4 mx-auto">
                    <i class="fas fa-id-card text-2xl text-gray-600"></i>
                </div>
                <h3 class="text-xl font-bold text-center text-gray-500 mb-3">Personal Data Sheet</h3>
                <p class="text-gray-400 text-center mb-6 text-sm">
                    This feature is coming soon. Stay tuned for updates.
                </p>
                <div class="text-center">
                    <button class="inline-flex items-center px-6 py-3 bg-gray-400 text-gray-600 font-medium rounded-lg cursor-not-allowed opacity-50">
                        <i class="fas fa-lock mr-2"></i>
                        Start PDS
                    </button>
                </div>
            </div>

            <!-- Profile Action -->
            <div class="group relative bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200 hover:shadow-lg transition-all duration-300 hover:scale-105 cursor-pointer">
                <a href="{{ route('profile.edit') }}" class="absolute inset-0 z-10" aria-label="Go to Profile"></a>
                <div class="flex items-center justify-center w-16 h-16 bg-[#1B365D] rounded-full mb-4 mx-auto group-hover:bg-[#2B4B7D] transition-colors duration-300">
                    <i class="fas fa-user-edit text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-center text-[#1B365D] mb-3">Edit Profile</h3>
                <p class="text-gray-600 text-center mb-6 text-sm">
                    Update your personal information, contact details, and account settings.
                </p>
                <div class="text-center">
                    <span class="inline-flex items-center px-6 py-3 bg-[#1B365D] text-white font-medium rounded-lg pointer-events-none opacity-80">
                        <i class="fas fa-cog mr-2"></i>
                        Manage Profile
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- PMA Information Section -->
    <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] rounded-2xl p-8 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-5"></div>
        <div class="relative z-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold mb-2">Philippine Military Academy</h2>
                <p class="text-[#D4AF37] text-lg">The Premier Military School in the Philippines</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div class="w-16 h-16 bg-[#D4AF37] rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-graduation-cap text-[#1B365D] text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Military Education</h3>
                    <p class="text-gray-200 text-sm">Training future leaders of the Armed Forces of the Philippines</p>
                </div>
                
                <div class="text-center group">
                    <div class="w-16 h-16 bg-[#D4AF37] rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-medal text-[#1B365D] text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Excellence</h3>
                    <p class="text-gray-200 text-sm">Producing distinguished military officers since 1905</p>
                </div>
                
                <div class="text-center group">
                    <a href="https://www.google.com/maps/place/Philippine+Military+Academy+(PMA)/@16.3448472,120.6101311,14.18z/data=!4m10!1m2!2m1!1sPMA!3m6!1s0x3391a140001b5169:0x3e6e8c0c41cfb35a!8m2!3d16.360888!4d120.619414!15sCgNQTUGSAQ9taWxpdGFyeV9zY2hvb2yqASoQATIdEAEiGVhxt5fJUUiIqeZ8vr3CUEe_6KFeKT8HghAyBxACIgNwbWHgAQA!16zL20vMDhwbmY1?entry=ttu&g_ep=EgoyMDI1MDYyMy4yIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener noreferrer" class="block group cursor-pointer hover:shadow-lg transition-shadow duration-300">
                        <div class="w-16 h-16 bg-[#D4AF37] rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-mountain text-[#1B365D] text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Location</h3>
                        <p class="text-gray-200 text-sm">Fort Del Pilar, Baguio City, Philippines</p>
                    </a>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <div class="inline-flex items-center space-x-6">
                    <a href="https://www.pma.edu.ph/" target="_blank" 
                       class="flex items-center space-x-2 text-[#D4AF37] hover:text-white transition-colors duration-200">
                        <i class="fas fa-globe text-lg"></i>
                        <span>Official Website</span>
                    </a>
                    <a href="https://www.facebook.com/philippinemilitaryacademypublicaffairs/" target="_blank"
                       class="flex items-center space-x-2 text-[#D4AF37] hover:text-white transition-colors duration-200">
                        <i class="fab fa-facebook text-lg"></i>
                        <span>Facebook Page</span>
                    </a>
                    <a href="https://www.pma.edu.ph/charter.pdf" target="_blank" class="flex items-center space-x-2 text-[#D4AF37] hover:text-white transition-colors duration-200">
                        <i class="fas fa-file-alt text-lg"></i>
                        <span>PMA Charter's Chart</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#D4AF37] opacity-10 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#D4AF37] opacity-10 rounded-full translate-y-12 -translate-x-12"></div>
    </div>
</div>

<!-- Simple Transition Overlay -->
<div id="transition-overlay" class="fixed inset-0 bg-[#1B365D] z-50 opacity-0 transition-opacity duration-300 ease-in-out pointer-events-none">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-white text-center">
            <div class="mb-4">
                <img src="{{ asset('images/pma_logo.svg') }}" 
                     alt="PMA Logo" 
                     class="w-16 h-16 mx-auto">
            </div>
            <h3 class="text-xl font-semibold">Loading PHS Form...</h3>
        </div>
    </div>
</div>

<script>
// Simple transition for PHS buttons
document.addEventListener('DOMContentLoaded', function() {
    const phsButtons = document.querySelectorAll('#start-phs-btn, #phs-action-btn');
    const transitionOverlay = document.getElementById('transition-overlay');
    
    phsButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Show overlay
            transitionOverlay.classList.remove('opacity-0', 'pointer-events-none');
            transitionOverlay.classList.add('opacity-100');
            
            // Navigate after brief delay
            setTimeout(() => {
                window.location.href = this.href;
            }, 400);
        });
    });
});
</script>
@endsection 