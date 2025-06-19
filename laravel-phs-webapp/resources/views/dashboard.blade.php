@extends('layouts.client')

@section('title', 'Dashboard - Personal History Statement')
@section('header', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- PHS Status -->
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-file-alt text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">PHS Status</p>
                    <p class="text-2xl font-bold text-gray-900">@if($phsStatus) {{ ucfirst($phsStatus) }} @else Not Started @endif</p>
                </div>
            </div>
        </div>
        <!-- PDS Status -->
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-id-card text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">PDS Status</p>
                    <p class="text-2xl font-bold text-gray-900">@if($pdsStatus) {{ ucfirst($pdsStatus) }} @else Not Started @endif</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
        <!-- PHS Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-[1.02] slide-in">
            <div class="p-8">
                <div class="flex items-center justify-center w-16 h-16 bg-[#1B365D] rounded-full mb-6 mx-auto">
                    <i class="fas fa-file-alt text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-center text-[#1B365D] mb-4">Personal History Statement</h3>
                <p class="text-gray-600 text-center mb-6">
                    Complete your PHS form to provide detailed information about your personal background, education, and experience.
                </p>
                <div class="text-center">
                    <a href="{{ route('phs.create') }}" class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                        <i class="fas fa-edit mr-2"></i>
                        Fill Out PHS
                    </a>
                </div>
            </div>
        </div>
        <!-- PDS Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-[1.02] slide-in">
            <div class="p-8">
                <div class="flex items-center justify-center w-16 h-16 bg-[#1B365D] rounded-full mb-6 mx-auto">
                    <i class="fas fa-id-card text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-center text-[#1B365D] mb-4">Personal Data Sheet</h3>
                <p class="text-gray-600 text-center mb-6">
                    Submit your PDS to provide essential personal and professional information for official records.
                </p>
                <div class="text-center">
                    <a href="#" class="btn-primary inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D]">
                        <i class="fas fa-file-upload mr-2"></i>
                        Submit PDS
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- PMA Information Section -->
    <div class="mt-16 bg-white rounded-xl shadow-lg overflow-hidden p-8 scale-in">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-[#1B365D]">About Philippine Military Academy</h2>
            <p class="text-gray-600 mt-2">The Premier Military School in the Philippines</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <i class="fas fa-graduation-cap text-4xl text-[#1B365D] mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Military Education</h3>
                <p class="text-gray-600">Training future leaders of the Armed Forces of the Philippines</p>
            </div>
            <div class="text-center">
                <i class="fas fa-medal text-4xl text-[#1B365D] mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Excellence</h3>
                <p class="text-gray-600">Producing distinguished military officers since 1905</p>
            </div>
            <div class="text-center">
                <i class="fas fa-mountain text-4xl text-[#1B365D] mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">Location</h3>
                <p class="text-gray-600">Fort Del Pilar, Baguio City, Philippines</p>
            </div>
        </div>
    </div>
</div>
@endsection 