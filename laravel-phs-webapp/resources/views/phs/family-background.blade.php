@extends('layouts.phs-new')

@section('title', request()->routeIs('phs.family-history.create') ? 'IV: Family History' : 'IV: Family Background')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">{{ request()->routeIs('phs.family-history.create') ? 'Family History' : 'Family Background' }}</h1>
                <p class="text-gray-600">Please provide information about your family</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ request()->routeIs('phs.family-history.create') ? route('phs.family-history.store') : route('phs.family-background.store') }}" class="space-y-8">
        @csrf
        
        <!-- Father's Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-male mr-3 text-[#D4AF37]"></i>
                Father Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                    <input type="text" name="father_first_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name *</label>
                    <input type="text" name="father_middle_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                    <input type="text" name="father_last_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Suffix (e.g. Sr, IV, etc)</label>
                    <input type="text" name="father_suffix" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="e.g. Sr, IV, etc">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                    <input type="date" name="father_birth_date" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth *</label>
                    <input type="text" name="father_birth_place" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of birth">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                    <input type="text" name="father_occupation" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employer</label>
                    <input type="text" name="father_employer" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Employment</label>
                    <input type="text" name="father_place_of_employment" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of employment">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship</label>
                    <input type="text" name="father_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Other Citizenship</label>
                    <input type="text" name="father_other_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter other citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">If Naturalized (Provide Date and Place)</label>
                    <input type="text" name="father_naturalized_details" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="If naturalized, provide date and place">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                <input type="text" name="father_complete_address" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
            </div>
        </div>

        <!-- Mother's Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-female mr-3 text-[#D4AF37]"></i>
                Mother Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                    <input type="text" name="mother_first_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name *</label>
                    <input type="text" name="mother_middle_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                    <input type="text" name="mother_last_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Suffix (e.g. Sr, IV, etc)</label>
                    <input type="text" name="mother_suffix" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="e.g. Sr, IV, etc">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                    <input type="date" name="mother_birth_date" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth *</label>
                    <input type="text" name="mother_birth_place" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of birth">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                    <input type="text" name="mother_occupation" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employer</label>
                    <input type="text" name="mother_employer" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Employment</label>
                    <input type="text" name="mother_place_of_employment" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of employment">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship</label>
                    <input type="text" name="mother_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Other Citizenship</label>
                    <input type="text" name="mother_other_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter other citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">If Naturalized (Provide Date and Place)</label>
                    <input type="text" name="mother_naturalized_details" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="If naturalized, provide date and place">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                <input type="text" name="mother_complete_address" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
            </div>
        </div>

        <!-- Step-parent or Guardian Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-shield mr-3 text-[#D4AF37]"></i>
                Step-parent or Guardian Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="step_parent_guardian_first_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                    <input type="text" name="step_parent_guardian_middle_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="step_parent_guardian_last_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Suffix (e.g. Sr, IV, etc)</label>
                    <input type="text" name="step_parent_guardian_suffix" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="e.g. Sr, IV, etc">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" name="step_parent_guardian_birth_date" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth</label>
                    <input type="text" name="step_parent_guardian_birth_place" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of birth">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                    <input type="text" name="step_parent_guardian_occupation" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employer</label>
                    <input type="text" name="step_parent_guardian_employer" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Employment</label>
                    <input type="text" name="step_parent_guardian_place_of_employment" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of employment">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship</label>
                    <input type="text" name="step_parent_guardian_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Other Citizenship</label>
                    <input type="text" name="step_parent_guardian_other_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter other citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">If Naturalized (Provide Date and Place)</label>
                    <input type="text" name="step_parent_guardian_naturalized_details" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="If naturalized, provide date and place">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                <input type="text" name="step_parent_guardian_complete_address" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
            </div>
        </div>

        <!-- Father-in-law Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-male mr-3 text-[#D4AF37]"></i>
                Father-in-law Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="father_in_law_first_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                    <input type="text" name="father_in_law_middle_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="father_in_law_last_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Suffix (e.g. Sr, IV, etc)</label>
                    <input type="text" name="father_in_law_suffix" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="e.g. Sr, IV, etc">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" name="father_in_law_birth_date" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth</label>
                    <input type="text" name="father_in_law_birth_place" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of birth">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                    <input type="text" name="father_in_law_occupation" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employer</label>
                    <input type="text" name="father_in_law_employer" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Employment</label>
                    <input type="text" name="father_in_law_place_of_employment" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of employment">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship</label>
                    <input type="text" name="father_in_law_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Other Citizenship</label>
                    <input type="text" name="father_in_law_other_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter other citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">If Naturalized (Provide Date and Place)</label>
                    <input type="text" name="father_in_law_naturalized_details" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="If naturalized, provide date and place">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                <input type="text" name="father_in_law_complete_address" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
            </div>
        </div>

        <!-- Mother-in-law Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-female mr-3 text-[#D4AF37]"></i>
                Mother-in-law Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="mother_in_law_first_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                    <input type="text" name="mother_in_law_middle_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="mother_in_law_last_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Suffix (e.g. Sr, IV, etc)</label>
                    <input type="text" name="mother_in_law_suffix" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="e.g. Sr, IV, etc">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" name="mother_in_law_birth_date" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth</label>
                    <input type="text" name="mother_in_law_birth_place" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of birth">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                    <input type="text" name="mother_in_law_occupation" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employer</label>
                    <input type="text" name="mother_in_law_employer" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Employment</label>
                    <input type="text" name="mother_in_law_place_of_employment" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of employment">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship</label>
                    <input type="text" name="mother_in_law_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Other Citizenship</label>
                    <input type="text" name="mother_in_law_other_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter other citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">If Naturalized (Provide Date and Place)</label>
                    <input type="text" name="mother_in_law_naturalized_details" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="If naturalized, provide date and place">
                </div>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                <input type="text" name="mother_in_law_complete_address" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
            </div>
        </div>

        <!-- Brothers and Sisters Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-users mr-3 text-[#D4AF37]"></i>
                Brothers and Sisters
            </h3>
            <div id="siblings-container" class="space-y-4">
                <!-- Initial sibling entry (default, not removable) -->
                <div class="sibling-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" name="siblings[0][first_name]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                            <input type="text" name="siblings[0][middle_name]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="siblings[0][last_name]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                            <input type="date" name="siblings[0][date_of_birth]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship</label>
                            <input type="text" name="siblings[0][citizenship]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">If Dual, Other Citizenship</label>
                            <input type="text" name="siblings[0][dual_citizenship]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter other citizenship (if dual)">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                            <input type="text" name="siblings[0][complete_address]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                            <input type="text" name="siblings[0][occupation]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Employer</label>
                            <input type="text" name="siblings[0][employer]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Employer Address</label>
                            <input type="text" name="siblings[0][employer_address]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer address">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-sibling" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Sibling
            </button>
        </div>
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const siblingsContainer = document.getElementById('siblings-container');
            const addSiblingBtn = document.getElementById('add-sibling');

            addSiblingBtn.addEventListener('click', () => {
                const entries = siblingsContainer.querySelectorAll('.sibling-entry');
                const idx = entries.length;
                const siblingEntry = document.createElement('div');
                siblingEntry.className = 'sibling-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
                siblingEntry.setAttribute('data-index', idx);
                siblingEntry.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" name="siblings[${idx}][first_name]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                            <input type="text" name="siblings[${idx}][middle_name]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="siblings[${idx}][last_name]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                            <input type="date" name="siblings[${idx}][date_of_birth]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship</label>
                            <input type="text" name="siblings[${idx}][citizenship]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">If Dual, Other Citizenship</label>
                            <input type="text" name="siblings[${idx}][dual_citizenship]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter other citizenship (if dual)">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address</label>
                            <input type="text" name="siblings[${idx}][complete_address]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                            <input type="text" name="siblings[${idx}][occupation]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Employer</label>
                            <input type="text" name="siblings[${idx}][employer]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Employer Address</label>
                            <input type="text" name="siblings[${idx}][employer_address]" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer address">
                        </div>
                    </div>
                    <button type="button" class="remove-sibling absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
                `;
                siblingsContainer.appendChild(siblingEntry);
            });

            siblingsContainer.addEventListener('click', (e) => {
                if (e.target.closest('.remove-sibling')) {
                    const entries = siblingsContainer.querySelectorAll('.sibling-entry');
                    if (entries.length > 1) {
                        e.target.closest('.sibling-entry').remove();
                    }
                }
            });
        });
        </script>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('family-background')" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all shadow-none">
                <i class="fas fa-arrow-left mr-2"></i>
                Previous Section
            </button>
            
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'family-background')">
                Save & Continue
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
    // Initialize Alpine.js data for this section
    document.addEventListener('alpine:init', () => {
        Alpine.data('familyBackground', () => ({
            currentSection: '{{ request()->routeIs("phs.family-history.create") ? "family-history" : "family-background" }}',
            init() {
                // Mark this section as visited
                this.markSectionAsVisited(this.currentSection);
            }
        }));
    });
</script>
@endsection 