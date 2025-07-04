@extends('layouts.admin')

@section('title', 'PHS Submission Details')

@section('header', 'PHS Submission Details')

@section('content')
<div class="space-y-6">
    <!-- Enhanced Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#1B365D] flex items-center gap-3">
                <div class="bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] text-white p-3 rounded-xl shadow-lg">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
                PHS Submission Details
            </h1>
            <p class="text-gray-600 mt-2">View and manage Personal History Statement submission</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.phs.print', $user->username) }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl hover:from-emerald-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 shadow-lg">
                <i class="fas fa-print mr-2"></i>
                Print PHS
            </a>
            <a href="{{ route('admin.phs.edit', $user->username) }}" 
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] text-white rounded-xl hover:from-[#2B4B7D] hover:to-[#1B365D] focus:outline-none focus:ring-2 focus:ring-[#1B365D] focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 shadow-lg">
                <i class="fas fa-edit mr-2"></i>
                Edit Status
            </a>
        </div>
    </div>

    <!-- Submission Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#1B365D]/20 to-[#2B4B7D]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user text-[#1B365D] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Applicant</p>
                    <p class="text-lg font-bold text-gray-900">{{ $submission->user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $submission->user->username }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-[#D4AF37]/20 to-[#B38F2A]/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-flag text-[#D4AF37] text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Status</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                        @if($submission->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                        @elseif($submission->status === 'reviewed') bg-blue-100 text-blue-800 border border-blue-200
                        @elseif($submission->status === 'approved') bg-green-100 text-green-800 border border-green-200
                        @else bg-red-100 text-red-800 border border-red-200
                        @endif">
                        <i class="fas 
                            @if($submission->status === 'pending') fa-clock
                            @elseif($submission->status === 'reviewed') fa-eye
                            @elseif($submission->status === 'approved') fa-check-circle
                            @else fa-times-circle
                            @endif mr-1"></i>
                        {{ ucfirst($submission->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-all duration-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500/20 to-green-600/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-calendar text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Submitted</p>
                    <p class="text-lg font-bold text-gray-900">{{ $submission->created_at->format('M d, Y') }}</p>
                    <p class="text-sm text-gray-500">{{ $submission->created_at->format('h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Submission Details -->
    <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
            <i class="fas fa-info-circle text-[#1B365D] mr-3"></i>
            Submission Details
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Applicant Info -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Applicant Information</h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Full Name:</span>
                        <span class="text-sm text-gray-900">{{ $submission->user->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Username:</span>
                        <span class="text-sm text-gray-900">{{ $submission->user->username }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Email Address:</span>
                        <span class="text-sm text-gray-900">{{ $submission->user->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">User Type:</span>
                        <span class="text-sm text-gray-900">{{ ucfirst($submission->user->usertype ?? 'N/A') }}</span>
                    </div>
                </div>
            </div>

            <!-- Submission Status -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Submission Information</h4>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Status:</span>
                        <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
                            @if($submission->status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                            @elseif($submission->status === 'reviewed') bg-blue-100 text-blue-800 border border-blue-200
                            @elseif($submission->status === 'approved') bg-green-100 text-green-800 border border-green-200
                            @else bg-red-100 text-red-800 border border-red-200
                            @endif">
                            <i class="fas 
                                @if($submission->status === 'pending') fa-clock
                                @elseif($submission->status === 'reviewed') fa-eye
                                @elseif($submission->status === 'approved') fa-check-circle
                                @else fa-times-circle
                                @endif mr-1"></i>
                            {{ ucfirst($submission->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Submitted Date:</span>
                        <span class="text-sm text-gray-900">{{ $submission->created_at->format('M d, Y h:i A') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Last Updated:</span>
                        <span class="text-sm text-gray-900">{{ $submission->updated_at->format('M d, Y h:i A') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Days Since Submission:</span>
                        <span class="text-sm text-gray-900">{{ $submission->created_at->diffInDays(now()) }} days</span>
                    </div>
                </div>
            </div>
        </div>

        @if($submission->admin_notes)
        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <h4 class="text-sm font-semibold text-yellow-800 mb-2 flex items-center">
                <i class="fas fa-sticky-note mr-2"></i>
                Admin Notes
            </h4>
            <p class="text-sm text-yellow-700">{{ $submission->admin_notes }}</p>
        </div>
        @endif
    </div>

    <!-- PHS Form Sections -->
    <div class="space-y-6">
        <!-- Personal Information -->
        @if($submission->personalInfo)
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-user-circle text-[#1B365D] mr-3"></i>
                Personal Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Date of Birth:</span>
                        <span class="text-sm text-gray-900">{{ $submission->personalInfo->date_of_birth ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Place of Birth:</span>
                        <span class="text-sm text-gray-900">{{ $submission->personalInfo->place_of_birth ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Civil Status:</span>
                        <span class="text-sm text-gray-900">{{ $submission->personalInfo->civil_status ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Citizenship:</span>
                        <span class="text-sm text-gray-900">{{ $submission->personalInfo->citizenship ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Height:</span>
                        <span class="text-sm text-gray-900">{{ $submission->personalInfo->height ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Weight:</span>
                        <span class="text-sm text-gray-900">{{ $submission->personalInfo->weight ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Family History -->
        @if($submission->familyHistory && $submission->familyHistory->count() > 0)
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-users text-[#1B365D] mr-3"></i>
                Family History
            </h3>
            <div class="space-y-4">
                @foreach($submission->familyHistory as $familyMember)
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600">Name:</span>
                                <span class="text-sm text-gray-900">{{ $familyMember->name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600">Relationship:</span>
                                <span class="text-sm text-gray-900">{{ $familyMember->relationship ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600">Date of Birth:</span>
                                <span class="text-sm text-gray-900">{{ $familyMember->date_of_birth ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-600">Occupation:</span>
                                <span class="text-sm text-gray-900">{{ $familyMember->occupation ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Educational Background -->
        @if($submission->educationalBackground)
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-graduation-cap text-[#1B365D] mr-3"></i>
                Educational Background
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Highest Level:</span>
                        <span class="text-sm text-gray-900">{{ $submission->educationalBackground->highest_level ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">School Name:</span>
                        <span class="text-sm text-gray-900">{{ $submission->educationalBackground->school_name ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Year Graduated:</span>
                        <span class="text-sm text-gray-900">{{ $submission->educationalBackground->year_graduated ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Course:</span>
                        <span class="text-sm text-gray-900">{{ $submission->educationalBackground->course ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Military History -->
        @if($submission->militaryHistory)
        <div class="bg-white rounded-xl shadow-sm p-6 scale-in">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <i class="fas fa-medal text-[#1B365D] mr-3"></i>
                Military History
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Service Branch:</span>
                        <span class="text-sm text-gray-900">{{ $submission->militaryHistory->service_branch ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Rank:</span>
                        <span class="text-sm text-gray-900">{{ $submission->militaryHistory->rank ?? 'N/A' }}</span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">Years of Service:</span>
                        <span class="text-sm text-gray-900">{{ $submission->militaryHistory->years_of_service ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-600">AFPSN:</span>
                        <span class="text-sm text-gray-900">{{ $submission->militaryHistory->afpsn ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.phs.index') }}" class="btn-secondary inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
        <a href="{{ route('admin.phs.edit', $submission->id) }}" class="btn-primary inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200">
            <i class="fas fa-edit mr-2"></i>
            Edit Submission
        </a>
    </div>
</div>
@endsection 