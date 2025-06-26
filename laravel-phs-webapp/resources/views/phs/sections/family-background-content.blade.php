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

    <form method="POST" action="{{ route('phs.family-background.store') }}" class="space-y-8">
        @csrf
        
        <!-- Father's Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-male mr-3 text-[#D4AF37]"></i>
                Father's Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="father_first_name" value="{{ old('father_first_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="father_middle_name" value="{{ old('father_middle_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="father_last_name" value="{{ old('father_last_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="father_suffix" value="{{ old('father_suffix') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="e.g., Jr., Sr., III">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="father_birth_date" value="{{ old('father_birth_date') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="father_birth_place" value="{{ old('father_birth_place') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of birth">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="father_occupation" value="{{ old('father_occupation') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="father_employer" value="{{ old('father_employer') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="father_place_of_employment" value="{{ old('father_place_of_employment') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of employment">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="father_citizenship" value="{{ old('father_citizenship') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                    <input type="text" name="father_complete_address" value="{{ old('father_complete_address') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
                </div>
            </div>
        </div>

        <!-- Mother's Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-female mr-3 text-[#D4AF37]"></i>
                Mother's Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="mother_first_name" value="{{ old('mother_first_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="mother_middle_name" value="{{ old('mother_middle_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="mother_last_name" value="{{ old('mother_last_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="mother_suffix" value="{{ old('mother_suffix') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="e.g., Jr., Sr., III">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="mother_birth_date" value="{{ old('mother_birth_date') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="mother_birth_place" value="{{ old('mother_birth_place') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of birth">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="mother_occupation" value="{{ old('mother_occupation') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="mother_employer" value="{{ old('mother_employer') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="mother_place_of_employment" value="{{ old('mother_place_of_employment') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of employment">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="mother_citizenship" value="{{ old('mother_citizenship') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                    <input type="text" name="mother_complete_address" value="{{ old('mother_complete_address') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
                </div>
            </div>
        </div>

        <!-- Brothers and Sisters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                    <i class="fas fa-users mr-3 text-[#D4AF37]"></i>
                    Brothers and Sisters
                </h3>
                <button type="button" onclick="addSibling()" class="btn-secondary">
                    <i class="fas fa-plus mr-2"></i> Add Sibling
                </button>
            </div>
            
            <div id="siblings-container" class="space-y-6">
                <!-- Siblings will be added here dynamically -->
            </div>
        </div>

        <!-- Step Parent or Guardian -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-shield mr-3 text-[#D4AF37]"></i>
                Step Parent or Guardian
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="step_parent_guardian_first_name" value="{{ old('step_parent_guardian_first_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="step_parent_guardian_middle_name" value="{{ old('step_parent_guardian_middle_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="step_parent_guardian_last_name" value="{{ old('step_parent_guardian_last_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="step_parent_guardian_suffix" value="{{ old('step_parent_guardian_suffix') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="e.g., Jr., Sr., III">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="step_parent_guardian_birth_date" value="{{ old('step_parent_guardian_birth_date') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="step_parent_guardian_birth_place" value="{{ old('step_parent_guardian_birth_place') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of birth">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="step_parent_guardian_occupation" value="{{ old('step_parent_guardian_occupation') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="step_parent_guardian_employer" value="{{ old('step_parent_guardian_employer') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="step_parent_guardian_place_of_employment" value="{{ old('step_parent_guardian_place_of_employment') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of employment">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="step_parent_guardian_citizenship" value="{{ old('step_parent_guardian_citizenship') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                    <input type="text" name="step_parent_guardian_complete_address" value="{{ old('step_parent_guardian_complete_address') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
                </div>
            </div>
        </div>

        <!-- Father in Law -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-male mr-3 text-[#D4AF37]"></i>
                Father in Law
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="father_in_law_first_name" value="{{ old('father_in_law_first_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="father_in_law_middle_name" value="{{ old('father_in_law_middle_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="father_in_law_last_name" value="{{ old('father_in_law_last_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="father_in_law_suffix" value="{{ old('father_in_law_suffix') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="e.g., Jr., Sr., III">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="father_in_law_birth_date" value="{{ old('father_in_law_birth_date') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="father_in_law_birth_place" value="{{ old('father_in_law_birth_place') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of birth">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="father_in_law_occupation" value="{{ old('father_in_law_occupation') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="father_in_law_employer" value="{{ old('father_in_law_employer') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="father_in_law_place_of_employment" value="{{ old('father_in_law_place_of_employment') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of employment">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="father_in_law_citizenship" value="{{ old('father_in_law_citizenship') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                    <input type="text" name="father_in_law_complete_address" value="{{ old('father_in_law_complete_address') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
                </div>
            </div>
        </div>

        <!-- Mother in Law -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-female mr-3 text-[#D4AF37]"></i>
                Mother in Law
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="mother_in_law_first_name" value="{{ old('mother_in_law_first_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="mother_in_law_middle_name" value="{{ old('mother_in_law_middle_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="mother_in_law_last_name" value="{{ old('mother_in_law_last_name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="mother_in_law_suffix" value="{{ old('mother_in_law_suffix') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="e.g., Jr., Sr., III">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="mother_in_law_birth_date" value="{{ old('mother_in_law_birth_date') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="mother_in_law_birth_place" value="{{ old('mother_in_law_birth_place') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of birth">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="mother_in_law_occupation" value="{{ old('mother_in_law_occupation') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="mother_in_law_employer" value="{{ old('mother_in_law_employer') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="mother_in_law_place_of_employment" value="{{ old('mother_in_law_place_of_employment') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter place of employment">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="mother_in_law_citizenship" value="{{ old('mother_in_law_citizenship') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                    <input type="text" name="mother_in_law_complete_address" value="{{ old('mother_in_law_complete_address') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('family-background')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'family-background')">
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