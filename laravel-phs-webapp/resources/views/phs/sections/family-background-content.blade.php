<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Family Background</h1>
                <p class="text-gray-600">Please provide information about your family members</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('phs.family-background.store') }}" class="space-y-10">
        @csrf
        <!-- Father's Information -->
        <div class="bg-white shadow-lg rounded-2xl border border-gray-200 p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-male text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-[#1B365D]">Father's Information</h3>
            </div>
            <!-- Name Details -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-id-card mr-2 text-[#D4AF37]"></i>Name Details</h4>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="father_first_name" value="{{ old('father_first_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="father_middle_name" value="{{ old('father_middle_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="father_last_name" value="{{ old('father_last_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="father_suffix" value="{{ old('father_suffix') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Jr., Sr., III">
                </div>
            </div>
            <!-- Birth Information -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="father_birth_date" value="{{ old('father_birth_date') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="father_birth_place" value="{{ old('father_birth_place') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of birth">
                </div>
            </div>
            <!-- Employment -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="father_occupation" value="{{ old('father_occupation') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="father_employer" value="{{ old('father_employer') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="father_place_of_employment" value="{{ old('father_place_of_employment') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of employment">
                </div>
            </div>
            <!-- Address -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                <input type="text" name="father_complete_address" value="{{ old('father_complete_address') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
            </div>
            <!-- Citizenship -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
            <div class="mb-2 px-2 py-2 bg-blue-50 rounded text-xs text-blue-800 border border-blue-100">
                <strong>Instructions:</strong> Select the type of citizenship. If dual, write both citizenships. If naturalized, give date and place where naturalized.
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship Type</label>
                    <select name="father_citizenship_type" id="father_citizenship_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" onchange="toggleCitizenshipFields('father')">
                        <option value="Single" {{ old('father_citizenship_type') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Dual" {{ old('father_citizenship_type') == 'Dual' ? 'selected' : '' }}>Dual</option>
                        <option value="Naturalized" {{ old('father_citizenship_type') == 'Naturalized' ? 'selected' : '' }}>Naturalized</option>
                    </select>
                </div>
                <div id="father_citizenship_single" class="citizenship-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="father_citizenship" value="{{ old('father_citizenship') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div id="father_citizenship_dual" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 1</label>
                            <input type="text" name="father_citizenship_dual_1" value="{{ old('father_citizenship_dual_1') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 2</label>
                            <input type="text" name="father_citizenship_dual_2" value="{{ old('father_citizenship_dual_2') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter second citizenship">
                        </div>
                    </div>
                </div>
                <div id="father_citizenship_naturalized" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="father_citizenship_naturalized" value="{{ old('father_citizenship_naturalized') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Naturalization (Month and Year)</label>
                            <div class="flex space-x-1">
                                <select name="father_naturalized_month" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                    <option value="">Month</option>
                                    <option value="01" {{ old('father_naturalized_month') == '01' ? 'selected' : '' }}>January</option>
                                    <option value="02" {{ old('father_naturalized_month') == '02' ? 'selected' : '' }}>February</option>
                                    <option value="03" {{ old('father_naturalized_month') == '03' ? 'selected' : '' }}>March</option>
                                    <option value="04" {{ old('father_naturalized_month') == '04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{ old('father_naturalized_month') == '05' ? 'selected' : '' }}>May</option>
                                    <option value="06" {{ old('father_naturalized_month') == '06' ? 'selected' : '' }}>June</option>
                                    <option value="07" {{ old('father_naturalized_month') == '07' ? 'selected' : '' }}>July</option>
                                    <option value="08" {{ old('father_naturalized_month') == '08' ? 'selected' : '' }}>August</option>
                                    <option value="09" {{ old('father_naturalized_month') == '09' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ old('father_naturalized_month') == '10' ? 'selected' : '' }}>October</option>
                                    <option value="11" {{ old('father_naturalized_month') == '11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ old('father_naturalized_month') == '12' ? 'selected' : '' }}>December</option>
                                </select>
                                <input type="number" name="father_naturalized_year" min="1900" max="2030" value="{{ old('father_naturalized_year') }}" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Year">
                            </div>
                </div>
                <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 mt-2">Place of Naturalization</label>
                            <input type="text" name="father_naturalized_place" value="{{ old('father_naturalized_place') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of naturalization">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mother's Information -->
        <div class="bg-white shadow-lg rounded-2xl border border-gray-200 p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-female text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-[#1B365D]">Mother's Information</h3>
            </div>
            <!-- Name Details -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-id-card mr-2 text-[#D4AF37]"></i>Name Details</h4>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="mother_first_name" value="{{ old('mother_first_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="mother_middle_name" value="{{ old('mother_middle_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="mother_last_name" value="{{ old('mother_last_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="mother_suffix" value="{{ old('mother_suffix') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Jr., Sr., III">
                </div>
            </div>
            <!-- Birth Information -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="mother_birth_date" value="{{ old('mother_birth_date') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="mother_birth_place" value="{{ old('mother_birth_place') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of birth">
                </div>
            </div>
            <!-- Employment -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="mother_occupation" value="{{ old('mother_occupation') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="mother_employer" value="{{ old('mother_employer') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="mother_place_of_employment" value="{{ old('mother_place_of_employment') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of employment">
                </div>
            </div>
            <!-- Address -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                <input type="text" name="mother_complete_address" value="{{ old('mother_complete_address') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
            </div>
            <!-- Citizenship -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
            <div class="mb-2 px-2 py-2 bg-blue-50 rounded text-xs text-blue-800 border border-blue-100">
                <strong>Instructions:</strong> Select the type of citizenship. If dual, write both citizenships. If naturalized, give date and place where naturalized.
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship Type</label>
                    <select name="mother_citizenship_type" id="mother_citizenship_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" onchange="toggleCitizenshipFields('mother')">
                        <option value="Single" {{ old('mother_citizenship_type') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Dual" {{ old('mother_citizenship_type') == 'Dual' ? 'selected' : '' }}>Dual</option>
                        <option value="Naturalized" {{ old('mother_citizenship_type') == 'Naturalized' ? 'selected' : '' }}>Naturalized</option>
                    </select>
                </div>
                <div id="mother_citizenship_single" class="citizenship-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="mother_citizenship" value="{{ old('mother_citizenship') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div id="mother_citizenship_dual" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 1</label>
                            <input type="text" name="mother_citizenship_dual_1" value="{{ old('mother_citizenship_dual_1') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 2</label>
                            <input type="text" name="mother_citizenship_dual_2" value="{{ old('mother_citizenship_dual_2') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter second citizenship">
                        </div>
                    </div>
                </div>
                <div id="mother_citizenship_naturalized" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="mother_citizenship_naturalized" value="{{ old('mother_citizenship_naturalized') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Naturalization (Month and Year)</label>
                            <div class="flex space-x-1">
                                <select name="mother_naturalized_month" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                    <option value="">Month</option>
                                    <option value="01" {{ old('mother_naturalized_month') == '01' ? 'selected' : '' }}>January</option>
                                    <option value="02" {{ old('mother_naturalized_month') == '02' ? 'selected' : '' }}>February</option>
                                    <option value="03" {{ old('mother_naturalized_month') == '03' ? 'selected' : '' }}>March</option>
                                    <option value="04" {{ old('mother_naturalized_month') == '04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{ old('mother_naturalized_month') == '05' ? 'selected' : '' }}>May</option>
                                    <option value="06" {{ old('mother_naturalized_month') == '06' ? 'selected' : '' }}>June</option>
                                    <option value="07" {{ old('mother_naturalized_month') == '07' ? 'selected' : '' }}>July</option>
                                    <option value="08" {{ old('mother_naturalized_month') == '08' ? 'selected' : '' }}>August</option>
                                    <option value="09" {{ old('mother_naturalized_month') == '09' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ old('mother_naturalized_month') == '10' ? 'selected' : '' }}>October</option>
                                    <option value="11" {{ old('mother_naturalized_month') == '11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ old('mother_naturalized_month') == '12' ? 'selected' : '' }}>December</option>
                                </select>
                                <input type="number" name="mother_naturalized_year" min="1900" max="2030" value="{{ old('mother_naturalized_year') }}" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Year">
                            </div>
                </div>
                <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 mt-2">Place of Naturalization</label>
                            <input type="text" name="mother_naturalized_place" value="{{ old('mother_naturalized_place') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of naturalization">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Brothers and Sisters -->
        <div class="bg-white shadow-lg rounded-2xl border border-gray-200 p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-[#1B365D]">Brothers and Sisters</h3>
            </div>
            <div id="siblings-container" class="space-y-4">
                <!-- Initial sibling entry (default, not removable) -->
                <div class="sibling-entry p-4 border border-gray-200 rounded-lg relative">
                    <!-- Name Details -->
                    <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-id-card mr-2 text-[#D4AF37]"></i>Name Details</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" name="siblings[0][first_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                            <input type="text" name="siblings[0][middle_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" name="siblings[0][last_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus-border-[#1B365D] transition-colors" placeholder="Enter last name">
                        </div>
                        <div></div>
                    </div>
                    <!-- Birth Information -->
                    <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                            <input type="date" name="siblings[0][date_of_birth]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        </div>
                        <div></div>
                    </div>
                    <!-- Employment -->
                    <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                            <input type="text" name="siblings[0][occupation]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                            <input type="text" name="siblings[0][employer]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Employer Address</label>
                            <input type="text" name="siblings[0][employer_address]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer address">
                        </div>
                    </div>
                    <!-- Address -->
                    <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                        <input type="text" name="siblings[0][complete_address]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
                    </div>
                    <!-- Citizenship -->
                    <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="siblings[0][citizenship]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Dual Citizenship (if any)</label>
                            <input type="text" name="siblings[0][dual_citizenship]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter dual citizenship">
                        </div>
                    </div>
                    <!-- Remove button for dynamic siblings (hidden for the first entry) -->
                    <button type="button" class="remove-sibling absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors hidden">
                        <i class="fas fa-times-circle"></i>
                    </button>
                </div>
                <!-- Sibling template for JS cloning -->
                <template id="sibling-template">
                    <div class="sibling-entry p-4 border border-gray-200 rounded-lg relative">
                        <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-id-card mr-2 text-[#D4AF37]"></i>Name Details</h4>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" name="siblings[__INDEX__][first_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                <input type="text" name="siblings[__INDEX__][middle_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" name="siblings[__INDEX__][last_name]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus-border-[#1B365D] transition-colors" placeholder="Enter last name">
                            </div>
                            <div></div>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" name="siblings[__INDEX__][date_of_birth]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                            </div>
                            <div></div>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                                <input type="text" name="siblings[__INDEX__][occupation]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                                <input type="text" name="siblings[__INDEX__][employer]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Employer Address</label>
                                <input type="text" name="siblings[__INDEX__][employer_address]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer address">
                            </div>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                            <input type="text" name="siblings[__INDEX__][complete_address]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
                        </div>
                        <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                                <input type="text" name="siblings[__INDEX__][citizenship]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter citizenship">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Dual Citizenship (if any)</label>
                                <input type="text" name="siblings[__INDEX__][dual_citizenship]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter dual citizenship">
                            </div>
                        </div>
                        <button type="button" class="remove-sibling absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors hidden">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                </template>
            </div>
            <button type="button" id="add-sibling" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Sibling
            </button>
        </div>
        <!-- Step Parent or Guardian -->
        <div class="bg-white shadow-lg rounded-2xl border border-gray-200 p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-user-shield text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-[#1B365D]">Step Parent or Guardian</h3>
            </div>
            <!-- Name Details -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-id-card mr-2 text-[#D4AF37]"></i>Name Details</h4>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="step_parent_guardian_first_name" value="{{ old('step_parent_guardian_first_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="step_parent_guardian_middle_name" value="{{ old('step_parent_guardian_middle_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="step_parent_guardian_last_name" value="{{ old('step_parent_guardian_last_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="step_parent_guardian_suffix" value="{{ old('step_parent_guardian_suffix') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Jr., Sr., III">
                </div>
            </div>
            <!-- Birth Information -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="step_parent_guardian_birth_date" value="{{ old('step_parent_guardian_birth_date') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="step_parent_guardian_birth_place" value="{{ old('step_parent_guardian_birth_place') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of birth">
                </div>
            </div>
            <!-- Employment -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="step_parent_guardian_occupation" value="{{ old('step_parent_guardian_occupation') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="step_parent_guardian_employer" value="{{ old('step_parent_guardian_employer') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="step_parent_guardian_place_of_employment" value="{{ old('step_parent_guardian_place_of_employment') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of employment">
                </div>
            </div>
            <!-- Address -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                <input type="text" name="step_parent_guardian_complete_address" value="{{ old('step_parent_guardian_complete_address') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
            </div>
            <!-- Citizenship -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
            <div class="mb-2 px-2 py-2 bg-blue-50 rounded text-xs text-blue-800 border border-blue-100">
                <strong>Instructions:</strong> Select the type of citizenship. If dual, write both citizenships. If naturalized, give date and place where naturalized.
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship Type</label>
                    <select name="step_parent_guardian_citizenship_type" id="step_parent_guardian_citizenship_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" onchange="toggleCitizenshipFields('step_parent_guardian')">
                        <option value="Single" {{ old('step_parent_guardian_citizenship_type') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Dual" {{ old('step_parent_guardian_citizenship_type') == 'Dual' ? 'selected' : '' }}>Dual</option>
                        <option value="Naturalized" {{ old('step_parent_guardian_citizenship_type') == 'Naturalized' ? 'selected' : '' }}>Naturalized</option>
                    </select>
                </div>
                <div id="step_parent_guardian_citizenship_single" class="citizenship-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="step_parent_guardian_citizenship" value="{{ old('step_parent_guardian_citizenship') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div id="step_parent_guardian_citizenship_dual" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 1</label>
                            <input type="text" name="step_parent_guardian_citizenship_dual_1" value="{{ old('step_parent_guardian_citizenship_dual_1') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 2</label>
                            <input type="text" name="step_parent_guardian_citizenship_dual_2" value="{{ old('step_parent_guardian_citizenship_dual_2') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter second citizenship">
                        </div>
                    </div>
                </div>
                <div id="step_parent_guardian_citizenship_naturalized" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="step_parent_guardian_citizenship_naturalized" value="{{ old('step_parent_guardian_citizenship_naturalized') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Naturalization (Month and Year)</label>
                            <div class="flex space-x-1">
                                <select name="step_parent_guardian_naturalized_month" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                    <option value="">Month</option>
                                    <option value="01" {{ old('step_parent_guardian_naturalized_month') == '01' ? 'selected' : '' }}>January</option>
                                    <option value="02" {{ old('step_parent_guardian_naturalized_month') == '02' ? 'selected' : '' }}>February</option>
                                    <option value="03" {{ old('step_parent_guardian_naturalized_month') == '03' ? 'selected' : '' }}>March</option>
                                    <option value="04" {{ old('step_parent_guardian_naturalized_month') == '04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{ old('step_parent_guardian_naturalized_month') == '05' ? 'selected' : '' }}>May</option>
                                    <option value="06" {{ old('step_parent_guardian_naturalized_month') == '06' ? 'selected' : '' }}>June</option>
                                    <option value="07" {{ old('step_parent_guardian_naturalized_month') == '07' ? 'selected' : '' }}>July</option>
                                    <option value="08" {{ old('step_parent_guardian_naturalized_month') == '08' ? 'selected' : '' }}>August</option>
                                    <option value="09" {{ old('step_parent_guardian_naturalized_month') == '09' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ old('step_parent_guardian_naturalized_month') == '10' ? 'selected' : '' }}>October</option>
                                    <option value="11" {{ old('step_parent_guardian_naturalized_month') == '11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ old('step_parent_guardian_naturalized_month') == '12' ? 'selected' : '' }}>December</option>
                                </select>
                                <input type="number" name="step_parent_guardian_naturalized_year" min="1900" max="2030" value="{{ old('step_parent_guardian_naturalized_year') }}" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Year">
                            </div>
                </div>
                <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 mt-2">Place of Naturalization</label>
                            <input type="text" name="step_parent_guardian_naturalized_place" value="{{ old('step_parent_guardian_naturalized_place') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of naturalization">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Father-in-law Information -->
        <div class="bg-white shadow-lg rounded-2xl border border-gray-200 p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-male text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-[#1B365D]">Father-in-law's Information</h3>
            </div>
            <!-- Name Details -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-id-card mr-2 text-[#D4AF37]"></i>Name Details</h4>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="father_in_law_first_name" value="{{ old('father_in_law_first_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="father_in_law_middle_name" value="{{ old('father_in_law_middle_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="father_in_law_last_name" value="{{ old('father_in_law_last_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="father_in_law_suffix" value="{{ old('father_in_law_suffix') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Jr., Sr., III">
                </div>
            </div>
            <!-- Birth Information -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="father_in_law_birth_date" value="{{ old('father_in_law_birth_date') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="father_in_law_birth_place" value="{{ old('father_in_law_birth_place') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of birth">
                </div>
            </div>
            <!-- Employment -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="father_in_law_occupation" value="{{ old('father_in_law_occupation') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="father_in_law_employer" value="{{ old('father_in_law_employer') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="father_in_law_place_of_employment" value="{{ old('father_in_law_place_of_employment') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of employment">
                </div>
            </div>
            <!-- Address -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                <input type="text" name="father_in_law_complete_address" value="{{ old('father_in_law_complete_address') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
            </div>
            <!-- Citizenship -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
            <div class="mb-2 px-2 py-2 bg-blue-50 rounded text-xs text-blue-800 border border-blue-100">
                <strong>Instructions:</strong> Select the type of citizenship. If dual, write both citizenships. If naturalized, give date and place where naturalized.
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship Type</label>
                    <select name="father_in_law_citizenship_type" id="father_in_law_citizenship_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" onchange="toggleCitizenshipFields('father_in_law')">
                        <option value="Single" {{ old('father_in_law_citizenship_type') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Dual" {{ old('father_in_law_citizenship_type') == 'Dual' ? 'selected' : '' }}>Dual</option>
                        <option value="Naturalized" {{ old('father_in_law_citizenship_type') == 'Naturalized' ? 'selected' : '' }}>Naturalized</option>
                    </select>
                </div>
                <div id="father_in_law_citizenship_single" class="citizenship-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="father_in_law_citizenship" value="{{ old('father_in_law_citizenship') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div id="father_in_law_citizenship_dual" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 1</label>
                            <input type="text" name="father_in_law_citizenship_dual_1" value="{{ old('father_in_law_citizenship_dual_1') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 2</label>
                            <input type="text" name="father_in_law_citizenship_dual_2" value="{{ old('father_in_law_citizenship_dual_2') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter second citizenship">
                        </div>
                    </div>
                </div>
                <div id="father_in_law_citizenship_naturalized" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="father_in_law_citizenship_naturalized" value="{{ old('father_in_law_citizenship_naturalized') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Naturalization (Month and Year)</label>
                            <div class="flex space-x-1">
                                <select name="father_in_law_naturalized_month" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                    <option value="">Month</option>
                                    <option value="01" {{ old('father_in_law_naturalized_month') == '01' ? 'selected' : '' }}>January</option>
                                    <option value="02" {{ old('father_in_law_naturalized_month') == '02' ? 'selected' : '' }}>February</option>
                                    <option value="03" {{ old('father_in_law_naturalized_month') == '03' ? 'selected' : '' }}>March</option>
                                    <option value="04" {{ old('father_in_law_naturalized_month') == '04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{ old('father_in_law_naturalized_month') == '05' ? 'selected' : '' }}>May</option>
                                    <option value="06" {{ old('father_in_law_naturalized_month') == '06' ? 'selected' : '' }}>June</option>
                                    <option value="07" {{ old('father_in_law_naturalized_month') == '07' ? 'selected' : '' }}>July</option>
                                    <option value="08" {{ old('father_in_law_naturalized_month') == '08' ? 'selected' : '' }}>August</option>
                                    <option value="09" {{ old('father_in_law_naturalized_month') == '09' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ old('father_in_law_naturalized_month') == '10' ? 'selected' : '' }}>October</option>
                                    <option value="11" {{ old('father_in_law_naturalized_month') == '11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ old('father_in_law_naturalized_month') == '12' ? 'selected' : '' }}>December</option>
                                </select>
                                <input type="number" name="father_in_law_naturalized_year" min="1900" max="2030" value="{{ old('father_in_law_naturalized_year') }}" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Year">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 mt-2">Place of Naturalization</label>
                            <input type="text" name="father_in_law_naturalized_place" value="{{ old('father_in_law_naturalized_place') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of naturalization">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mother in Law -->
        <div class="bg-white shadow-lg rounded-2xl border border-gray-200 p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-female text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-[#1B365D]">Mother-in-law's Information</h3>
            </div>
            <!-- Name Details -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-id-card mr-2 text-[#D4AF37]"></i>Name Details</h4>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="mother_in_law_first_name" value="{{ old('mother_in_law_first_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="mother_in_law_middle_name" value="{{ old('mother_in_law_middle_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="mother_in_law_last_name" value="{{ old('mother_in_law_last_name') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="mother_in_law_suffix" value="{{ old('mother_in_law_suffix') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Jr., Sr., III">
                </div>
            </div>
            <!-- Birth Information -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="mother_in_law_birth_date" value="{{ old('mother_in_law_birth_date') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="mother_in_law_birth_place" value="{{ old('mother_in_law_birth_place') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of birth">
                </div>
            </div>
            <!-- Employment -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="mother_in_law_occupation" value="{{ old('mother_in_law_occupation') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="mother_in_law_employer" value="{{ old('mother_in_law_employer') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="mother_in_law_place_of_employment" value="{{ old('mother_in_law_place_of_employment') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of employment">
                </div>
            </div>
            <!-- Address -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                <input type="text" name="mother_in_law_complete_address" value="{{ old('mother_in_law_complete_address') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
            </div>
            <!-- Citizenship -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
            <div class="mb-2 px-2 py-2 bg-blue-50 rounded text-xs text-blue-800 border border-blue-100">
                <strong>Instructions:</strong> Select the type of citizenship. If dual, write both citizenships. If naturalized, give date and place where naturalized.
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship Type</label>
                    <select name="mother_in_law_citizenship_type" id="mother_in_law_citizenship_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" onchange="toggleCitizenshipFields('mother_in_law')">
                        <option value="Single" {{ old('mother_in_law_citizenship_type') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Dual" {{ old('mother_in_law_citizenship_type') == 'Dual' ? 'selected' : '' }}>Dual</option>
                        <option value="Naturalized" {{ old('mother_in_law_citizenship_type') == 'Naturalized' ? 'selected' : '' }}>Naturalized</option>
                    </select>
                </div>
                <div id="mother_in_law_citizenship_single" class="citizenship-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="mother_in_law_citizenship" value="{{ old('mother_in_law_citizenship') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div id="mother_in_law_citizenship_dual" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 1</label>
                            <input type="text" name="mother_in_law_citizenship_dual_1" value="{{ old('mother_in_law_citizenship_dual_1') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 2</label>
                            <input type="text" name="mother_in_law_citizenship_dual_2" value="{{ old('mother_in_law_citizenship_dual_2') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter second citizenship">
                        </div>
                    </div>
                </div>
                <div id="mother_in_law_citizenship_naturalized" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="mother_in_law_citizenship_naturalized" value="{{ old('mother_in_law_citizenship_naturalized') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Naturalization (Month and Year)</label>
                            <div class="flex space-x-1">
                                <select name="mother_in_law_naturalized_month" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                    <option value="">Month</option>
                                    <option value="01" {{ old('mother_in_law_naturalized_month') == '01' ? 'selected' : '' }}>January</option>
                                    <option value="02" {{ old('mother_in_law_naturalized_month') == '02' ? 'selected' : '' }}>February</option>
                                    <option value="03" {{ old('mother_in_law_naturalized_month') == '03' ? 'selected' : '' }}>March</option>
                                    <option value="04" {{ old('mother_in_law_naturalized_month') == '04' ? 'selected' : '' }}>April</option>
                                    <option value="05" {{ old('mother_in_law_naturalized_month') == '05' ? 'selected' : '' }}>May</option>
                                    <option value="06" {{ old('mother_in_law_naturalized_month') == '06' ? 'selected' : '' }}>June</option>
                                    <option value="07" {{ old('mother_in_law_naturalized_month') == '07' ? 'selected' : '' }}>July</option>
                                    <option value="08" {{ old('mother_in_law_naturalized_month') == '08' ? 'selected' : '' }}>August</option>
                                    <option value="09" {{ old('mother_in_law_naturalized_month') == '09' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ old('mother_in_law_naturalized_month') == '10' ? 'selected' : '' }}>October</option>
                                    <option value="11" {{ old('mother_in_law_naturalized_month') == '11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ old('mother_in_law_naturalized_month') == '12' ? 'selected' : '' }}>December</option>
                                </select>
                                <input type="number" name="mother_in_law_naturalized_year" min="1900" max="2030" value="{{ old('mother_in_law_naturalized_year') }}" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Year">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 mt-2">Place of Naturalization</label>
                            <input type="text" name="mother_in_law_naturalized_place" value="{{ old('mother_in_law_naturalized_place') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of naturalization">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
            <button type="button" onclick="window.navigateToPreviousSection('family-background')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="submit" class="btn-primary">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

@if (request()->ajax())
    <script>
        if (typeof window.initializeFamilyBackground === 'function') {
            window.initializeFamilyBackground();
        }
    </script>
@endif 

<script>
function toggleCitizenshipFields(prefix) {
    const type = document.getElementById(prefix + '_citizenship_type').value;
    document.getElementById(prefix + '_citizenship_single').classList.add('hidden');
    document.getElementById(prefix + '_citizenship_dual').classList.add('hidden');
    document.getElementById(prefix + '_citizenship_naturalized').classList.add('hidden');
    if (type === 'Single') {
        document.getElementById(prefix + '_citizenship_single').classList.remove('hidden');
    } else if (type === 'Dual') {
        document.getElementById(prefix + '_citizenship_dual').classList.remove('hidden');
    } else if (type === 'Naturalized') {
        document.getElementById(prefix + '_citizenship_naturalized').classList.remove('hidden');
    }
}
document.addEventListener('DOMContentLoaded', function() {
    ['father','mother','step_parent_guardian','father_in_law','mother_in_law'].forEach(function(prefix) {
        if(document.getElementById(prefix + '_citizenship_type')) {
            toggleCitizenshipFields(prefix);
            document.getElementById(prefix + '_citizenship_type').addEventListener('change', function() {
                toggleCitizenshipFields(prefix);
            });
        }
    });

    // Sibling dynamic add/remove logic
    const siblingsContainer = document.getElementById('siblings-container');
    const siblingTemplate = document.getElementById('sibling-template');
    let siblingIndex = 1;
    document.getElementById('add-sibling').addEventListener('click', function() {
        const clone = document.importNode(siblingTemplate.content, true);
        const html = clone.firstElementChild.outerHTML.replace(/__INDEX__/g, siblingIndex);
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = html;
        const siblingEntry = tempDiv.firstElementChild;
        siblingEntry.querySelector('.remove-sibling').classList.remove('hidden');
        siblingEntry.querySelector('.remove-sibling').addEventListener('click', function() {
            siblingEntry.remove();
        });
        siblingsContainer.appendChild(siblingEntry);
        siblingIndex++;
    });
    // Remove button for initial sibling (should stay hidden)
    const initialRemoveBtn = siblingsContainer.querySelector('.sibling-entry .remove-sibling');
    if(initialRemoveBtn) initialRemoveBtn.classList.add('hidden');
});
</script>
<style>
.hidden { display: none; }
.citizenship-group.hidden { display: none; }
.citizenship-group input:not(:last-child) { margin-bottom: 0.5rem; }
</style> 