@php
    // Always use the client PHS layout for identical UI
    $layout = 'layouts.phs-new';
    $dashboardRoute = route('personnel.dashboard');
    $nextSectionRoute = Auth::user() && Auth::user()->role === 'client' ? route('phs.personal-characteristics') : route('phs.personal-characteristics.create');
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
    <form method="POST" action="{{ route('phs.personal-details.store') }}" class="space-y-8">
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
                           value="{{ $personalDetails ? $personalDetails->first_name : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->first_name : '') }}">
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
                           value="{{ $personalDetails ? $personalDetails->middle_name : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->middle_name : '') }}">
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
                           value="{{ $personalDetails ? $personalDetails->last_name : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->last_name : '') }}">
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
                           value="{{ $personalDetails ? $personalDetails->suffix : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->name_extension : '') }}">
                </div>

                <!-- Nickname -->
                <div>
                    <label for="nickname" class="block text-sm font-medium text-gray-700 mb-2">
                        Nickname
                    </label>
                    <input type="text" name="nickname" id="nickname"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your nickname"
                           value="{{ $personalDetails ? $personalDetails->nickname : ($userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->nickname : '') }}">
                </div>
            </div>
        </div>

        <!-- Birth Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-birthday-cake mr-3 text-[#D4AF37]"></i>
                Birth Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Date of Birth -->
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">
                        Date of Birth
                    </label>
                    <input type="date" name="date_of_birth" id="date_of_birth"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           value="{{ isset($personalDetails->date_of_birth) ? (\Illuminate\Support\Str::length($personalDetails->date_of_birth) === 10 ? $personalDetails->date_of_birth : (new \Carbon\Carbon($personalDetails->date_of_birth))->format('Y-m-d')) : '' }}">
                    @error('date_of_birth')
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
                           value="{{ $personalDetails->nationality ?? '' }}">
                </div>
            </div>
            <!-- Place of Birth -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Region -->
                <div>
                    <label for="birth_region" class="block text-sm font-medium text-gray-700 mb-2">
                        Region
                    </label>
                    <select name="birth_region" id="birth_region"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                            onchange="loadProvinces('birth')">
                        <option value="">Select Region</option>
                        @if(isset($personalDetails->birth_region) && $personalDetails->birth_region)
                            <option value="{{ $personalDetails->birth_region }}" selected>
                                {{ $personalDetails->birth_region_name ?? $personalDetails->birth_region }}
                            </option>
                        @endif
                    </select>
                    <button type="button" onclick="loadRegions()" class="mt-2 text-sm text-blue-600 hover:text-blue-800">
                        Reload Regions
                    </button>
                </div>

                <!-- Province -->
                <div>
                    <label for="birth_province" class="block text-sm font-medium text-gray-700 mb-2">
                        Province
                    </label>
                    <select name="birth_province" id="birth_province"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                            onchange="loadCities('birth')">
                        <option value="">Select Province</option>
                        @if(isset($personalDetails->birth_province) && $personalDetails->birth_province)
                            <option value="{{ $personalDetails->birth_province }}" selected>
                                {{ $personalDetails->birth_province_name ?? $personalDetails->birth_province }}
                            </option>
                        @endif
                    </select>
                </div>

                <!-- City/Municipality -->
                <div>
                    <label for="birth_city" class="block text-sm font-medium text-gray-700 mb-2">
                        City/Municipality
                    </label>
                    <select name="birth_city" id="birth_city"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                            onchange="loadBarangays('birth')">
                        <option value="">Select City/Municipality</option>
                        @if(isset($personalDetails->birth_city) && $personalDetails->birth_city)
                            <option value="{{ $personalDetails->birth_city }}" selected>
                                {{ $personalDetails->birth_city_name ?? $personalDetails->birth_city }}
                            </option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Barangay -->
                <div>
                    <label for="birth_barangay" class="block text-sm font-medium text-gray-700 mb-2">
                        Barangay
                    </label>
                    <select name="birth_barangay" id="birth_barangay"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Barangay</option>
                        @if(isset($personalDetails->birth_barangay) && $personalDetails->birth_barangay)
                            <option value="{{ $personalDetails->birth_barangay }}" selected>
                                {{ $personalDetails->birth_barangay_name ?? $personalDetails->birth_barangay }}
                            </option>
                        @endif
                    </select>
                </div>

                <!-- Street Address -->
                <div>
                    <label for="birth_street" class="block text-sm font-medium text-gray-700 mb-2">
                        Street Address
                    </label>
                    <input type="text" name="birth_street" id="birth_street"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Building/Office No., Street Name"
                           value="{{ $personalDetails->birth_street ?? '' }}">
                </div>
            </div>

            <!-- Complete Address Display -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Birth Address</label>
                <div id="birth_complete_address" class="text-gray-600 text-sm">
                    {{ $personalDetails->birth_street ?? '' }}{{ ($personalDetails && $personalDetails->birth_street) ? ', ' : '' }}{{ $personalDetails->birth_barangay_name ?? '' }}{{ ($personalDetails && $personalDetails->birth_barangay_name) ? ', ' : '' }}{{ $personalDetails->birth_city_name ?? '' }}{{ ($personalDetails && $personalDetails->birth_city_name) ? ', ' : '' }}{{ $personalDetails->birth_province_name ?? '' }}{{ ($personalDetails && $personalDetails->birth_province_name) ? ', ' : '' }}{{ $personalDetails->birth_region_name ?? '' }}
                </div>
                <input type="hidden" name="birth_complete_address" id="birth_complete_address_input"
                       value="{{ $personalDetails->birth_complete_address ?? '' }}">
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
                           value="{{ $personalDetails->rank ?? '' }}">
                </div>

                <!-- AFPSN -->
                <div>
                    <label for="afpsn" class="block text-sm font-medium text-gray-700 mb-2">
                        AFPSN
                    </label>
                    <input type="text" name="afpsn" id="afpsn"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your AFPSN"
                           value="{{ $personalDetails->afpsn ?? '' }}">
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
                           value="{{ $personalDetails->branch_of_service ?? '' }}">
                </div>

                <!-- Present Job/Assignment -->
                <div>
                    <label for="present_job" class="block text-sm font-medium text-gray-700 mb-2">
                        Present Job/Assignment
                    </label>
                    <input type="text" name="present_job" id="present_job"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter your current job or assignment"
                           value="{{ $personalDetails->present_job ?? '' }}">
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
                        @if(isset($personalDetails->home_region) && $personalDetails->home_region)
                            <option value="{{ $personalDetails->home_region }}" selected>
                                {{ $personalDetails->home_region_name ?? $personalDetails->home_region }}
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
                        @if(isset($personalDetails->home_province) && $personalDetails->home_province)
                            <option value="{{ $personalDetails->home_province }}" selected>
                                {{ $personalDetails->home_province_name ?? $personalDetails->home_province }}
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
                        @if(isset($personalDetails->home_city) && $personalDetails->home_city)
                            <option value="{{ $personalDetails->home_city }}" selected>
                                {{ $personalDetails->home_city_name ?? $personalDetails->home_city }}
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
                        @if(isset($personalDetails->home_barangay) && $personalDetails->home_barangay)
                            <option value="{{ $personalDetails->home_barangay }}" selected>
                                {{ $personalDetails->home_barangay_name ?? $personalDetails->home_barangay }}
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
                           value="{{ $personalDetails->home_street ?? '' }}">
                </div>
            </div>

            <!-- Complete Address Display -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Home Address</label>
                <div id="home_complete_address" class="text-gray-600 text-sm">
                    {{ $personalDetails->home_street ?? '' }}{{ ($personalDetails && $personalDetails->home_street) ? ', ' : '' }}{{ $personalDetails->home_barangay_name ?? '' }}{{ ($personalDetails && $personalDetails->home_barangay_name) ? ', ' : '' }}{{ $personalDetails->home_city_name ?? '' }}{{ ($personalDetails && $personalDetails->home_city_name) ? ', ' : '' }}{{ $personalDetails->home_province_name ?? '' }}{{ ($personalDetails && $personalDetails->home_province_name) ? ', ' : '' }}{{ $personalDetails->home_region_name ?? '' }}
                </div>
                <input type="hidden" name="home_complete_address" id="home_complete_address_input"
                       value="{{ $personalDetails->home_complete_address ?? '' }}">
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
                        @if(isset($personalDetails->business_region) && $personalDetails->business_region)
                            <option value="{{ $personalDetails->business_region }}" selected>
                                {{ $personalDetails->business_region_name ?? $personalDetails->business_region }}
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
                        @if(isset($personalDetails->business_province) && $personalDetails->business_province)
                            <option value="{{ $personalDetails->business_province }}" selected>
                                {{ $personalDetails->business_province_name ?? $personalDetails->business_province }}
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
                        @if(isset($personalDetails->business_city) && $personalDetails->business_city)
                            <option value="{{ $personalDetails->business_city }}" selected>
                                {{ $personalDetails->business_city_name ?? $personalDetails->business_city }}
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
                        @if(isset($personalDetails->business_barangay) && $personalDetails->business_barangay)
                            <option value="{{ $personalDetails->business_barangay }}" selected>
                                {{ $personalDetails->business_barangay_name ?? $personalDetails->business_barangay }}
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
                           value="{{ $personalDetails->business_street ?? '' }}">
                </div>
            </div>

            <!-- Complete Address Display -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Business Address</label>
                <div id="business_complete_address" class="text-gray-600 text-sm">
                    {{ $personalDetails->business_street ?? '' }}{{ ($personalDetails && $personalDetails->business_street) ? ', ' : '' }}{{ $personalDetails->business_barangay_name ?? '' }}{{ ($personalDetails && $personalDetails->business_barangay_name) ? ', ' : '' }}{{ $personalDetails->business_city_name ?? '' }}{{ ($personalDetails && $personalDetails->business_city_name) ? ', ' : '' }}{{ $personalDetails->business_province_name ?? '' }}{{ ($personalDetails && $personalDetails->business_province_name) ? ', ' : '' }}{{ $personalDetails->business_region_name ?? '' }}
                </div>
                <input type="hidden" name="business_complete_address" id="business_complete_address_input"
                       value="{{ $personalDetails->business_complete_address ?? '' }}">
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
                           value="{{ $personalDetails ? $personalDetails->email : ($userDetails && $userDetails->email_addr ? $userDetails->email_addr : '') }}">
                </div>

                <!-- Mobile -->
                <div>
                    <label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">
                        Mobile Number
                    </label>
                    <input type="tel" name="mobile" id="mobile"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="+63 9XX XXX XXXX"
                           value="{{ $personalDetails->mobile ?? '' }}">
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
                           value="{{ $personalDetails->religion ?? '' }}">
                </div>

                <!-- TIN -->
                <div>
                    <label for="tin" class="block text-sm font-medium text-gray-700 mb-2">
                        Tax Identification Number (TIN)
                    </label>
                    <input type="text" name="tin" id="tin"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="XXX-XXX-XXX-XXX"
                           value="{{ $personalDetails->tin_no ?? '' }}">
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
                           value="{{ $personalDetails->passport_number ?? '' }}">
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
                           value="{{ isset($personalDetails->passport_expiry) ? (\Illuminate\Support\Str::length($personalDetails->passport_expiry) === 10 ? $personalDetails->passport_expiry : (new \Carbon\Carbon($personalDetails->passport_expiry))->format('Y-m-d')) : '' }}">
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
                              placeholder="If you have legally changed your name, please provide details including court case number, date, and reason">{{ ($personalDetails && $personalDetails->change_in_name) ? $personalDetails->change_in_name : (($personalDetails && $personalDetails->name_change) ? $personalDetails->name_change : '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Birth Address Section -->
        <input type="hidden" name="birth_region_name" id="birth_region_name">
        <input type="hidden" name="birth_province_name" id="birth_province_name">
        <input type="hidden" name="birth_city_name" id="birth_city_name">
        <input type="hidden" name="birth_barangay_name" id="birth_barangay_name">
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
        console.log('initializePersonalDetails called');
        // Use fallback regions since they work reliably
        loadFallbackRegions();
        setupAddressEventListeners();
        window.phsHomeRegionName = document.getElementById('home_region_name')?.value || '';
        window.phsBusinessRegionName = document.getElementById('business_region_name')?.value || '';
        window.phsBirthRegionName = document.getElementById('birth_region_name')?.value || '';

        // Always set hidden region name fields to the selected option's text
        const homeRegionSelect = document.getElementById('home_region');
        const businessRegionSelect = document.getElementById('business_region');
        const birthRegionSelect = document.getElementById('birth_region');
        const homeRegionNameInput = document.getElementById('home_region_name');
        const businessRegionNameInput = document.getElementById('business_region_name');
        const birthRegionNameInput = document.getElementById('birth_region_name');

        if (homeRegionSelect && homeRegionNameInput) {
            homeRegionNameInput.value = homeRegionSelect.options[homeRegionSelect.selectedIndex]?.text || '';
        }
        if (businessRegionSelect && businessRegionNameInput) {
            businessRegionNameInput.value = businessRegionSelect.options[businessRegionSelect.selectedIndex]?.text || '';
        }
        if (birthRegionSelect && birthRegionNameInput) {
            birthRegionNameInput.value = birthRegionSelect.options[birthRegionSelect.selectedIndex]?.text || '';
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
        console.log('Loading regions...');

        // Add a timeout to the fetch request
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 5000); // 5 second timeout

        try {
            const response = await fetch('https://psgc.gitlab.io/api/regions/', {
                signal: controller.signal
            });
            clearTimeout(timeoutId);

            if (!response.ok) {
                throw new Error('Failed to fetch regions');
            }
            const regions = await response.json();
            console.log('Regions loaded:', regions.length, 'regions found');

            const homeRegionSelect = document.getElementById('home_region');
            const businessRegionSelect = document.getElementById('business_region');
            const birthRegionSelect = document.getElementById('birth_region');

            console.log('Found region selects:', {
                home: !!homeRegionSelect,
                business: !!businessRegionSelect,
                birth: !!birthRegionSelect
            });

            if (homeRegionSelect && businessRegionSelect && birthRegionSelect) {
                // Store current values
                const homeSelected = homeRegionSelect.value;
                const businessSelected = businessRegionSelect.value;
                const birthSelected = birthRegionSelect.value;

                // Clear existing options except the first one
                homeRegionSelect.innerHTML = '<option value="">Select Region</option>';
                businessRegionSelect.innerHTML = '<option value="">Select Region</option>';
                birthRegionSelect.innerHTML = '<option value="">Select Region</option>';

                regions.forEach(region => {
                    const homeOption = new Option(region.name, region.code);
                    const businessOption = new Option(region.name, region.code);
                    const birthOption = new Option(region.name, region.code);
                    homeRegionSelect.add(homeOption);
                    businessRegionSelect.add(businessOption);
                    birthRegionSelect.add(birthOption);
                });
                console.log('Regions populated successfully. Counts:', {
                    home: homeRegionSelect.options.length,
                    business: businessRegionSelect.options.length,
                    birth: birthRegionSelect.options.length
                });

                // Restore selected values
                if (birthSelected) {
                    birthRegionSelect.value = birthSelected;
                }
                if (homeSelected) {
                    homeRegionSelect.value = homeSelected;
                }
                if (businessSelected) {
                    businessRegionSelect.value = businessSelected;
                }
            }
        } catch (error) {
            console.error('Error loading regions:', error);
            console.log('Using fallback regions...');
            return loadFallbackRegions();
        }
    }

    // Separate function for fallback regions
    function loadFallbackRegions() {
        const commonRegions = [
            { name: 'National Capital Region (NCR)', code: '130000000' },
            { name: 'Cordillera Administrative Region (CAR)', code: '140000000' },
            { name: 'Ilocos Region (Region I)', code: '010000000' },
            { name: 'Cagayan Valley (Region II)', code: '020000000' },
            { name: 'Central Luzon (Region III)', code: '030000000' },
            { name: 'CALABARZON (Region IV-A)', code: '040000000' },
            { name: 'MIMAROPA (Region IV-B)', code: '170000000' },
            { name: 'Bicol Region (Region V)', code: '050000000' },
            { name: 'Western Visayas (Region VI)', code: '060000000' },
            { name: 'Central Visayas (Region VII)', code: '070000000' },
            { name: 'Eastern Visayas (Region VIII)', code: '080000000' },
            { name: 'Zamboanga Peninsula (Region IX)', code: '090000000' },
            { name: 'Northern Mindanao (Region X)', code: '100000000' },
            { name: 'Davao Region (Region XI)', code: '110000000' },
            { name: 'SOCCSKSARGEN (Region XII)', code: '120000000' },
            { name: 'Caraga (Region XIII)', code: '160000000' },
            { name: 'Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)', code: '150000000' }
        ];

        const birthRegionSelect = document.getElementById('birth_region');
        const homeRegionSelect = document.getElementById('home_region');
        const businessRegionSelect = document.getElementById('business_region');

        console.log('Fallback - Found region selects:', {
            home: !!homeRegionSelect,
            business: !!businessRegionSelect,
            birth: !!birthRegionSelect
        });

        if (birthRegionSelect && homeRegionSelect && businessRegionSelect) {
            // Clear existing options except the first one
            homeRegionSelect.innerHTML = '<option value="">Select Region</option>';
            businessRegionSelect.innerHTML = '<option value="">Select Region</option>';
            birthRegionSelect.innerHTML = '<option value="">Select Region</option>';

            commonRegions.forEach(region => {
                const homeOption = new Option(region.name, region.code);
                const businessOption = new Option(region.name, region.code);
                const birthOption = new Option(region.name, region.code);
                homeRegionSelect.add(homeOption);
                businessRegionSelect.add(businessOption);
                birthRegionSelect.add(birthOption);
            });
            console.log('Fallback regions loaded successfully. Counts:', {
                home: homeRegionSelect.options.length,
                business: businessRegionSelect.options.length,
                birth: birthRegionSelect.options.length
            });
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
        ['birth', 'home', 'business'].forEach(type => {
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
        console.log('DOMContentLoaded event fired');

        // Initialize personal details first
        window.initializePersonalDetails();

        // Use fallback regions by default since they work reliably
        console.log('Loading fallback regions by default...');
        loadFallbackRegions();

        // Test API directly
        fetch('https://psgc.gitlab.io/api/regions/')
            .then(response => {
                console.log('API test response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('API test successful, got', data.length, 'regions');
            })
            .catch(error => {
                console.error('API test failed:', error);
                // If API fails, load fallback regions immediately
                console.log('Loading fallback regions due to API failure...');
                loadFallbackRegions();
            });

        // Test birth region specifically
        setTimeout(() => {
            const birthRegionSelect = document.getElementById('birth_region');
            console.log('Birth region select after 1s:', {
                element: !!birthRegionSelect,
                options: birthRegionSelect ? birthRegionSelect.options.length : 0,
                value: birthRegionSelect ? birthRegionSelect.value : 'N/A'
            });

                        // Check final state
            console.log('Final birth region options count:', birthRegionSelect.options.length);
        }, 1000);

        // Wait a bit for regions to load, then handle existing values
        setTimeout(() => {
            // For each address type, if a code is set, fetch the name and set the option text
            ['birth', 'home', 'business'].forEach(type => {
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
        }, 2000); // Wait 2 seconds for regions to load
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
            setAddressNameHiddenFields('birth');
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
                    window.location.href = "{{ route('phs.personal-characteristics.create') }}";
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
