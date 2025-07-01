@php
    $isPersonnel = Auth::user() && Auth::user()->role === 'personnel';
    $formAction = $isPersonnel ? route('personnel.phs.educational-background.store') : route('phs.educational-background.store');
    $nextSectionRoute = $isPersonnel ? route('personnel.phs.military-history') : route('phs.military-history.create');
@endphp

<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-graduation-cap text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Educational Background</h1>
                <p class="text-gray-600">Please provide your educational history</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ $formAction }}" class="space-y-8">
        @csrf
        
        <!-- Elementary Education -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-school mr-3 text-[#D4AF37]"></i>
                Elementary Education
            </h3>
            <div id="elementary-container" class="space-y-4">
                <!-- Initial elementary entry -->
                <div class="elementary-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Name
                            </label>
                            <input type="text" name="elementary[0][school]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter school name"
                                   value="{{ old('elementary.0.school', $educationalBackground->elementary_school ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Address
                            </label>
                            <input type="text" name="elementary[0][address]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter school address"
                                   value="{{ old('elementary.0.address', $educationalBackground->elementary_address ?? '') }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Started
                            </label>
                            <input type="number" name="elementary[0][start]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY"
                                   value="{{ old('elementary.0.start', $educationalBackground->elementary_period_from ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Graduated
                            </label>
                            <input type="number" name="elementary[0][graduate]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY"
                                   value="{{ old('elementary.0.graduate', $educationalBackground->elementary_year_graduated ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-elementary" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Elementary School
            </button>
        </div>

        <!-- High School Education -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-university mr-3 text-[#D4AF37]"></i>
                High School Education
            </h3>
            <div id="highschool-container" class="space-y-4">
                <!-- Initial high school entry -->
                <div class="highschool-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Name
                            </label>
                            <input type="text" name="highschool[0][school]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter school name"
                                   value="{{ old('highschool.0.school', $educationalBackground->high_school_school ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Address
                            </label>
                            <input type="text" name="highschool[0][address]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter school address"
                                   value="{{ old('highschool.0.address', $educationalBackground->high_school_address ?? '') }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Started
                            </label>
                            <input type="number" name="highschool[0][start]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY"
                                   value="{{ old('highschool.0.start', $educationalBackground->high_school_period_from ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Graduated
                            </label>
                            <input type="number" name="highschool[0][graduate]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY"
                                   value="{{ old('highschool.0.graduate', $educationalBackground->high_school_year_graduated ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-highschool" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another High School
            </button>
        </div>

        <!-- College Education -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-graduation-cap mr-3 text-[#D4AF37]"></i>
                College Education
            </h3>
            <div id="college-container" class="space-y-4">
                <!-- Initial college entry -->
                <div class="college-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Name
                            </label>
                            <input type="text" name="college[0][school]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter school name"
                                   value="{{ old('college.0.school', $educationalBackground->college_school ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Address
                            </label>
                            <input type="text" name="college[0][address]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter school address"
                                   value="{{ old('college.0.address', $educationalBackground->college_address ?? '') }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Course/Degree
                            </label>
                            <input type="text" name="college[0][course]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="e.g., Bachelor of Science in Computer Science"
                                   value="{{ old('college.0.course', $educationalBackground->college_degree ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Level
                            </label>
                            <select name="college[0][year_level]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                <option value="">Select Year Level</option>
                                <option value="1st Year" {{ old('college.0.year_level', $educationalBackground->college_highest_level ?? '') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                                <option value="2nd Year" {{ old('college.0.year_level', $educationalBackground->college_highest_level ?? '') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                                <option value="3rd Year" {{ old('college.0.year_level', $educationalBackground->college_highest_level ?? '') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                                <option value="4th Year" {{ old('college.0.year_level', $educationalBackground->college_highest_level ?? '') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                                <option value="5th Year" {{ old('college.0.year_level', $educationalBackground->college_highest_level ?? '') == '5th Year' ? 'selected' : '' }}>5th Year</option>
                                <option value="Graduated" {{ old('college.0.year_level', $educationalBackground->college_highest_level ?? '') == 'Graduated' ? 'selected' : '' }}>Graduated</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Started
                            </label>
                            <input type="number" name="college[0][start]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY"
                                   value="{{ old('college.0.start', $educationalBackground->college_period_from ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Graduated
                            </label>
                            <input type="number" name="college[0][graduate]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY"
                                   value="{{ old('college.0.graduate', $educationalBackground->college_year_graduated ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-college" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another College
            </button>
        </div>

        <!-- Post Graduate Studies -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-graduate mr-3 text-[#D4AF37]"></i>
                Post Graduate Studies
            </h3>
            <div id="postgraduate-container" class="space-y-4">
                <!-- Initial postgraduate entry -->
                <div class="postgraduate-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Name
                            </label>
                            <input type="text" name="postgraduate[0][school]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter school name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Address
                            </label>
                            <input type="text" name="postgraduate[0][address]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter school address">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Started
                            </label>
                            <input type="number" name="postgraduate[0][start]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Graduated
                            </label>
                            <input type="number" name="postgraduate[0][graduate]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-postgraduate" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Postgraduate
            </button>
        </div>

        <!-- Other Schools/Training Attended Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-certificate mr-3 text-[#D4AF37]"></i>
                Other Schools/Training Attended and Date of Attendance
            </h3>
            <div>
                <textarea name="other_schools_training" rows="6"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors resize-none"
                          placeholder="Please provide details of other schools or training programs attended, including dates of attendance, institution names, and any certificates or qualifications obtained."></textarea>
            </div>
        </div>

        <!-- Civil Service and Other Qualifications Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-award mr-3 text-[#D4AF37]"></i>
                Civil Service and Other Qualifications
            </h3>
            <div>
                <textarea name="civil_service_qualifications" rows="6"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors resize-none"
                          placeholder="Please provide details of civil service examinations taken, dates, ratings, and any other professional qualifications or certifications acquired."></textarea>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('educational-background')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Previous Section
            </button>
            <button type="submit" class="btn-primary" formaction="{{ $nextSectionRoute }}">
                Save & Continue
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

@if (request()->ajax())
    <script>
        if (typeof window.initializeEducationalBackground === 'function') {
            window.initializeEducationalBackground();
        }
    </script>
@endif 