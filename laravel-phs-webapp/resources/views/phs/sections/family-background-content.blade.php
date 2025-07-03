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

    @php
        $isPersonnel = Auth::user() && Auth::user()->role === 'personnel';
        $formAction = $isPersonnel ? route('personnel.phs.family-background.store') : route('phs.family-background.store');
        $nextSectionRoute = $isPersonnel ? route('personnel.phs.educational-background') : route('phs.educational-background');
        $dashboardRoute = route('personnel.dashboard');
    @endphp

    <form method="POST" action="{{ $formAction }}" autocomplete="off" class="space-y-10" id="phs-form">
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
                    <input type="text" name="father_first_name" value="{{ old('father_first_name', $fatherName->first_name ?? '') }}" autocomplete="new-password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="father_middle_name" value="{{ old('father_middle_name', $fatherName->middle_name ?? '') }}" autocomplete="new-password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="father_last_name" value="{{ old('father_last_name', $fatherName->last_name ?? '') }}" autocomplete="new-password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="father_suffix" value="{{ old('father_suffix', $familyBackground->father_suffix ?? '') }}" autocomplete="new-password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Jr., Sr., III">
                </div>
            </div>
            <!-- Birth Information -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="father_birth_date" value="{{ old('father_birth_date', $family_members->get('father')->birth_date ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="father_birth_place" value="{{ old('father_birth_place', $family_members->get('father')->birth_place ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of birth">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="father_place_of_employment" value="{{ old('father_place_of_employment', $family_members->get('father')->place_of_employment ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of employment">
                </div>
            </div>
            <!-- Address -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                <input type="text" name="father_complete_address" value="{{ old('father_complete_address', $familyBackground->father_complete_address ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
            </div>
            <!-- Citizenship -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#D4AF37]"></i>Citizenship</h4>
            <div class="mb-2 px-2 py-2 bg-blue-50 rounded text-xs text-blue-800 border border-blue-100">
                <strong>Instructions:</strong> Select the type of citizenship. If dual, write both citizenships. If naturalized, give date and place where naturalized.
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship Type</label>
                    <select name="father_citizenship_type" id="father_citizenship_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" onchange="toggleCitizenshipFields('father')">
                        <option value="Single" {{ old('father_citizenship_type', $family_members->get('father')->citizenship_type ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Dual" {{ old('father_citizenship_type', $family_members->get('father')->citizenship_type ?? '') == 'Dual' ? 'selected' : '' }}>Dual</option>
                        <option value="Naturalized" {{ old('father_citizenship_type', $family_members->get('father')->citizenship_type ?? '') == 'Naturalized' ? 'selected' : '' }}>Naturalized</option>
                    </select>
                </div>
                <div id="father_citizenship_single" class="citizenship-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="father_citizenship" value="{{ old('father_citizenship', $family_members->get('father')->citizenship ?? '') }}" autocomplete="off" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div id="father_citizenship_dual" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 1</label>
                            <input type="text" name="father_citizenship_dual_1" value="{{ old('father_citizenship_dual_1', $familyBackground->father_other_citizenship ?? '') }}" autocomplete="off" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 2</label>
                            <input type="text" name="father_citizenship_dual_2" value="{{ old('father_citizenship_dual_2') }}" autocomplete="off" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter second citizenship">
                        </div>
                    </div>
                </div>
                <div id="father_citizenship_naturalized" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="father_citizenship_naturalized" value="{{ old('father_citizenship_naturalized') }}" autocomplete="off" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
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
                    <input type="text" name="mother_first_name" value="{{ old('mother_first_name', $motherName->first_name ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="mother_middle_name" value="{{ old('mother_middle_name', $motherName->middle_name ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="mother_last_name" value="{{ old('mother_last_name', $motherName->last_name ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="mother_suffix" value="{{ old('mother_suffix', $family_members->get('mother')->suffix ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Jr., Sr., III">
                </div>
            </div>
            <!-- Birth Information -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="mother_birth_date" value="{{ old('mother_birth_date', $family_members->get('mother')->birth_date ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="mother_birth_place" value="{{ old('mother_birth_place', $family_members->get('mother')->birth_place ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of birth">
                </div>
            </div>
            <!-- Employment -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="mother_occupation" value="{{ old('mother_occupation', $family_members->get('mother')->occupation ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="mother_employer" value="{{ old('mother_employer', $family_members->get('mother')->employer ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="mother_place_of_employment" value="{{ old('mother_place_of_employment', $family_members->get('mother')->place_of_employment ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of employment">
                </div>
            </div>
            <!-- Address -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                <input type="text" name="mother_complete_address" value="{{ old('mother_complete_address', $family_members->get('mother')->complete_address ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
            </div>
            <!-- Citizenship -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
            <div class="mb-2 px-2 py-2 bg-blue-50 rounded text-xs text-blue-800 border border-blue-100">
                <strong>Instructions:</strong> Select the type of citizenship. If dual, write both citizenships. If naturalized, give date and place where naturalized.
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Mother's Information Citizenship Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship Type</label>
                    <select name="mother_citizenship_type" id="mother_citizenship_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" onchange="toggleCitizenshipFields('mother')">
                        <option value="Single" {{ old('mother_citizenship_type', $family_members->get('mother')->citizenship_type ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Dual" {{ old('mother_citizenship_type', $family_members->get('mother')->citizenship_type ?? '') == 'Dual' ? 'selected' : '' }}>Dual</option>
                        <option value="Naturalized" {{ old('mother_citizenship_type', $family_members->get('mother')->citizenship_type ?? '') == 'Naturalized' ? 'selected' : '' }}>Naturalized</option>
                    </select>
                </div>
                <div id="mother_citizenship_single" class="citizenship-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                    <input type="text" name="mother_citizenship" value="{{ old('mother_citizenship', $family_members->get('mother')->citizenship ?? '') }}" autocomplete="off" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div id="mother_citizenship_dual" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 1</label>
                            <input type="text" name="mother_citizenship_dual_1" value="{{ old('mother_citizenship_dual_1', $family_members->get('mother')->citizenship_dual_1 ?? '') }}" autocomplete="off" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 2</label>
                            <input type="text" name="mother_citizenship_dual_2" value="{{ old('mother_citizenship_dual_2', $family_members->get('mother')->citizenship_dual_2 ?? '') }}" autocomplete="off" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter second citizenship">
                        </div>
                    </div>
                </div>
                <div id="mother_citizenship_naturalized" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="mother_citizenship_naturalized" value="{{ old('mother_citizenship_naturalized', $family_members->get('mother')->citizenship_naturalized ?? '') }}" autocomplete="off" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Naturalization (Month and Year)</label>
                            <div class="flex space-x-1">
                                <select name="mother_naturalized_month" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                    <option value="">Month</option>
                                    @foreach ([
                                        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                                        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                                        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                                    ] as $num => $month)
                                        <option value="{{ $num }}" {{ old('mother_naturalized_month', $family_members->get('mother')->naturalized_month ?? '') == $num ? 'selected' : '' }}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="mother_naturalized_year" min="1900" max="2030" value="{{ old('mother_naturalized_year', $family_members->get('mother')->naturalized_year ?? '') }}" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Year">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 mt-2">Place of Naturalization</label>
                            <input type="text" name="mother_naturalized_place" value="{{ old('mother_naturalized_place', $family_members->get('mother')->naturalized_place ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of naturalization">
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
            <div id="siblings-container">
                @if($siblings->count() > 0)
                    @foreach($siblings as $index => $sibling)
                        <div class="sibling-entry p-4 border border-gray-200 rounded-lg relative">
                            <!-- Name Details -->
                            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-id-card mr-2 text-[#D4AF37]"></i>Name Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" name="siblings[{{ $index }}][first_name]" value="{{ old('siblings.'.$index.'.first_name', $sibling->first_name ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                    <input type="text" name="siblings[{{ $index }}][middle_name]" value="{{ old('siblings.'.$index.'.middle_name', $sibling->middle_name ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" name="siblings[{{ $index }}][last_name]" value="{{ old('siblings.'.$index.'.last_name', $sibling->last_name ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                                </div>
                                <div></div>
                            </div>
                            <!-- Birth Information -->
                            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                    <input type="date" name="siblings[{{ $index }}][date_of_birth]" value="{{ old('siblings.'.$index.'.date_of_birth', isset($sibling->date_of_birth) ? (\Illuminate\Support\Str::length($sibling->date_of_birth) === 10 ? $sibling->date_of_birth : (new \Carbon\Carbon($sibling->date_of_birth))->format('Y-m-d')) : '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                </div>
                                <div></div>
                            </div>
                            <!-- Employment -->
                            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                                    <input type="text" name="siblings[{{ $index }}][occupation]" value="{{ old('siblings.'.$index.'.occupation', $sibling->occupation ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                                    <input type="text" name="siblings[{{ $index }}][employer]" value="{{ old('siblings.'.$index.'.employer', $sibling->employer ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer Address</label>
                                    <input type="text" name="siblings[{{ $index }}][employer_address]" value="{{ old('siblings.'.$index.'.employer_address', $sibling->employer_address ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer address">
                                </div>
                            </div>
                            <!-- Address -->
                            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                                <input type="text" name="siblings[{{ $index }}][complete_address]" value="{{ old('siblings.'.$index.'.complete_address', $sibling->complete_address ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
                            </div>
                            <!-- Citizenship -->
                            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                                    <input type="text" name="siblings[{{ $index }}][citizenship]" value="{{ old('siblings.'.$index.'.citizenship', $sibling->citizenship ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter citizenship">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dual Citizenship (if any)</label>
                                    <input type="text" name="siblings[{{ $index }}][dual_citizenship]" value="{{ old('siblings.'.$index.'.dual_citizenship', $sibling->dual_citizenship ?? '') }}" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter dual citizenship">
                                </div>
                            </div>
                            <!-- Remove button for dynamic siblings (hidden for the first entry) -->
                            <button type="button" class="remove-sibling absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors {{ $index === 0 ? 'hidden' : '' }}">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </div>
                    @endforeach
                @else
                    <template id="sibling-template">
                        <div class="sibling-entry p-4 border border-gray-200 rounded-lg relative">
                            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-id-card mr-2 text-[#D4AF37]"></i>Name Details</h4>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" name="siblings[__INDEX__][first_name]" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                    <input type="text" name="siblings[__INDEX__][middle_name]" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" name="siblings[__INDEX__][last_name]" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
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
                                    <input type="text" name="siblings[__INDEX__][occupation]" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                                    <input type="text" name="siblings[__INDEX__][employer]" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer Address</label>
                                    <input type="text" name="siblings[__INDEX__][employer_address]" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer address">
                                </div>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                                <input type="text" name="siblings[__INDEX__][complete_address]" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
                            </div>
                            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                                    <input type="text" name="siblings[__INDEX__][citizenship]" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter citizenship">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dual Citizenship (if any)</label>
                                    <input type="text" name="siblings[__INDEX__][dual_citizenship]" autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter dual citizenship">
                                </div>
                            </div>
                            <!-- Remove button for all siblings (visibility controlled by JS) -->
                            <button type="button" class="remove-sibling absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </div>
                    </template>
                @endif
            </div>
            <button type="button" onclick="window.addSibling()" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium flex items-center">
                <i class="fas fa-plus mr-1"></i> Add Sibling
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
                    <input type="text" name="step_parent_guardian_first_name" value="{{ old('step_parent_guardian_first_name', $stepParentGuardianName->first_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="step_parent_guardian_middle_name" value="{{ old('step_parent_guardian_middle_name', $stepParentGuardianName->middle_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="step_parent_guardian_last_name" value="{{ old('step_parent_guardian_last_name', $stepParentGuardianName->last_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="step_parent_guardian_suffix" value="{{ old('step_parent_guardian_suffix', $family_members->get('step_parent_guardian')->suffix ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Jr., Sr., III">
                </div>
            </div>
            <!-- Birth Information -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="step_parent_guardian_birth_date" value="{{ old('step_parent_guardian_birth_date', $family_members->get('step_parent_guardian')->birth_date ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="step_parent_guardian_birth_place" value="{{ old('step_parent_guardian_birth_place', $family_members->get('step_parent_guardian')->birth_place ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of birth">
                </div>
            </div>
            <!-- Employment -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="step_parent_guardian_occupation" value="{{ old('step_parent_guardian_occupation', $family_members->get('step_parent_guardian')->occupation ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="step_parent_guardian_employer" value="{{ old('step_parent_guardian_employer', $family_members->get('step_parent_guardian')->employer ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="step_parent_guardian_place_of_employment" value="{{ old('step_parent_guardian_place_of_employment', $family_members->get('step_parent_guardian')->place_of_employment ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of employment">
                </div>
            </div>
            <!-- Address -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                <input type="text" name="step_parent_guardian_complete_address" value="{{ old('step_parent_guardian_complete_address', $family_members->get('step_parent_guardian')->complete_address ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
            </div>
            <!-- Citizenship -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
            <div class="mb-2 px-2 py-2 bg-blue-50 rounded text-xs text-blue-800 border border-blue-100">
                <strong>Instructions:</strong> Select the type of citizenship. If dual, write both citizenships. If naturalized, give date and place where naturalized.
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Step Parent or Guardian Citizenship Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship Type</label>
                    <select name="step_parent_guardian_citizenship_type" id="step_parent_guardian_citizenship_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" onchange="toggleCitizenshipFields('step_parent_guardian')">
                        <option value="Single" {{ old('step_parent_guardian_citizenship_type', $family_members->get('step_parent_guardian')->citizenship_type ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Dual" {{ old('step_parent_guardian_citizenship_type', $family_members->get('step_parent_guardian')->citizenship_type ?? '') == 'Dual' ? 'selected' : '' }}>Dual</option>
                        <option value="Naturalized" {{ old('step_parent_guardian_citizenship_type', $family_members->get('step_parent_guardian')->citizenship_type ?? '') == 'Naturalized' ? 'selected' : '' }}>Naturalized</option>
                    </select>
                </div>
                <div id="step_parent_guardian_citizenship_single" class="citizenship-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Guardian Citizenship</label>
                    <input type="text" name="step_parent_guardian_citizenship" value="{{ old('step_parent_guardian_citizenship', $family_members->get('step_parent_guardian')->citizenship ?? '') }}" autocomplete="off" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div id="step_parent_guardian_citizenship_dual" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 1</label>
                            <input type="text" name="step_parent_guardian_citizenship_dual_1" value="{{ old('step_parent_guardian_citizenship_dual_1', $family_members->get('step_parent_guardian')->citizenship_dual_1 ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 2</label>
                            <input type="text" name="step_parent_guardian_citizenship_dual_2" value="{{ old('step_parent_guardian_citizenship_dual_2', $family_members->get('step_parent_guardian')->citizenship_dual_2 ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter second citizenship">
                        </div>
                    </div>
                </div>
                <div id="step_parent_guardian_citizenship_naturalized" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="step_parent_guardian_citizenship_naturalized" value="{{ old('step_parent_guardian_citizenship_naturalized', $family_members->get('step_parent_guardian')->citizenship_naturalized ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Naturalization (Month and Year)</label>
                            <div class="flex space-x-1">
                                <select name="step_parent_guardian_naturalized_month" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                    <option value="">Month</option>
                                    @foreach ([
                                        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                                        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                                        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                                    ] as $num => $month)
                                        <option value="{{ $num }}" {{ old('step_parent_guardian_naturalized_month', $family_members->get('step_parent_guardian')->naturalized_month ?? '') == $num ? 'selected' : '' }}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="step_parent_guardian_naturalized_year" min="1900" max="2030" value="{{ old('step_parent_guardian_naturalized_year', $family_members->get('step_parent_guardian')->naturalized_year ?? '') }}" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Year">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 mt-2">Place of Naturalization</label>
                            <input type="text" name="step_parent_guardian_naturalized_place" value="{{ old('step_parent_guardian_naturalized_place', $family_members->get('step_parent_guardian')->naturalized_place ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of naturalization">
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
                    <input type="text" name="father_in_law_first_name" value="{{ old('father_in_law_first_name', $fatherInLawName->first_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="father_in_law_middle_name" value="{{ old('father_in_law_middle_name', $fatherInLawName->middle_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="father_in_law_last_name" value="{{ old('father_in_law_last_name', $fatherInLawName->last_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="father_in_law_suffix" value="{{ old('father_in_law_suffix', $family_members->get('father_in_law')->suffix ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Jr., Sr., III">
                </div>
            </div>
            <!-- Birth Information -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="father_in_law_birth_date" value="{{ old('father_in_law_birth_date', $family_members->get('father_in_law')->birth_date ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="father_in_law_birth_place" value="{{ old('father_in_law_birth_place', $family_members->get('father_in_law')->birth_place ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of birth">
                </div>
            </div>
            <!-- Employment -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="father_in_law_occupation" value="{{ old('father_in_law_occupation', $family_members->get('father_in_law')->occupation ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="father_in_law_employer" value="{{ old('father_in_law_employer', $family_members->get('father_in_law')->employer ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="father_in_law_place_of_employment" value="{{ old('father_in_law_place_of_employment', $family_members->get('father_in_law')->place_of_employment ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of employment">
                </div>
            </div>
            <!-- Address -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                <input type="text" name="father_in_law_complete_address" value="{{ old('father_in_law_complete_address', $family_members->get('father_in_law')->complete_address ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
            </div>
            <!-- Citizenship -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
            <div class="mb-2 px-2 py-2 bg-blue-50 rounded text-xs text-blue-800 border border-blue-100">
                <strong>Instructions:</strong> Select the type of citizenship. If dual, write both citizenships. If naturalized, give date and place where naturalized.
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Father-in-law Citizenship Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship Type</label>
                    <select name="father_in_law_citizenship_type" id="father_in_law_citizenship_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" onchange="toggleCitizenshipFields('father_in_law')">
                        <option value="Single" {{ old('father_in_law_citizenship_type', $family_members->get('father_in_law')->citizenship_type ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Dual" {{ old('father_in_law_citizenship_type', $family_members->get('father_in_law')->citizenship_type ?? '') == 'Dual' ? 'selected' : '' }}>Dual</option>
                        <option value="Naturalized" {{ old('father_in_law_citizenship_type', $family_members->get('father_in_law')->citizenship_type ?? '') == 'Naturalized' ? 'selected' : '' }}>Naturalized</option>
                    </select>
                </div>
                <div id="father_in_law_citizenship_single" class="citizenship-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Father-in-law Citizenship</label>
                    <input type="text" name="father_in_law_citizenship" value="{{ old('father_in_law_citizenship', $family_members->get('father_in_law')->citizenship ?? '') }}" autocomplete="off" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div id="father_in_law_citizenship_dual" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 1</label>
                            <input type="text" name="father_in_law_citizenship_dual_1" value="{{ old('father_in_law_citizenship_dual_1', $family_members->get('father_in_law')->citizenship_dual_1 ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 2</label>
                            <input type="text" name="father_in_law_citizenship_dual_2" value="{{ old('father_in_law_citizenship_dual_2', $family_members->get('father_in_law')->citizenship_dual_2 ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter second citizenship">
                        </div>
                    </div>
                </div>
                <div id="father_in_law_citizenship_naturalized" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="father_in_law_citizenship_naturalized" value="{{ old('father_in_law_citizenship_naturalized', $family_members->get('father_in_law')->citizenship_naturalized ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Naturalization (Month and Year)</label>
                            <div class="flex space-x-1">
                                <select name="father_in_law_naturalized_month" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                    <option value="">Month</option>
                                    @foreach ([
                                        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                                        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                                        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                                    ] as $num => $month)
                                        <option value="{{ $num }}" {{ old('father_in_law_naturalized_month', $family_members->get('father_in_law')->naturalized_month ?? '') == $num ? 'selected' : '' }}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="father_in_law_naturalized_year" min="1900" max="2030" value="{{ old('father_in_law_naturalized_year', $family_members->get('father_in_law')->naturalized_year ?? '') }}" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Year">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 mt-2">Place of Naturalization</label>
                            <input type="text" name="father_in_law_naturalized_place" value="{{ old('father_in_law_naturalized_place', $family_members->get('father_in_law')->naturalized_place ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of naturalization">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mother-in-law Information -->
        <div class="bg-white shadow-lg rounded-2xl border border-gray-200 p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-female text-pink-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-[#1B365D]">Mother-in-law's Information</h3>
            </div>
            <!-- Name Details -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-id-card mr-2 text-[#D4AF37]"></i>Name Details</h4>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="mother_in_law_first_name" value="{{ old('mother_in_law_first_name', $motherInLawName->first_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter first name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                    <input type="text" name="mother_in_law_middle_name" value="{{ old('mother_in_law_middle_name', $motherInLawName->middle_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter middle name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="mother_in_law_last_name" value="{{ old('mother_in_law_last_name', $motherInLawName->last_name ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter last name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                    <input type="text" name="mother_in_law_suffix" value="{{ old('mother_in_law_suffix', $family_members->get('mother_in_law')->suffix ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Jr., Sr., III">
                </div>
            </div>
            <!-- Birth Information -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-birthday-cake mr-2 text-[#D4AF37]"></i>Birth Information</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                    <input type="date" name="mother_in_law_birth_date" value="{{ old('mother_in_law_birth_date', $family_members->get('mother_in_law')->birth_date ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                    <input type="text" name="mother_in_law_birth_place" value="{{ old('mother_in_law_birth_place', $family_members->get('mother_in_law')->birth_place ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of birth">
                </div>
            </div>
            <!-- Employment -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-briefcase mr-2 text-[#D4AF37]"></i>Employment</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                    <input type="text" name="mother_in_law_occupation" value="{{ old('mother_in_law_occupation', $family_members->get('mother_in_law')->occupation ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter occupation">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                    <input type="text" name="mother_in_law_employer" value="{{ old('mother_in_law_employer', $family_members->get('mother_in_law')->employer ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter employer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                    <input type="text" name="mother_in_law_place_of_employment" value="{{ old('mother_in_law_place_of_employment', $family_members->get('mother_in_law')->place_of_employment ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of employment">
                </div>
            </div>
            <!-- Address -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-map-marker-alt mr-2 text-[#D4AF37]"></i>Address</h4>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Complete Address</label>
                <input type="text" name="mother_in_law_complete_address" value="{{ old('mother_in_law_complete_address', $family_members->get('mother_in_law')->complete_address ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter complete address">
            </div>
            <!-- Citizenship -->
            <h4 class="text-lg font-semibold text-gray-700 mb-4 flex items-center"><i class="fas fa-passport mr-2 text-[#1B365D]"></i>Citizenship</h4>
            <div class="mb-2 px-2 py-2 bg-blue-50 rounded text-xs text-blue-800 border border-blue-100">
                <strong>Instructions:</strong> Select the type of citizenship. If dual, write both citizenships. If naturalized, give date and place where naturalized.
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Mother-in-law Citizenship Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship Type</label>
                    <select name="mother_in_law_citizenship_type" id="mother_in_law_citizenship_type" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" onchange="toggleCitizenshipFields('mother_in_law')">
                        <option value="Single" {{ old('mother_in_law_citizenship_type', $family_members->get('mother_in_law')->citizenship_type ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Dual" {{ old('mother_in_law_citizenship_type', $family_members->get('mother_in_law')->citizenship_type ?? '') == 'Dual' ? 'selected' : '' }}>Dual</option>
                        <option value="Naturalized" {{ old('mother_in_law_citizenship_type', $family_members->get('mother_in_law')->citizenship_type ?? '') == 'Naturalized' ? 'selected' : '' }}>Naturalized</option>
                    </select>
                </div>
                <div id="mother_in_law_citizenship_single" class="citizenship-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mother-in-law Citizenship</label>
                    <input type="text" name="mother_in_law_citizenship" value="{{ old('mother_in_law_citizenship', $family_members->get('mother_in_law')->citizenship ?? '') }}" autocomplete="off" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                </div>
                <div id="mother_in_law_citizenship_dual" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 1</label>
                            <input type="text" name="mother_in_law_citizenship_dual_1" value="{{ old('mother_in_law_citizenship_dual_1', $family_members->get('mother_in_law')->citizenship_dual_1 ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter first citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship 2</label>
                            <input type="text" name="mother_in_law_citizenship_dual_2" value="{{ old('mother_in_law_citizenship_dual_2', $family_members->get('mother_in_law')->citizenship_dual_2 ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter second citizenship">
                        </div>
                    </div>
                </div>
                <div id="mother_in_law_citizenship_naturalized" class="citizenship-group hidden md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                            <input type="text" name="mother_in_law_citizenship_naturalized" value="{{ old('mother_in_law_citizenship_naturalized', $family_members->get('mother_in_law')->citizenship_naturalized ?? '') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter citizenship">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Naturalization (Month and Year)</label>
                            <div class="flex space-x-1">
                                <select name="mother_in_law_naturalized_month" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                    <option value="">Month</option>
                                    @foreach ([
                                        '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                                        '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                                        '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                                    ] as $num => $month)
                                        <option value="{{ $num }}" {{ old('mother_in_law_naturalized_month', $family_members->get('mother_in_law')->naturalized_month ?? '') == $num ? 'selected' : '' }}>{{ $month }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="mother_in_law_naturalized_year" min="1900" max="2030" value="{{ old('mother_in_law_naturalized_year', $family_members->get('mother_in_law')->naturalized_year ?? '') }}" class="w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Year">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2 mt-2">Place of Naturalization</label>
                            <input type="text" name="mother_in_law_naturalized_place" value="{{ old('mother_in_law_naturalized_place', $family_members->get('mother_in_law')->naturalized_place ?? '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter place of naturalization">
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
            <button type="submit" class="btn-primary" formaction="{{ route('personnel.phs.educational-background') }}">
                Save & Continue
                <i class="fas fa-arrow-right ml-2"></i>
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

<style>
.hidden { display: none; }
.citizenship-group.hidden { display: none; }
.citizenship-group input:not(:last-child) { margin-bottom: 0.5rem; }
</style> 