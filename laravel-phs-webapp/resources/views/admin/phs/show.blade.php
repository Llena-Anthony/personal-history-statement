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
                Personal History Statement
            </h1>
            <p class="text-gray-600 mt-2">Complete submission details for {{ optional(optional($user->userDetail)->nameDetail)->first_name }} {{ optional(optional($user->userDetail)->nameDetail)->last_name }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.phs.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-xl hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 shadow-lg">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to List
            </a>
            <a href="{{ route('admin.phs.print', $user->username) }}" target="_blank"
               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl hover:from-emerald-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 shadow-lg">
                <i class="fas fa-print mr-2"></i>
                Print PHS
            </a>
        </div>
    </div>

    <!-- Applicant Info Card -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-gradient-to-br from-[#1B365D] to-[#2B4B7D] rounded-full flex items-center justify-center text-white text-xl font-bold">
                    {{ strtoupper(substr(optional(optional($user->userDetail)->nameDetail)->first_name ?? $user->username, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ optional(optional($user->userDetail)->nameDetail)->first_name }} {{ optional(optional($user->userDetail)->nameDetail)->last_name }}
                    </h2>
                    <p class="text-gray-600">{{ $user->username }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="text-right">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                    @if($user->phs_status === 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                    @elseif($user->phs_status === 'reviewed') bg-blue-100 text-blue-800 border border-blue-200
                    @elseif($user->phs_status === 'approved') bg-green-100 text-green-800 border border-green-200
                    @else bg-red-100 text-red-800 border border-red-200
                    @endif">
                    <i class="fas 
                        @if($user->phs_status === 'pending') fa-clock
                        @elseif($user->phs_status === 'reviewed') fa-eye
                        @elseif($user->phs_status === 'approved') fa-check-circle
                        @else fa-times-circle
                        @endif mr-1"></i>
                    {{ ucfirst($user->phs_status ?? 'pending') }}
                </span>
            </div>
        </div>
    </div>

    <!-- PHS Form Sections -->
    <div class="space-y-6">
        <!-- Personal Details Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-user-circle mr-3"></i>
                    Personal Details
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">First Name:</span>
                            <span class="text-sm text-gray-900">{{ optional(optional($user->userDetail)->nameDetail)->first_name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Middle Name:</span>
                            <span class="text-sm text-gray-900">{{ optional(optional($user->userDetail)->nameDetail)->middle_name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Last Name:</span>
                            <span class="text-sm text-gray-900">{{ optional(optional($user->userDetail)->nameDetail)->last_name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Suffix:</span>
                            <span class="text-sm text-gray-900">{{ optional(optional($user->userDetail)->nameDetail)->suffix ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Date of Birth:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->date_of_birth ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Place of Birth:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->place_of_birth ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Gender:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->gender ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Civil Status:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->civil_status ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Family Background Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-users mr-3"></i>
                    Family Background
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">Father's Information</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Name:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Date of Birth:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Occupation:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">Mother's Information</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Name:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Date of Birth:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Occupation:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Educational Background Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-graduation-cap mr-3"></i>
                    Educational Background
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">Elementary</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">School:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Year:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">High School</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">School:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Year:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">College</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">School:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Course:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Year:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Military History Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-600 to-yellow-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-medal mr-3"></i>
                    Military History
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Service Branch:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->branch_of_service ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Rank:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->rank ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">AFPSN:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->afpsn ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Years of Service:</span>
                            <span class="text-sm text-gray-900">N/A</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Present Job:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->present_job ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Religion:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->religion ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Employment History Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-briefcase mr-3"></i>
                    Employment History
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 mb-3">Employment Record #1</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Position:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Company:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">From:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">To:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Places of Residence Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-home mr-3"></i>
                    Places of Residence
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 mb-3">Residence #1</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Address:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">City:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">From:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">To:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Character and Reputation Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-star mr-3"></i>
                    Character and Reputation
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">Character References</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Name:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Relationship:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Contact:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">Reputation</h4>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Community Standing:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Professional Reputation:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Credit Reputation Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-orange-600 to-orange-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-credit-card mr-3"></i>
                    Credit Reputation
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Credit Rating:</span>
                            <span class="text-sm text-gray-900">N/A</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Bank Accounts:</span>
                            <span class="text-sm text-gray-900">N/A</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Outstanding Debts:</span>
                            <span class="text-sm text-gray-900">N/A</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">TIN Number:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->tin_no ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Passport Number:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->passport_number ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Passport Expiry:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->passport_expiry ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Arrest Record Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-gavel mr-3"></i>
                    Arrest Record
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 mb-3">Arrest Record #1</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Date:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Charge:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Court:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Disposition:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Miscellaneous Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-pink-600 to-pink-700 px-6 py-4">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    Miscellaneous Information
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Height:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->height ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Weight:</span>
                            <span class="text-sm text-gray-900">{{ optional($user->userDetail)->weight ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Blood Type:</span>
                            <span class="text-sm text-gray-900">N/A</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Emergency Contact:</span>
                            <span class="text-sm text-gray-900">N/A</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Emergency Phone:</span>
                            <span class="text-sm text-gray-900">N/A</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Relationship:</span>
                            <span class="text-sm text-gray-900">N/A</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('admin.phs.index') }}" class="btn-secondary inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
    </div>
</div>
@endsection 