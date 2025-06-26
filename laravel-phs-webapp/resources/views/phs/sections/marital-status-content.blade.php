<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-heart text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Marital Status</h1>
                <p class="text-gray-600">Please provide your marital status information</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('phs.marital-status.store') }}" class="space-y-8">
        @csrf
        
        <!-- Marital Status -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-friends mr-3 text-[#D4AF37]"></i>
                Marital Status
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Marital Status -->
                <div>
                    <label for="marital_status" class="block text-sm font-medium text-gray-700 mb-2">
                        Current Marital Status *
                    </label>
                    <select name="marital_status" id="marital_status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Marital Status</option>
                        <option value="Single" {{ isset($maritalStatus) && $maritalStatus->marital_status === 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ isset($maritalStatus) && $maritalStatus->marital_status === 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Widowed" {{ isset($maritalStatus) && $maritalStatus->marital_status === 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        <option value="Separated" {{ isset($maritalStatus) && $maritalStatus->marital_status === 'Separated' ? 'selected' : '' }}>Separated</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Spouse Information (Always Visible) -->
        <div id="spouse-section" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user mr-3 text-[#D4AF37]"></i>
                Spouse Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="spouse_first_name" class="block text-sm font-medium text-gray-700 mb-2">
                        First Name *
                    </label>
                    <input type="text" name="spouse_first_name" id="spouse_first_name"
                           value="{{ isset($spouseName) ? $spouseName->first_name : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter first name">
                </div>
                <div>
                    <label for="spouse_middle_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Middle Name
                    </label>
                    <input type="text" name="spouse_middle_name" id="spouse_middle_name"
                           value="{{ isset($spouseName) ? $spouseName->middle_name : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter middle name">
                </div>
                <div>
                    <label for="spouse_last_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Last Name *
                    </label>
                    <input type="text" name="spouse_last_name" id="spouse_last_name"
                           value="{{ isset($spouseName) ? $spouseName->last_name : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter last name">
                </div>
                <div>
                    <label for="spouse_suffix" class="block text-sm font-medium text-gray-700 mb-2">
                        Suffix
                    </label>
                    <input type="text" name="spouse_suffix" id="spouse_suffix"
                           value="{{ isset($maritalStatus) ? $maritalStatus->spouse_suffix : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Jr., Sr., III">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="marriage_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Date of Marriage *
                    </label>
                    <div class="flex space-x-2">
                        <select name="marriage_month" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                            <option value="">Month</option>
                            <option value="01" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '01' ? 'selected' : '' }}>January</option>
                            <option value="02" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '02' ? 'selected' : '' }}>February</option>
                            <option value="03" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '03' ? 'selected' : '' }}>March</option>
                            <option value="04" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '04' ? 'selected' : '' }}>April</option>
                            <option value="05" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '05' ? 'selected' : '' }}>May</option>
                            <option value="06" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '06' ? 'selected' : '' }}>June</option>
                            <option value="07" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '07' ? 'selected' : '' }}>July</option>
                            <option value="08" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '08' ? 'selected' : '' }}>August</option>
                            <option value="09" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '09' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '10' ? 'selected' : '' }}>October</option>
                            <option value="11" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ isset($maritalStatus) && $maritalStatus->marriage_month === '12' ? 'selected' : '' }}>December</option>
                        </select>
                        <input type="number" name="marriage_year" min="1900" max="2030" value="{{ isset($maritalStatus) ? $maritalStatus->marriage_year : '' }}" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Year">
                    </div>
                    <!-- Hidden fields to maintain compatibility with backend -->
                    <input type="hidden" name="marriage_date_type" value="month_year">
                    <input type="hidden" name="marriage_date" value="">
                </div>
                <div>
                    <label for="marriage_place" class="block text-sm font-medium text-gray-700 mb-2">
                        Place of Marriage *
                    </label>
                    <input type="text" name="marriage_place" id="marriage_place"
                           value="{{ isset($maritalStatus) ? $maritalStatus->marriage_place : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter place of marriage">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="spouse_birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Date of Birth *
                    </label>
                    <input type="date" name="spouse_birth_date" id="spouse_birth_date"
                           value="{{ isset($maritalStatus) && $maritalStatus->spouse_birth_date ? $maritalStatus->spouse_birth_date->format('Y-m-d') : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label for="spouse_birth_place" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Place of Birth *
                    </label>
                    <input type="text" name="spouse_birth_place" id="spouse_birth_place"
                           value="{{ isset($maritalStatus) ? $maritalStatus->spouse_birth_place : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter place of birth">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div>
                    <label for="spouse_occupation" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Occupation
                    </label>
                    <input type="text" name="spouse_occupation" id="spouse_occupation"
                           value="{{ isset($maritalStatus) ? $maritalStatus->spouse_occupation : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter occupation">
                </div>
                <div>
                    <label for="spouse_employer" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Employer
                    </label>
                    <input type="text" name="spouse_employer" id="spouse_employer"
                           value="{{ isset($maritalStatus) ? $maritalStatus->spouse_employer : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter employer">
                </div>
                <div>
                    <label for="spouse_employment_place" class="block text-sm font-medium text-gray-700 mb-2">
                        Place of Employment
                    </label>
                    <input type="text" name="spouse_employment_place" id="spouse_employment_place"
                           value="{{ isset($maritalStatus) ? $maritalStatus->spouse_employment_place : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter place of employment">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div>
                    <label for="spouse_contact" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Contact Number
                    </label>
                    <input type="tel" name="spouse_contact" id="spouse_contact"
                           value="{{ isset($maritalStatus) ? $maritalStatus->spouse_contact : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter contact number">
                </div>
                <div>
                    <label for="spouse_citizenship" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Citizenship *
                    </label>
                    <input type="text" name="spouse_citizenship" id="spouse_citizenship"
                           value="{{ isset($maritalStatus) ? $maritalStatus->spouse_citizenship : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter citizenship">
                </div>
                <div>
                    <label for="spouse_other_citizenship" class="block text-sm font-medium text-gray-700 mb-2">
                        Other Citizenship
                    </label>
                    <input type="text" name="spouse_other_citizenship" id="spouse_other_citizenship"
                           value="{{ isset($maritalStatus) ? $maritalStatus->spouse_other_citizenship : '' }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter other citizenship">
                </div>
            </div>
        </div>

        <!-- Children Information (Always Visible) -->
        <div id="children-section" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-child mr-3 text-[#D4AF37]"></i>
                Children Information
            </h3>
            
            <div id="children-container" class="space-y-4">
                <!-- Initial child entry (default, not removable) -->
                <div class="child-entry p-4 border border-gray-200 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Child's Name</label>
                            <input type="text" name="children[0][name]" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter child's name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                            <input type="date" name="children[0][birth_date]" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="children[0][citizenship]" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" name="children[0][address]" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter address">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name of Father</label>
                            <input type="text" name="children[0][father_name]" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter father's name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name of Mother</label>
                            <input type="text" name="children[0][mother_name]" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter mother's name">
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="button" id="add-child" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Child
            </button>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('marital-status')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Previous Section
            </button>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'marital-status')">
                Save & Continue
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
if (window.initializeMaritalStatus) window.initializeMaritalStatus();
</script> 