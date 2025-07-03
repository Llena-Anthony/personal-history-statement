@php
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
    $dashboardRoute = route('personnel.dashboard');
    $nextSectionRoute = Auth::user() && Auth::user()->role === 'personnel' ? route('personnel.phs.personal-characteristics') : route('phs.personal-characteristics.create');
@endphp

@extends($layout)

@section('title', 'I: Personal Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-user text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Personal Details</h1>
                <p class="text-gray-600">Please provide your basic personal information</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('personnel.phs.personal-details.store') }}" class="space-y-8">
        @csrf
        
        <!-- Personal Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-id-card mr-3 text-[#D4AF37]"></i>
                Personal Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                        First Name
                    </label>
                    <input type="text" name="first_name" id="first_name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your first name"
                           value="{{ $phs ? $phs->first_name : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->first_name : '') }}">
                    @error('first_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                <!-- Middle Name -->
                <div>
                    <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Middle Name
                    </label>
                    <input type="text" name="middle_name" id="middle_name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your middle name"
                           value="{{ $phs ? $phs->middle_name : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->middle_name : '') }}">
                    @error('middle_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Last Name
                    </label>
                    <input type="text" name="last_name" id="last_name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your last name"
                           value="{{ $phs ? $phs->last_name : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->last_name : '') }}">
                    @error('last_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Suffix -->
                <div>
                    <label for="suffix" class="block text-sm font-medium text-gray-700 mb-2">
                        Name Extension (Jr., Sr., III, etc.)
                    </label>
                    <input type="text" name="suffix" id="suffix"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Jr., Sr., III"
                           value="{{ $phs ? $phs->suffix : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->name_extension : '') }}">
                </div>
    
                <!-- Nickname -->
                <div>
                    <label for="nickname" class="block text-sm font-medium text-gray-700 mb-2">
                        Nickname
                    </label>
                    <input type="text" name="nickname" id="nickname"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your nickname"
                           value="{{ $phs ? $phs->nickname : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->nickname : '') }}">
                </div>
            </div>
        </div>
    
        <!-- Birth Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-birthday-cake mr-3 text-[#D4AF37]"></i>
                Birth Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">
                        Date of Birth
                    </label>
                    <input type="date" name="date_of_birth" id="date_of_birth"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           value="{{ isset($phs->date_of_birth) ? (\Illuminate\Support\Str::length($phs->date_of_birth) === 10 ? $phs->date_of_birth : (new \Carbon\Carbon($phs->date_of_birth))->format('Y-m-d')) : '' }}">
                    @error('date_of_birth')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
    
                <!-- Place of Birth -->
                <div>
                    <label for="place_of_birth" class="block text-sm font-medium text-gray-700 mb-2">
                        Place of Birth
                    </label>
                    <input type="text" name="place_of_birth" id="place_of_birth"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="City, Province"
                           value="{{ $phs->place_of_birth ?? '' }}">
                    @error('place_of_birth')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Gender -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">
                        Gender
                    </label>
                    <select name="gender" id="gender"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ ($phs->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ ($phs->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Civil Status -->
                <div>
                    <label for="civil_status" class="block text-sm font-medium text-gray-700 mb-2">
                        Civil Status
                    </label>
                    <select name="civil_status" id="civil_status"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Civil Status</option>
                        <option value="Single" {{ ($phs->civil_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ ($phs->civil_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Widowed" {{ ($phs->civil_status ?? '') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        <option value="Separated" {{ ($phs->civil_status ?? '') == 'Separated' ? 'selected' : '' }}>Separated</option>
                    </select>
                    @error('civil_status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Citizenship -->
                <div>
                    <label for="citizenship" class="block text-sm font-medium text-gray-700 mb-2">
                        Citizenship
                    </label>
                    <select name="citizenship" id="citizenship"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Citizenship</option>
                        <option value="Filipino" {{ ($phs->citizenship ?? '') == 'Filipino' ? 'selected' : '' }}>Filipino</option>
                        <option value="Dual Citizenship" {{ ($phs->citizenship ?? '') == 'Dual Citizenship' ? 'selected' : '' }}>Dual Citizenship</option>
                    </select>
                    @error('citizenship')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nationality -->
                <div>
                    <label for="nationality" class="block text-sm font-medium text-gray-700 mb-2">
                        Nationality
                    </label>
                    <input type="text" name="nationality" id="nationality"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your nationality"
                           value="{{ $phs->nationality ?? '' }}">
                </div>
            </div>
        </div>
    
        <!-- Military Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-medal mr-3 text-[#D4AF37]"></i>
                Military Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Rank -->
                <div>
                    <label for="rank" class="block text-sm font-medium text-gray-700 mb-2">
                        Rank
                    </label>
                    <input type="text" name="rank" id="rank"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your military rank"
                           value="{{ $phs->rank ?? '' }}">
                </div>

                <!-- AFPSN -->
                <div>
                    <label for="afpsn" class="block text-sm font-medium text-gray-700 mb-2">
                        AFPSN
                    </label>
                    <input type="text" name="afpsn" id="afpsn"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your AFPSN"
                           value="{{ $phs->afpsn ?? '' }}">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Branch of Service -->
                <div>
                    <label for="branch_of_service" class="block text-sm font-medium text-gray-700 mb-2">
                        Branch of Service
                    </label>
                    <input type="text" name="branch_of_service" id="branch_of_service"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Army, Navy, Air Force"
                           value="{{ $phs->branch_of_service ?? '' }}">
                </div>

                <!-- Present Job/Assignment -->
                <div>
                    <label for="present_job" class="block text-sm font-medium text-gray-700 mb-2">
                        Present Job/Assignment
                    </label>
                    <input type="text" name="present_job" id="present_job"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your current job or assignment"
                           value="{{ $phs->present_job ?? '' }}">
                </div>
            </div>
        </div>

        <!-- Enhanced Home Address -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-home mr-3 text-[#D4AF37]"></i>
                Home Address
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Region -->
                <div>
                    <label for="home_region" class="block text-sm font-medium text-gray-700 mb-2">
                        Region
                    </label>
                    <select name="home_region" id="home_region"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                            onchange="loadProvinces('home')">
                        <option value="">Select Region</option>
                        @if(isset($phs->home_region) && $phs->home_region)
                            <option value="{{ $phs->home_region }}" selected>
                                {{ $phs->home_region_name ?? $phs->home_region }}
                            </option>
                        @endif
                    </select>
                </div>

                <!-- Province -->
                <div>
                    <label for="home_province" class="block text-sm font-medium text-gray-700 mb-2">
                        Province
                    </label>
                    <select name="home_province" id="home_province"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                            onchange="loadCities('home')">
                        <option value="">Select Province</option>
                        @if(isset($phs->home_province) && $phs->home_province)
                            <option value="{{ $phs->home_province }}" selected>
                                {{ $phs->home_province_name ?? $phs->home_province }}
                            </option>
                        @endif
                    </select>
                </div>

                <!-- City/Municipality -->
                <div>
                    <label for="home_city" class="block text-sm font-medium text-gray-700 mb-2">
                        City/Municipality
                    </label>
                    <select name="home_city" id="home_city"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                            onchange="loadBarangays('home')">
                        <option value="">Select City/Municipality</option>
                        @if(isset($phs->home_city) && $phs->home_city)
                            <option value="{{ $phs->home_city }}" selected>
                                {{ $phs->home_city_name ?? $phs->home_city }}
                            </option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Barangay -->
                <div>
                    <label for="home_barangay" class="block text-sm font-medium text-gray-700 mb-2">
                        Barangay
                    </label>
                    <select name="home_barangay" id="home_barangay"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Barangay</option>
                        @if(isset($phs->home_barangay) && $phs->home_barangay)
                            <option value="{{ $phs->home_barangay }}" selected>
                                {{ $phs->home_barangay_name ?? $phs->home_barangay }}
                            </option>
                        @endif
                    </select>
                </div>

                <!-- Street Address -->
                <div>
                    <label for="home_street" class="block text-sm font-medium text-gray-700 mb-2">
                        Street Address
                    </label>
                    <input type="text" name="home_street" id="home_street"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="House/Unit No., Street Name"
                           value="{{ $phs->home_street ?? '' }}">
                </div>
            </div>

            <!-- Complete Address Display -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Home Address</label>
                <div id="home_complete_address" class="text-gray-600 text-sm">
                    {{ $phs->home_street ?? '' }}{{ ($phs && $phs->home_street) ? ', ' : '' }}{{ $phs->home_barangay_name ?? '' }}{{ ($phs && $phs->home_barangay_name) ? ', ' : '' }}{{ $phs->home_city_name ?? '' }}{{ ($phs && $phs->home_city_name) ? ', ' : '' }}{{ $phs->home_province_name ?? '' }}{{ ($phs && $phs->home_province_name) ? ', ' : '' }}{{ $phs->home_region_name ?? '' }}
                </div>
                <input type="hidden" name="home_complete_address" id="home_complete_address_input" 
                       value="{{ $phs->home_complete_address ?? '' }}">
            </div>
        </div>

        <!-- Business Address -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-briefcase mr-3 text-[#D4AF37]"></i>
                Business Address
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Region -->
                <div>
                    <label for="business_region" class="block text-sm font-medium text-gray-700 mb-2">
                        Region
                    </label>
                    <select name="business_region" id="business_region"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                            onchange="loadProvinces('business')">
                        <option value="">Select Region</option>
                        @if(isset($phs->business_region) && $phs->business_region)
                            <option value="{{ $phs->business_region }}" selected>
                                {{ $phs->business_region_name ?? $phs->business_region }}
                            </option>
                        @endif
                    </select>
                </div>

                <!-- Province -->
                <div>
                    <label for="business_province" class="block text-sm font-medium text-gray-700 mb-2">
                        Province
                    </label>
                    <select name="business_province" id="business_province"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                            onchange="loadCities('business')">
                        <option value="">Select Province</option>
                        @if(isset($phs->business_province) && $phs->business_province)
                            <option value="{{ $phs->business_province }}" selected>
                                {{ $phs->business_province_name ?? $phs->business_province }}
                            </option>
                        @endif
                    </select>
                </div>

                <!-- City/Municipality -->
                <div>
                    <label for="business_city" class="block text-sm font-medium text-gray-700 mb-2">
                        City/Municipality
                    </label>
                    <select name="business_city" id="business_city"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                            onchange="loadBarangays('business')">
                        <option value="">Select City/Municipality</option>
                        @if(isset($phs->business_city) && $phs->business_city)
                            <option value="{{ $phs->business_city }}" selected>
                                {{ $phs->business_city_name ?? $phs->business_city }}
                            </option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Barangay -->
                <div>
                    <label for="business_barangay" class="block text-sm font-medium text-gray-700 mb-2">
                        Barangay
                    </label>
                    <select name="business_barangay" id="business_barangay"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Barangay</option>
                        @if(isset($phs->business_barangay) && $phs->business_barangay)
                            <option value="{{ $phs->business_barangay }}" selected>
                                {{ $phs->business_barangay_name ?? $phs->business_barangay }}
                            </option>
                        @endif
                    </select>
                </div>

                <!-- Street Address -->
                <div>
                    <label for="business_street" class="block text-sm font-medium text-gray-700 mb-2">
                        Street Address
                    </label>
                    <input type="text" name="business_street" id="business_street"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Building/Office No., Street Name"
                           value="{{ $phs->business_street ?? '' }}">
                </div>
            </div>

            <!-- Complete Address Display -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Business Address</label>
                <div id="business_complete_address" class="text-gray-600 text-sm">
                    {{ $phs->business_street ?? '' }}{{ ($phs && $phs->business_street) ? ', ' : '' }}{{ $phs->business_barangay_name ?? '' }}{{ ($phs && $phs->business_barangay_name) ? ', ' : '' }}{{ $phs->business_city_name ?? '' }}{{ ($phs && $phs->business_city_name) ? ', ' : '' }}{{ $phs->business_province_name ?? '' }}{{ ($phs && $phs->business_province_name) ? ', ' : '' }}{{ $phs->business_region_name ?? '' }}
                </div>
                <input type="hidden" name="business_complete_address" id="business_complete_address_input"
                       value="{{ $phs->business_complete_address ?? '' }}">
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-phone mr-3 text-[#D4AF37]"></i>
                Contact Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>
                    <input type="email" name="email" id="email"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your email address"
                           value="{{ $phs ? $phs->email : ($userDetails && $userDetails->email_addr ? $userDetails->email_addr : '') }}">
                </div>
    
                <!-- Mobile -->
                <div>
                    <label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">
                        Mobile Number
                    </label>
                    <input type="tel" name="mobile" id="mobile"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="+63 9XX XXX XXXX"
                           value="{{ $phs->mobile ?? '' }}">
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-info-circle mr-3 text-[#D4AF37]"></i>
                Additional Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Religion -->
                <div>
                    <label for="religion" class="block text-sm font-medium text-gray-700 mb-2">
                        Religion
                    </label>
                    <input type="text" name="religion" id="religion"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your religion"
                           value="{{ $phs->religion ?? '' }}">
                </div>
    
                <!-- TIN -->
                <div>
                    <label for="tin" class="block text-sm font-medium text-gray-700 mb-2">
                        Tax Identification Number (TIN)
                    </label>
                    <input type="text" name="tin" id="tin"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="XXX-XXX-XXX-XXX"
                           value="{{ $phs->tin_no ?? '' }}">
                </div>
            </div>
    
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Passport Number with Expiration -->
                <div>
                    <label for="passport_number" class="block text-sm font-medium text-gray-700 mb-2">
                        Passport Number
                    </label>
                    <input type="text" name="passport_number" id="passport_number"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter passport number"
                           value="{{ $phs->passport_number ?? '' }}">
                </div>
            </div>

            <div class="mt-6">
                <!-- Passport Expiration Date -->
                <div>
                    <label for="passport_expiry" class="block text-sm font-medium text-gray-700 mb-2">
                        Passport Expiration Date
                    </label>
                    <input type="date" name="passport_expiry" id="passport_expiry"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           value="{{ isset($phs->passport_expiry) ? (\Illuminate\Support\Str::length($phs->passport_expiry) === 10 ? $phs->passport_expiry : (new \Carbon\Carbon($phs->passport_expiry))->format('Y-m-d')) : '' }}">
                </div>
            </div>

            <div class="mt-6">
                <!-- Change in Name -->
                <div>
                    <label for="name_change" class="block text-sm font-medium text-gray-700 mb-2">
                        Change in Name (If by court action, give details)
                    </label>
                    <textarea name="name_change" id="name_change" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                              placeholder="If you have legally changed your name, please provide details including court case number, date, and reason">{{ ($phs && $phs->change_in_name) ? $phs->change_in_name : (($phs && $phs->name_change) ? $phs->name_change : '') }}</textarea>
                </div>
            </div>
        </div>
    
        <!-- Home Address Section -->
        <input type="hidden" name="home_region_name" id="home_region_name">
        <input type="hidden" name="home_province_name" id="home_province_name">
        <input type="hidden" name="home_city_name" id="home_city_name">
        <input type="hidden" name="home_barangay_name" id="home_barangay_name">
        <!-- Business Address Section -->
        <input type="hidden" name="business_region_name" id="business_region_name">
        <input type="hidden" name="business_province_name" id="business_province_name">
        <input type="hidden" name="business_city_name" id="business_city_name">
        <input type="hidden" name="business_barangay_name" id="business_barangay_name">
        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <a href="{{ $dashboardRoute }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Dashboard
            </a>
            
            <button type="submit" class="btn-primary">Save & Continue</button>
        </div>
    </form>
</div>

<script>
    // Global function that can be called from AJAX navigation
    window.initializePersonalDetails = function() {
        loadRegions();
        setupAddressEventListeners();
        window.phsHomeRegionName = document.getElementById('home_region_name')?.value || '';
        window.phsBusinessRegionName = document.getElementById('business_region_name')?.value || '';
        // Always set hidden region name fields to the selected option's text
        const homeRegionSelect = document.getElementById('home_region');
        const businessRegionSelect = document.getElementById('business_region');
        const homeRegionNameInput = document.getElementById('home_region_name');
        const businessRegionNameInput = document.getElementById('business_region_name');
        if (homeRegionSelect && homeRegionNameInput) {
            homeRegionNameInput.value = homeRegionSelect.options[homeRegionSelect.selectedIndex]?.text || '';
        }
        if (businessRegionSelect && businessRegionNameInput) {
            businessRegionNameInput.value = businessRegionSelect.options[businessRegionSelect.selectedIndex]?.text || '';
        }
    };

    document.addEventListener('alpine:init', () => {
        Alpine.data('phsForm', () => ({
            currentSection: 'personal-details',
            init() {
                this.markSectionAsVisited('personal-details');
                // Initialize address functionality
                window.initializePersonalDetails();
            }
        }));
    });

    // Philippines Address API Integration
    async function loadRegions() {
        try {
            const response = await fetch('https://psgc.gitlab.io/api/regions/');
            const regions = await response.json();
            
            const homeRegionSelect = document.getElementById('home_region');
            const businessRegionSelect = document.getElementById('business_region');
            
            if (homeRegionSelect && businessRegionSelect) {
                // Store current values
                const homeSelected = homeRegionSelect.value;
                const businessSelected = businessRegionSelect.value;
                // Clear existing options except the first one
                homeRegionSelect.innerHTML = '<option value="">Select Region</option>';
                businessRegionSelect.innerHTML = '<option value="">Select Region</option>';
                
                regions.forEach(region => {
                    const homeOption = new Option(region.name, region.code);
                    const businessOption = new Option(region.name, region.code);
                    homeRegionSelect.add(homeOption);
                    businessRegionSelect.add(businessOption);
                });
                // Restore selected value
                if (homeSelected) {
                    let found = false;
                    for (let i = 0; i < homeRegionSelect.options.length; i++) {
                        if (homeRegionSelect.options[i].value === homeSelected) {
                            found = true;
                            break;
                        }
                    }
                    if (!found && window.phsHomeRegionName) {
                        const opt = new Option(window.phsHomeRegionName, homeSelected, true, true);
                        homeRegionSelect.add(opt);
                    }
                    homeRegionSelect.value = homeSelected;
                }
                if (businessSelected) {
                    let found = false;
                    for (let i = 0; i < businessRegionSelect.options.length; i++) {
                        if (businessRegionSelect.options[i].value === businessSelected) {
                            found = true;
                            break;
                        }
                    }
                    if (!found && window.phsBusinessRegionName) {
                        const opt = new Option(window.phsBusinessRegionName, businessSelected, true, true);
                        businessRegionSelect.add(opt);
                    }
                    businessRegionSelect.value = businessSelected;
                }
            }
        } catch (error) {
            console.error('Error loading regions:', error);
            // Fallback: Add common regions manually
            const commonRegions = [
                'National Capital Region (NCR)',
                'Cordillera Administrative Region (CAR)',
                'Ilocos Region (Region I)',
                'Cagayan Valley (Region II)',
                'Central Luzon (Region III)',
                'CALABARZON (Region IV-A)',
                'MIMAROPA (Region IV-B)',
                'Bicol Region (Region V)',
                'Western Visayas (Region VI)',
                'Central Visayas (Region VII)',
                'Eastern Visayas (Region VIII)',
                'Zamboanga Peninsula (Region IX)',
                'Northern Mindanao (Region X)',
                'Davao Region (Region XI)',
                'SOCCSKSARGEN (Region XII)',
                'Caraga (Region XIII)',
                'Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)'
            ];
            
            const homeRegionSelect = document.getElementById('home_region');
            const businessRegionSelect = document.getElementById('business_region');
            
            if (homeRegionSelect && businessRegionSelect) {
                // Clear existing options except the first one
                homeRegionSelect.innerHTML = '<option value="">Select Region</option>';
                businessRegionSelect.innerHTML = '<option value="">Select Region</option>';
                
                commonRegions.forEach(region => {
                    const homeOption = new Option(region, region);
                    const businessOption = new Option(region, region);
                    homeRegionSelect.add(homeOption);
                    businessRegionSelect.add(businessOption);
                });
            }
        }
    }

    async function loadProvinces(type) {
        const regionSelect = document.getElementById(`${type}_region`);
        const provinceSelect = document.getElementById(`${type}_province`);
        const citySelect = document.getElementById(`${type}_city`);
        const barangaySelect = document.getElementById(`${type}_barangay`);
        
        if (!regionSelect || !provinceSelect || !citySelect || !barangaySelect) return;
        
        // Reset dependent dropdowns
        provinceSelect.innerHTML = '<option value="">Select Province</option>';
        citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        
        if (!regionSelect.value) return;
        
        try {
            const response = await fetch(`https://psgc.gitlab.io/api/regions/${regionSelect.value}/provinces/`);
            const provinces = await response.json();
            
            provinces.forEach(province => {
                const option = new Option(province.name, province.code);
                provinceSelect.add(option);
            });
        } catch (error) {
            console.error('Error loading provinces:', error);
            // Fallback: Add common provinces for selected region
            const commonProvinces = getCommonProvinces(regionSelect.value);
            commonProvinces.forEach(province => {
                const option = new Option(province, province);
                provinceSelect.add(option);
            });
        }
        
        updateCompleteAddress(type);
    }

    async function loadCities(type) {
        const provinceSelect = document.getElementById(`${type}_province`);
        const citySelect = document.getElementById(`${type}_city`);
        const barangaySelect = document.getElementById(`${type}_barangay`);
        
        if (!provinceSelect || !citySelect || !barangaySelect) return;
        
        // Reset dependent dropdowns
        citySelect.innerHTML = '<option value="">Select City/Municipality</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        
        if (!provinceSelect.value) return;
        
        try {
            const response = await fetch(`https://psgc.gitlab.io/api/provinces/${provinceSelect.value}/cities-municipalities/`);
            const cities = await response.json();
            
            cities.forEach(city => {
                const option = new Option(city.name, city.code);
                citySelect.add(option);
            });
        } catch (error) {
            console.error('Error loading cities:', error);
            // Fallback: Add common cities
            const commonCities = ['City/Municipality 1', 'City/Municipality 2', 'City/Municipality 3'];
            commonCities.forEach(city => {
                const option = new Option(city, city);
                citySelect.add(option);
            });
        }
        
        updateCompleteAddress(type);
    }

    async function loadBarangays(type) {
        const citySelect = document.getElementById(`${type}_city`);
        const barangaySelect = document.getElementById(`${type}_barangay`);
        
        if (!citySelect || !barangaySelect) return;
        
        // Reset barangay dropdown
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
        
        if (!citySelect.value) return;
        
        try {
            const response = await fetch(`https://psgc.gitlab.io/api/cities-municipalities/${citySelect.value}/barangays/`);
            const barangays = await response.json();
            
            barangays.forEach(barangay => {
                const option = new Option(barangay.name, barangay.code);
                barangaySelect.add(option);
            });
        } catch (error) {
            console.error('Error loading barangays:', error);
            // Fallback: Add common barangays
            const commonBarangays = ['Barangay 1', 'Barangay 2', 'Barangay 3', 'Barangay 4', 'Barangay 5'];
            commonBarangays.forEach(barangay => {
                const option = new Option(barangay, barangay);
                barangaySelect.add(option);
            });
        }
        
        updateCompleteAddress(type);
    }

    function updateCompleteAddress(type) {
        const regionSelect = document.getElementById(`${type}_region`);
        const provinceSelect = document.getElementById(`${type}_province`);
        const citySelect = document.getElementById(`${type}_city`);
        const barangaySelect = document.getElementById(`${type}_barangay`);
        const streetInput = document.getElementById(`${type}_street`);
        const displayElement = document.getElementById(`${type}_complete_address`);
        const inputElement = document.getElementById(`${type}_complete_address_input`);

        if (!regionSelect || !provinceSelect || !citySelect || !barangaySelect || !streetInput || !displayElement || !inputElement) return;

        const street = streetInput.value;

        // Use the selected option's text (name), not value (code)
        const region = regionSelect && regionSelect.selectedIndex > 0 ? regionSelect.options[regionSelect.selectedIndex].text : '';
        const province = provinceSelect && provinceSelect.selectedIndex > 0 ? provinceSelect.options[provinceSelect.selectedIndex].text : '';
        const city = citySelect && citySelect.selectedIndex > 0 ? citySelect.options[citySelect.selectedIndex].text : '';
        const barangay = barangaySelect && barangaySelect.selectedIndex > 0 ? barangaySelect.options[barangaySelect.selectedIndex].text : '';

        let completeAddress = '';
        if (street) completeAddress += street + ', ';
        if (barangay) completeAddress += barangay + ', ';
        if (city) completeAddress += city + ', ';
        if (province) completeAddress += province + ', ';
        if (region) completeAddress += region;

        if (completeAddress.endsWith(', ')) {
            completeAddress = completeAddress.slice(0, -2);
        }

        if (completeAddress) {
            displayElement.textContent = completeAddress;
            inputElement.value = completeAddress;
        } else {
            displayElement.textContent = 'Address will be displayed here...';
            inputElement.value = '';
        }
    }

    // Helper function for common provinces (fallback)
    function getCommonProvinces(region) {
        const provinceMap = {
            'National Capital Region (NCR)': ['Metro Manila'],
            'Cordillera Administrative Region (CAR)': ['Abra', 'Apayao', 'Benguet', 'Ifugao', 'Kalinga', 'Mountain Province'],
            'Ilocos Region (Region I)': ['Ilocos Norte', 'Ilocos Sur', 'La Union', 'Pangasinan'],
            'Cagayan Valley (Region II)': ['Batanes', 'Cagayan', 'Isabela', 'Nueva Vizcaya', 'Quirino'],
            'Central Luzon (Region III)': ['Aurora', 'Bataan', 'Bulacan', 'Nueva Ecija', 'Pampanga', 'Tarlac', 'Zambales'],
            'CALABARZON (Region IV-A)': ['Batangas', 'Cavite', 'Laguna', 'Quezon', 'Rizal'],
            'MIMAROPA (Region IV-B)': ['Marinduque', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Romblon'],
            'Bicol Region (Region V)': ['Albay', 'Camarines Norte', 'Camarines Sur', 'Catanduanes', 'Masbate', 'Sorsogon'],
            'Western Visayas (Region VI)': ['Aklan', 'Antique', 'Capiz', 'Guimaras', 'Iloilo', 'Negros Occidental'],
            'Central Visayas (Region VII)': ['Bohol', 'Cebu', 'Negros Oriental', 'Siquijor'],
            'Eastern Visayas (Region VIII)': ['Biliran', 'Eastern Samar', 'Leyte', 'Northern Samar', 'Samar', 'Southern Leyte'],
            'Zamboanga Peninsula (Region IX)': ['Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay'],
            'Northern Mindanao (Region X)': ['Bukidnon', 'Camiguin', 'Lanao del Norte', 'Misamis Occidental', 'Misamis Oriental'],
            'Davao Region (Region XI)': ['Compostela Valley', 'Davao del Norte', 'Davao del Sur', 'Davao Occidental', 'Davao Oriental'],
            'SOCCSKSARGEN (Region XII)': ['Cotabato', 'Sarangani', 'South Cotabato', 'Sultan Kudarat'],
            'Caraga (Region XIII)': ['Agusan del Norte', 'Agusan del Sur', 'Dinagat Islands', 'Surigao del Norte', 'Surigao del Sur'],
            'Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)': ['Basilan', 'Lanao del Sur', 'Maguindanao', 'Sulu', 'Tawi-Tawi']
        };
        
        return provinceMap[region] || ['Province 1', 'Province 2', 'Province 3'];
    }

    // Setup event listeners for address functionality
    function setupAddressEventListeners() {
        ['home', 'business'].forEach(type => {
            const streetInput = document.getElementById(`${type}_street`);
            if (streetInput) {
                // Remove existing listeners to prevent duplicates
                streetInput.removeEventListener('input', () => updateCompleteAddress(type));
                streetInput.addEventListener('input', () => updateCompleteAddress(type));
            }
            
            const barangaySelect = document.getElementById(`${type}_barangay`);
            if (barangaySelect) {
                // Remove existing listeners to prevent duplicates
                barangaySelect.removeEventListener('change', () => updateCompleteAddress(type));
                barangaySelect.addEventListener('change', () => updateCompleteAddress(type));
            }
        });
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        window.initializePersonalDetails();
        // For each address type, if a code is set, fetch the name and set the option text
        ['home', 'business'].forEach(type => {
            let fetches = [];
            ['region', 'province', 'city', 'barangay'].forEach(level => {
                const select = document.getElementById(`${type}_${level}`);
                if (select && select.value) {
                    fetches.push(
                        fetchPSGCName(level, select.value).then(name => {
                            if (name) {
                                // Update the text of the existing option with the matching value
                                for (let i = 0; i < select.options.length; i++) {
                                    if (select.options[i].value === select.value) {
                                        select.options[i].text = name;
                                        break;
                                    }
                                }
                            }
                        })
                    );
                }
            });
            // After all fetches, update the complete address display
            Promise.all(fetches).then(() => {
                updateCompleteAddress(type);
            });
        });
    });

    // Helper to fetch PSGC name for a code
    async function fetchPSGCName(level, code) {
        let url = '';
        if (level === 'region') url = `https://psgc.gitlab.io/api/regions/${code}/`;
        if (level === 'province') url = `https://psgc.gitlab.io/api/provinces/${code}/`;
        if (level === 'city') url = `https://psgc.gitlab.io/api/cities-municipalities/${code}/`;
        if (level === 'barangay') url = `https://psgc.gitlab.io/api/barangays/${code}/`;
        try {
            const res = await fetch(url);
            if (!res.ok) return null;
            const data = await res.json();
            return data.name || null;
        } catch {
            return null;
        }
    }

    function setAddressNameHiddenFields(type) {
        const regionSelect = document.getElementById(`${type}_region`);
        const provinceSelect = document.getElementById(`${type}_province`);
        const citySelect = document.getElementById(`${type}_city`);
        const barangaySelect = document.getElementById(`${type}_barangay`);
        
        // Get hidden input elements with null checking
        const regionNameInput = document.getElementById(`${type}_region_name`);
        const provinceNameInput = document.getElementById(`${type}_province_name`);
        const cityNameInput = document.getElementById(`${type}_city_name`);
        const barangayNameInput = document.getElementById(`${type}_barangay_name`);
        
        // Set values only if elements exist
        if (regionNameInput) {
            regionNameInput.value = regionSelect && regionSelect.selectedIndex > 0 ? regionSelect.options[regionSelect.selectedIndex].text : '';
        }
        if (provinceNameInput) {
            provinceNameInput.value = provinceSelect && provinceSelect.selectedIndex > 0 ? provinceSelect.options[provinceSelect.selectedIndex].text : '';
        }
        if (cityNameInput) {
            cityNameInput.value = citySelect && citySelect.selectedIndex > 0 ? citySelect.options[citySelect.selectedIndex].text : '';
        }
        if (barangayNameInput) {
            barangayNameInput.value = barangaySelect && barangaySelect.selectedIndex > 0 ? barangaySelect.options[barangaySelect.selectedIndex].text : '';
        }
    }

    // On form submit, set hidden fields for both home and business
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function() {
            setAddressNameHiddenFields('home');
            setAddressNameHiddenFields('business');
        });
    }
</script>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "{{ route('personnel.phs.personal-characteristics') }}";
                } else if (data.errors) {
                    alert('Please fill in all required fields.');
                }
            })
            .catch(error => {
                alert('An error occurred. Please try again.');
            });
        });
    }
});
</script>
@endpush
@endsection 