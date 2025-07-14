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
        <div class="bg-white rounded-xl shadow-lg border-2 border-[#1B365D] overflow-hidden">
            <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] px-6 py-4 border-b-2 border-[#D4AF37]">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-user-circle mr-3 text-[#D4AF37]"></i>
                    Personal Details
                </h3>
            </div>
            <div class="p-6">
                <!-- Personal Information -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-id-card mr-2 text-[#D4AF37]"></i>
                        Personal Information
                    </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-[#D4AF37]/30 hover:bg-[#1B365D]/5 transition-colors">
                                <span class="text-sm font-medium text-[#1B365D]">First Name:</span>
                                <span class="text-sm text-gray-900 font-semibold">{{ $personalDetails['first_name'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#D4AF37]/30 hover:bg-[#1B365D]/5 transition-colors">
                                <span class="text-sm font-medium text-[#1B365D]">Middle Name:</span>
                                <span class="text-sm text-gray-900 font-semibold">{{ $personalDetails['middle_name'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#D4AF37]/30 hover:bg-[#1B365D]/5 transition-colors">
                                <span class="text-sm font-medium text-[#1B365D]">Last Name:</span>
                                <span class="text-sm text-gray-900 font-semibold">{{ $personalDetails['last_name'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#D4AF37]/30 hover:bg-[#1B365D]/5 transition-colors">
                                <span class="text-sm font-medium text-[#1B365D]">Suffix:</span>
                                <span class="text-sm text-gray-900 font-semibold">{{ $personalDetails['suffix'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-[#D4AF37]/30 hover:bg-[#1B365D]/5 transition-colors">
                                <span class="text-sm font-medium text-[#1B365D]">Nickname:</span>
                                <span class="text-sm text-gray-900 font-semibold">{{ $personalDetails['nickname'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Date of Birth:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['date_of_birth'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Place of Birth:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['birth_street'] ? $personalDetails['birth_street'] . ', ' . $personalDetails['birth_city'] . ', ' . $personalDetails['birth_province'] : 'N/A' }}</span>
                            </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Nationality:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['nationality'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Military and Contact Information -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-user-shield mr-2 text-[#D4AF37]"></i>
                        Military and Contact Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Rank:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['rank'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">AFPSN:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['afpsn'] ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Branch of Service:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['branch_of_service'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Present Job/Assignment:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['present_job'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Change in Name:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['name_change'] ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">TIN Number:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['tin'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Religion:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['religion'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Mobile Number:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['mobile'] ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Email Address:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['email'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Passport Number:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['passport_number'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Passport Expiry:</span>
                                <span class="text-sm text-gray-900">{{ $personalDetails['passport_expiry'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div>
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>
                        Address Information
                    </h4>
                    
                    <!-- Home Address -->
                    <div class="mb-6">
                        <h5 class="text-md font-semibold text-[#1B365D] mb-3 flex items-center">
                            <i class="fas fa-home mr-2 text-[#D4AF37]"></i>
                            Home Address
                        </h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Region:</span>
                                    <span class="text-sm text-gray-900">{{ $personalDetails['home_region'] ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Province:</span>
                                    <span class="text-sm text-gray-900">{{ $personalDetails['home_province'] ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">City/Municipality:</span>
                                    <span class="text-sm text-gray-900">{{ $personalDetails['home_city'] ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Barangay:</span>
                                    <span class="text-sm text-gray-900">{{ $personalDetails['home_barangay'] ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Street Address:</span>
                                    <span class="text-sm text-gray-900">{{ $personalDetails['home_street'] ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Address -->
                    <div>
                        <h5 class="text-md font-semibold text-[#1B365D] mb-3 flex items-center">
                            <i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>
                            Business or Duty Address
                        </h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Region:</span>
                                    <span class="text-sm text-gray-900">{{ $personalDetails['business_region'] ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Province:</span>
                                    <span class="text-sm text-gray-900">{{ $personalDetails['business_province'] ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">City/Municipality:</span>
                                    <span class="text-sm text-gray-900">{{ $personalDetails['business_city'] ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Barangay:</span>
                                    <span class="text-sm text-gray-900">{{ $personalDetails['business_barangay'] ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Street Address:</span>
                                    <span class="text-sm text-gray-900">{{ $personalDetails['business_street'] ?? 'N/A' }}</span>
                                </div>
                            </div>
                </div>
                </div>
            </div>
        </div>
        </div>
        
        <!-- Personal Characteristics Section -->
        <div class="bg-white rounded-xl shadow-lg border-2 border-[#1B365D] overflow-hidden">
            <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] px-6 py-4 border-b-2 border-[#D4AF37]">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-user-tag mr-3 text-[#D4AF37]"></i>
                    Personal Characteristics
        </h3>
            </div>
            <div class="p-6">
                <!-- Physical Description -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-user mr-2 text-[#D4AF37]"></i>
                        Physical Description
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Sex:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['sex'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Age:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['age'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Height:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['height'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Weight:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['weight'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Body Build:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['body_build'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Complexion:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['complexion'] ?? 'N/A' }}</span>
                            </div>
                        </div>
            <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Eye Color:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['eye_color'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Hair Color:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['hair_color'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Distinguishing Features:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['distinguishing_features'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Physical Condition -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-heartbeat mr-2 text-[#D4AF37]"></i>
                        Physical Condition
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Health Status:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['health_status'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Blood Type:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['blood_type'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Cap Size:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['cap_size'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Shoe Size:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['shoe_size'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Recent Illness:</span>
                                <span class="text-sm text-gray-900">{{ $personalCharacteristics['recent_illness'] ?? 'N/A' }}</span>
                    </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>

        <!-- Marital Status Section -->
        <div class="bg-white rounded-xl shadow-lg border-2 border-[#1B365D] overflow-hidden">
            <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] px-6 py-4 border-b-2 border-[#D4AF37]">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-heart mr-3 text-[#D4AF37]"></i>
                    Marital Status
                </h3>
            </div>
            <div class="p-6">
                <!-- Marital Status Information -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-2 text-[#D4AF37]"></i>
                        Marital Status Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Marital Status:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['marital_status'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spouse Information -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-user-friends mr-2 text-[#D4AF37]"></i>
                        Spouse Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">First Name:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_first_name'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Middle Name:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_middle_name'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Last Name:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_last_name'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Suffix:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_suffix'] ?? 'N/A' }}</span>
                            </div>
                        </div>
            <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Birth Date:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_birth_date'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Birth Place:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_birth_place'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Citizenship:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_citizenship'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Other Citizenship:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_other_citizenship'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Marriage Information -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-ring mr-2 text-[#D4AF37]"></i>
                        Marriage Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Marriage Date:</span>
                                <span class="text-sm text-gray-900">
                                    @if($maritalStatus['marriage_month'] && $maritalStatus['marriage_year'])
                                        {{ $maritalStatus['marriage_month'] }} {{ $maritalStatus['marriage_year'] }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Marriage Place:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['marriage_place'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Occupation:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_occupation'] ?? 'N/A' }}</span>
                    </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Employer:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_employer'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Place of Employment:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_employment_place'] ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Contact Number:</span>
                                <span class="text-sm text-gray-900">{{ $maritalStatus['spouse_contact'] ?? 'N/A' }}</span>
                            </div>
                    </div>
                    </div>
                </div>

                <!-- Children Information -->
                <div>
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-baby mr-2 text-[#D4AF37]"></i>
                        Children Information
                    </h4>
                    <div class="space-y-4">
                        @if(isset($maritalStatus['children']) && count($maritalStatus['children']) > 0)
                            @foreach($maritalStatus['children'] as $index => $child)
                            <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20">
                                <h5 class="font-semibold text-[#1B365D] mb-3 flex items-center">
                                    <i class="fas fa-child mr-2 text-[#D4AF37]"></i>
                                    Child {{ $index + 1 }}
                                </h5>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm font-medium text-gray-600">Name:</span>
                                            <span class="text-sm text-gray-900">{{ $child->name ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm font-medium text-gray-600">Birth Date:</span>
                                            <span class="text-sm text-gray-900">{{ $child->birth_date ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm font-medium text-gray-600">Citizenship:</span>
                                            <span class="text-sm text-gray-900">{{ $child->citizenship ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm font-medium text-gray-600">Address:</span>
                                            <span class="text-sm text-gray-900">{{ $child->address ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm font-medium text-gray-600">Father's Name:</span>
                                            <span class="text-sm text-gray-900">{{ $child->father_name ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm font-medium text-gray-600">Mother's Name:</span>
                                            <span class="text-sm text-gray-900">{{ $child->mother_name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20">
                                <div class="text-center text-gray-500 py-4">
                                    <i class="fas fa-info-circle text-[#D4AF37] mb-2"></i>
                                    <p>No children information available</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Family Background Section -->
        <div class="bg-white rounded-xl shadow-lg border-2 border-[#1B365D] overflow-hidden">
            <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] px-6 py-4 border-b-2 border-[#D4AF37]">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-users mr-3 text-[#D4AF37]"></i>
                    Family Background
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach([
                        'father' => "Father's Information",
                        'mother' => "Mother's Information",
                        'guardian' => "Guardian's Information",
                        'father_in_law' => "Father-in-law's Information",
                        'mother_in_law' => "Mother-in-law's Information"
                    ] as $role => $label)
                        <div class="space-y-4">
                            <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">{{ $label }}</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Name:</span>
                                    <span class="text-sm text-gray-900">
                                        {{
                                            trim(
                                                ($familyBackground['family_members'][$role]->first_name ?? '') . ' ' .
                                                ($familyBackground['family_members'][$role]->middle_name ?? '') . ' ' .
                                                ($familyBackground['family_members'][$role]->last_name ?? '') . ' ' .
                                                ($familyBackground['family_members'][$role]->suffix ?? '')
                                            ) ?: 'N/A'
                                        }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Birth Date:</span>
                                    <span class="text-sm text-gray-900">{{ $familyBackground['family_members'][$role]->birth_date ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Birth Place:</span>
                                    <span class="text-sm text-gray-900">{{ $familyBackground['family_members'][$role]->birth_place ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Complete Address:</span>
                                    <span class="text-sm text-gray-900">{{ $familyBackground['family_members'][$role]->complete_address ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Occupation:</span>
                                    <span class="text-sm text-gray-900">{{ $familyBackground['family_members'][$role]->occupation ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Employer:</span>
                                    <span class="text-sm text-gray-900">{{ $familyBackground['family_members'][$role]->employer ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Place of Employment:</span>
                                    <span class="text-sm text-gray-900">{{ $familyBackground['family_members'][$role]->place_of_employment ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Citizenship:</span>
                                    <span class="text-sm text-gray-900">{{ $familyBackground['family_members'][$role]->citizenship ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Dual Citizenship:</span>
                                    <span class="text-sm text-gray-900">{{ $familyBackground['family_members'][$role]->dual_citizenship ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Citizenship Type:</span>
                                    <span class="text-sm text-gray-900">{{ $familyBackground['family_members'][$role]->citizenship_type ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Date Naturalized:</span>
                                    <span class="text-sm text-gray-900">{{ $familyBackground['family_members'][$role]->date_naturalized ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                    <span class="text-sm font-medium text-gray-600">Place Naturalized:</span>
                                    <span class="text-sm text-gray-900">{{ $familyBackground['family_members'][$role]->place_naturalized ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Siblings Section -->
                <div class="mt-8">
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-user-friends mr-2 text-[#D4AF37]"></i>
                        Siblings
                    </h4>
                    <div class="space-y-4">
                        @if(isset($siblings) && count($siblings) > 0)
                            @foreach($siblings as $index => $sibling)
                                <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20">
                                    <h5 class="font-semibold text-[#1B365D] mb-3 flex items-center">
                                        <i class="fas fa-user mr-2 text-[#D4AF37]"></i>
                                        Sibling {{ $index + 1 }}
                                    </h5>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Name:</span>
                                                <span class="text-sm text-gray-900">
                                                    {{ trim(($sibling->first_name ?? '') . ' ' . ($sibling->middle_name ?? '') . ' ' . ($sibling->last_name ?? '') . ' ' . ($sibling->suffix ?? '')) ?: 'N/A' }}
                                                </span>
                                            </div>
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Birth Date:</span>
                                                <span class="text-sm text-gray-900">{{ $sibling->date_of_birth ?? 'N/A' }}</span>
                                            </div>
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Citizenship:</span>
                                                <span class="text-sm text-gray-900">{{ $sibling->citizenship ?? 'N/A' }}</span>
                                            </div>
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Dual Citizenship:</span>
                                                <span class="text-sm text-gray-900">{{ $sibling->dual_citizenship ?? 'N/A' }}</span>
                                            </div>
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Complete Address:</span>
                                                <span class="text-sm text-gray-900">{{ $sibling->complete_address ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Occupation:</span>
                                                <span class="text-sm text-gray-900">{{ $sibling->occupation ?? 'N/A' }}</span>
                                            </div>
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Employer:</span>
                                                <span class="text-sm text-gray-900">{{ $sibling->employer ?? 'N/A' }}</span>
                                            </div>
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Employer Address:</span>
                                                <span class="text-sm text-gray-900">{{ $sibling->employer_address ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20">
                                <div class="text-center text-gray-500 py-4">
                                    <i class="fas fa-info-circle text-[#D4AF37] mb-2"></i>
                                    <p>No siblings information available</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Educational Background Section -->
        <div class="bg-white rounded-xl shadow-lg border-2 border-[#1B365D] overflow-hidden">
            <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] px-6 py-4 border-b-2 border-[#D4AF37]">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-graduation-cap mr-3 text-[#D4AF37]"></i>
                    Educational Background
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach([
                        'elementary' => 'Elementary',
                        'highschool' => 'High School',
                        'college' => 'College',
                        'postgrad' => 'Postgraduate'
                    ] as $level => $label)
                        <div class="space-y-4">
                            <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">{{ $label }}</h4>
                            @php $entries = $educationalBackground[$level] ?? []; @endphp
                            @if(count($entries) > 0)
                                @foreach($entries as $entry)
                                    <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Name of School:</span>
                                                <span class="text-sm text-gray-900">{{ $entry->school_name ?? 'N/A' }}</span>
                                            </div>
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Location:</span>
                                                <span class="text-sm text-gray-900">{{ $entry->school_addr ?? 'N/A' }}</span>
                                            </div>
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Date of Attendance:</span>
                                                <span class="text-sm text-gray-900">
                                                    @if(isset($entry->period_from) || isset($entry->period_to))
                                                        {{ $entry->period_from ?? 'N/A' }} - {{ $entry->period_to ?? 'N/A' }}
                                                    @elseif(isset($entry->attend_date))
                                                        {{ $entry->attend_date ?? 'N/A' }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="flex justify-between items-center py-1">
                                                <span class="text-sm font-medium text-gray-600">Year Graduated:</span>
                                                <span class="text-sm text-gray-900">{{ $entry->year_graduated ?? ($entry->year_grad ?? 'N/A') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm font-medium text-gray-600">Name of School:</span>
                                            <span class="text-sm text-gray-900">N/A</span>
                                        </div>
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm font-medium text-gray-600">Location:</span>
                                            <span class="text-sm text-gray-900">N/A</span>
                                        </div>
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm font-medium text-gray-600">Date of Attendance:</span>
                                            <span class="text-sm text-gray-900">N/A</span>
                                        </div>
                                        <div class="flex justify-between items-center py-1">
                                            <span class="text-sm font-medium text-gray-600">Year Graduated:</span>
                                            <span class="text-sm text-gray-900">N/A</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <!-- Other Schools/Training and Civil Service Eligibility -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">Other Schools/Training</h4>
                        @php
                            $otherTraining = collect($educationalBackground['elementary'] ?? [])
                                ->merge($educationalBackground['highschool'] ?? [])
                                ->merge($educationalBackground['college'] ?? [])
                                ->merge($educationalBackground['postgrad'] ?? [])
                                ->pluck('other_training')->filter()->unique();
                        @endphp
                        @if($otherTraining->count() > 0)
                            @foreach($otherTraining as $training)
                                <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                                    <span class="text-sm text-gray-900">{{ $training }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        @endif
                    </div>
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 border-b border-gray-200 pb-2">Civil Service Eligibility</h4>
                        @php
                            $civilService = collect($educationalBackground['elementary'] ?? [])
                                ->merge($educationalBackground['highschool'] ?? [])
                                ->merge($educationalBackground['college'] ?? [])
                                ->merge($educationalBackground['postgrad'] ?? [])
                                ->pluck('civil_service')->filter()->unique();
                        @endphp
                        @if($civilService->count() > 0)
                            @foreach($civilService as $cs)
                                <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                                    <span class="text-sm text-gray-900">{{ $cs }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Military History Section -->
        <div class="bg-white rounded-xl shadow-lg border-2 border-[#1B365D] overflow-hidden">
            <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] px-6 py-4 border-b-2 border-[#D4AF37]">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-medal mr-3 text-[#D4AF37]"></i>
                    Military History
                </h3>
        </div>
            <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Date Enlisted in the AFP:</span>
                            <span class="text-sm text-gray-900">{{ $militaryHistory->service_branch ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Date of Commission:</span>
                            <span class="text-sm text-gray-900">{{ $militaryHistory->rank ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Source of Commission:</span>
                            <span class="text-sm text-gray-900">{{ $militaryHistory->afpsn ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                <!-- Assignments -->
                <div class="mt-8">
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-list mr-2 text-[#D4AF37]"></i>
                        Assignments
                    </h4>
                    @if($militaryAssignments && count($militaryAssignments))
                        @foreach($militaryAssignments as $assignment)
                            <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                                <div class="flex flex-wrap gap-4">
                                    <div><span class="font-medium text-gray-600">Unit/Office:</span> <span class="text-gray-900">{{ $assignment->assign_unit ?? 'N/A' }}</span></div>
                                    <div><span class="font-medium text-gray-600">Chief:</span> <span class="text-gray-900">{{ $assignment->assign_chief ?? 'N/A' }}</span></div>
                                    <div><span class="font-medium text-gray-600">Start Date:</span> <span class="text-gray-900">{{ $assignment->start_date ?? 'N/A' }}</span></div>
                                    <div><span class="font-medium text-gray-600">End Date:</span> <span class="text-gray-900">{{ $assignment->end_date ?? 'N/A' }}</span></div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                            <span class="text-sm text-gray-900">N/A</span>
                        </div>
                    @endif
                </div>
                <!-- Military Schools -->
                <div class="mt-8">
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-university mr-2 text-[#D4AF37]"></i>
                        Military Schools
                    </h4>
                    @if($militarySchools && count($militarySchools))
                        @foreach($militarySchools as $school)
                            <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                                <div class="flex flex-wrap gap-4">
                                    <div><span class="font-medium text-gray-600">School:</span> <span class="text-gray-900">{{ $school->school ?? 'N/A' }}</span></div>
                                    <div><span class="font-medium text-gray-600">Date Attended:</span> <span class="text-gray-900">{{ $school->attend_date ?? 'N/A' }}</span></div>
                                    <div><span class="font-medium text-gray-600">Nature of Training:</span> <span class="text-gray-900">{{ $school->train_nature ?? 'N/A' }}</span></div>
                                    <div><span class="font-medium text-gray-600">Rating:</span> <span class="text-gray-900">{{ $school->rating ?? 'N/A' }}</span></div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                            <span class="text-sm text-gray-900">N/A</span>
                        </div>
                    @endif
                </div>
                <!-- Awards -->
                <div class="mt-8">
                    <h4 class="text-lg font-semibold text-[#1B365D] border-b-2 border-[#D4AF37] pb-2 mb-4 flex items-center">
                        <i class="fas fa-trophy mr-2 text-[#D4AF37]"></i>
                        Awards
                    </h4>
                    @if($militaryAwards && count($militaryAwards))
                        @foreach($militaryAwards as $award)
                            <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                                <span class="font-medium text-gray-600">Award:</span> <span class="text-gray-900">{{ $award->award_desc ?? 'N/A' }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                            <span class="text-sm text-gray-900">N/A</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Employment History Section -->
        <div class="bg-white rounded-xl shadow-lg border-2 border-[#1B365D] overflow-hidden">
            <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] px-6 py-4 border-b-2 border-[#D4AF37]">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-briefcase mr-3 text-[#D4AF37]"></i>
                    Employment History
                </h3>
            </div>
            <div class="p-6">
                @if($employmentHistory && count($employmentHistory))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($employmentHistory as $i => $employment)
                            @php $addr = $employment->addressDetail; @endphp
                            <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                                <h4 class="font-semibold text-gray-900 mb-3">Employment Record #{{ $i+1 }}</h4>
                                <div class="grid grid-cols-1 gap-2">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Inclusive Dates:</span>
                                        <span class="text-sm text-gray-900">
                                            {{ ($employment->start_date ?? 'N/A') }} - {{ ($employment->end_date ?? 'N/A') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Type of Employment:</span>
                                        <span class="text-sm text-gray-900">{{ $employment->employ_type ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Name:</span>
                                        <span class="text-sm text-gray-900">{{ $employment->employer ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Address:</span>
                                        <span class="text-sm text-gray-900">{{ $addr ? ($addr->street ?? 'N/A') : 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Reason for Leaving:</span>
                                        <span class="text-sm text-gray-900">{{ $employment->reason_for_leaving ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Dismissal Description:</span>
                                        <span class="text-sm text-gray-900">{{ $employment['dismissal_description'] ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                        <h4 class="font-semibold text-gray-900 mb-3">Employment Record #1</h4>
                        <div class="grid grid-cols-1 gap-2">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Inclusive Dates:</span>
                                <span class="text-sm text-gray-900">N/A - N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Type of Employment:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Name:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Address:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Reason for Leaving:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Dismissal Description:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Places of Residence Section -->
        <div class="bg-white rounded-xl shadow-lg border-2 border-[#1B365D] overflow-hidden">
            <div class="bg-gradient-to-r from-[#1B365D] to-[#2B4B7D] px-6 py-4 border-b-2 border-[#D4AF37]">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-home mr-3 text-[#D4AF37]"></i>
                    Places of Residence
                </h3>
            </div>
            <div class="p-6">
                @if($placesOfResidence && count($placesOfResidence))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($placesOfResidence as $i => $residence)
                            @php $addr = $residence->addressDetail; @endphp
                            <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                                <h4 class="font-semibold text-gray-900 mb-3">Residence #{{ $i+1 }}</h4>
                                <div class="grid grid-cols-1 gap-2">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Address:</span>
                                        <span class="text-sm text-gray-900">{{ $addr ? ($addr->street ?? 'N/A') : 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-sm font-medium text-gray-600">Date:</span>
                                        <span class="text-sm text-gray-900">{{ $addr ? ($addr->city ?? 'N/A') : 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gradient-to-r from-[#1B365D]/5 to-[#2B4B7D]/5 p-4 rounded-lg border border-[#D4AF37]/20 mb-2">
                        <h4 class="font-semibold text-gray-900 mb-3">Residence #1</h4>
                        <div class="grid grid-cols-1 gap-2">
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Address:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                <span class="text-sm font-medium text-gray-600">Date:</span>
                                <span class="text-sm text-gray-900">N/A</span>
                            </div>
                    </div>
                    </div>
                @endif
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

</div>
@endsection 