@extends('layouts.phs-new')

@section('title', 'V: Educational Background')

@section('content')
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
    <form method="POST" action="{{ route('phs.educational-background.store') }}" class="space-y-8" x-data="educationalBackgroundForm()">
        @csrf
        
        <!-- Elementary Education -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-school mr-3 text-[#D4AF37]"></i>
                Elementary Education
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="elementary_school" class="block text-sm font-medium text-gray-700 mb-2">
                        School Name
                    </label>
                    <input type="text" name="elementary_school" id="elementary_school"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school name"
                           x-model="elementary.school">
                </div>
                <div>
                    <label for="elementary_address" class="block text-sm font-medium text-gray-700 mb-2">
                        School Address
                    </label>
                    <input type="text" name="elementary_address" id="elementary_address"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school address"
                           x-model="elementary.address">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div>
                    <label for="elementary_start" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Started
                    </label>
                    <input type="number" name="elementary_start" id="elementary_start" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY"
                           x-model="elementary.start">
                </div>
                <div>
                    <label for="elementary_graduate" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Graduated
                    </label>
                    <input type="number" name="elementary_graduate" id="elementary_graduate" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY"
                           x-model="elementary.graduate">
                </div>
                <div>
                    <label for="elementary_honors" class="block text-sm font-medium text-gray-700 mb-2">
                        Honors/Awards
                    </label>
                    <input type="text" name="elementary_honors" id="elementary_honors"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Valedictorian, Salutatorian"
                           x-model="elementary.honors">
                </div>
            </div>
        </div>

        <!-- High School Education -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-university mr-3 text-[#D4AF37]"></i>
                High School Education
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="highschool_school" class="block text-sm font-medium text-gray-700 mb-2">
                        School Name
                    </label>
                    <input type="text" name="highschool_school" id="highschool_school"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school name"
                           x-model="highschool.school">
                </div>
                <div>
                    <label for="highschool_address" class="block text-sm font-medium text-gray-700 mb-2">
                        School Address
                    </label>
                    <input type="text" name="highschool_address" id="highschool_address"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school address"
                           x-model="highschool.address">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div>
                    <label for="highschool_start" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Started
                    </label>
                    <input type="number" name="highschool_start" id="highschool_start" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY"
                           x-model="highschool.start">
                </div>
                <div>
                    <label for="highschool_graduate" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Graduated
                    </label>
                    <input type="number" name="highschool_graduate" id="highschool_graduate" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY"
                           x-model="highschool.graduate">
                </div>
                <div>
                    <label for="highschool_honors" class="block text-sm font-medium text-gray-700 mb-2">
                        Honors/Awards
                    </label>
                    <input type="text" name="highschool_honors" id="highschool_honors"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Valedictorian, Salutatorian"
                           x-model="highschool.honors">
                </div>
            </div>
        </div>

        <!-- College Education -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-graduation-cap mr-3 text-[#D4AF37]"></i>
                College Education
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="college_school" class="block text-sm font-medium text-gray-700 mb-2">
                        School Name
                    </label>
                    <input type="text" name="college_school" id="college_school"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school name"
                           x-model="college.school">
                </div>
                <div>
                    <label for="college_address" class="block text-sm font-medium text-gray-700 mb-2">
                        School Address
                    </label>
                    <input type="text" name="college_address" id="college_address"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school address"
                           x-model="college.address">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="college_course" class="block text-sm font-medium text-gray-700 mb-2">
                        Course/Degree
                    </label>
                    <input type="text" name="college_course" id="college_course"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Bachelor of Science in Computer Science"
                           x-model="college.course">
                </div>
                <div>
                    <label for="college_year_level" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Level
                    </label>
                    <select name="college_year_level" id="college_year_level"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                            x-model="college.year_level">
                        <option value="">Select Year Level</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                        <option value="5th Year">5th Year</option>
                        <option value="Graduated">Graduated</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div>
                    <label for="college_start" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Started
                    </label>
                    <input type="number" name="college_start" id="college_start" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY"
                           x-model="college.start">
                </div>
                <div>
                    <label for="college_graduate" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Graduated
                    </label>
                    <input type="number" name="college_graduate" id="college_graduate" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY"
                           x-model="college.graduate">
                </div>
                <div>
                    <label for="college_honors" class="block text-sm font-medium text-gray-700 mb-2">
                        Honors/Awards
                    </label>
                    <input type="text" name="college_honors" id="college_honors"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Cum Laude, Magna Cum Laude"
                           x-model="college.honors">
                </div>
            </div>
        </div>

        <!-- Graduate Studies Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-graduate mr-3 text-[#D4AF37]"></i>
                Graduate Studies
            </h3>
            <div class="flex items-center space-x-6 mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="showMasters" class="form-checkbox h-5 w-5 text-[#1B365D]">
                    <span class="ml-2 text-gray-700">Master's Degree</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="showDoctorate" class="form-checkbox h-5 w-5 text-[#1B365D]">
                    <span class="ml-2 text-gray-700">Doctorate Degree</span>
                </label>
            </div>
            <template x-if="showMasters">
                <div class="border border-gray-200 rounded-lg p-4 mb-6">
                    <h4 class="text-lg font-medium text-[#1B365D] mb-4">Master's Degree</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">School Name</label>
                            <input type="text" name="masters_school" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter school name" x-model="masters.school">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">School Address</label>
                            <input type="text" name="masters_address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter school address" x-model="masters.address">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Course/Degree</label>
                            <input type="text" name="masters_course" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Master of Science in ..." x-model="masters.course">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year Level</label>
                            <select name="masters_year_level" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" x-model="masters.year_level">
                                <option value="">Select Year Level</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                                <option value="Graduated">Graduated</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year Started</label>
                            <input type="number" name="masters_start" min="1900" max="2030" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="YYYY" x-model="masters.start">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year Graduated</label>
                            <input type="number" name="masters_graduate" min="1900" max="2030" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="YYYY" x-model="masters.graduate">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Honors/Awards</label>
                            <input type="text" name="masters_honors" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Cum Laude" x-model="masters.honors">
                        </div>
                    </div>
                </div>
            </template>
            <template x-if="showDoctorate">
                <div class="border border-gray-200 rounded-lg p-4 mb-6">
                    <h4 class="text-lg font-medium text-[#1B365D] mb-4">Doctorate Degree</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">School Name</label>
                            <input type="text" name="doctorate_school" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter school name" x-model="doctorate.school">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">School Address</label>
                            <input type="text" name="doctorate_address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter school address" x-model="doctorate.address">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Course/Degree</label>
                            <input type="text" name="doctorate_course" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Doctor of Philosophy in ..." x-model="doctorate.course">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year Level</label>
                            <select name="doctorate_year_level" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" x-model="doctorate.year_level">
                                <option value="">Select Year Level</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                                <option value="Graduated">Graduated</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year Started</label>
                            <input type="number" name="doctorate_start" min="1900" max="2030" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="YYYY" x-model="doctorate.start">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year Graduated</label>
                            <input type="number" name="doctorate_graduate" min="1900" max="2030" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="YYYY" x-model="doctorate.graduate">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Honors/Awards</label>
                            <input type="text" name="doctorate_honors" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Cum Laude" x-model="doctorate.honors">
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('educational-background')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Previous Section
            </button>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'educational-background')">
                Save & Continue
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>

    <!-- Live Summary Table -->
    <div class="mt-10">
        <h3 class="text-xl font-semibold text-[#1B365D] mb-4">Summary of Educational Background</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden">
                <thead>
                    <tr class="bg-[#1B365D] text-white">
                        <th class="px-4 py-3 font-bold text-left">Level</th>
                        <th class="px-4 py-3 font-bold text-left">School Name</th>
                        <th class="px-4 py-3 font-bold text-left">Address</th>
                        <th class="px-4 py-3 font-bold text-left">Course/Degree</th>
                        <th class="px-4 py-3 font-bold text-left">Year Started</th>
                        <th class="px-4 py-3 font-bold text-left">Year Graduated</th>
                        <th class="px-4 py-3 font-bold text-left">Honors/Awards</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="elementary.school || elementary.address || elementary.start || elementary.graduate || elementary.honors">
                        <tr class="even:bg-gray-50 hover:bg-blue-50 transition-colors">
                            <td class="px-4 py-3 border-b">Elementary</td>
                            <td class="px-4 py-3 border-b" x-text="elementary.school"></td>
                            <td class="px-4 py-3 border-b" x-text="elementary.address"></td>
                            <td class="px-4 py-3 border-b">-</td>
                            <td class="px-4 py-3 border-b" x-text="elementary.start"></td>
                            <td class="px-4 py-3 border-b" x-text="elementary.graduate"></td>
                            <td class="px-4 py-3 border-b" x-text="elementary.honors"></td>
                        </tr>
                    </template>
                    <template x-if="highschool.school || highschool.address || highschool.start || highschool.graduate || highschool.honors">
                        <tr class="even:bg-gray-50 hover:bg-blue-50 transition-colors">
                            <td class="px-4 py-3 border-b">High School</td>
                            <td class="px-4 py-3 border-b" x-text="highschool.school"></td>
                            <td class="px-4 py-3 border-b" x-text="highschool.address"></td>
                            <td class="px-4 py-3 border-b">-</td>
                            <td class="px-4 py-3 border-b" x-text="highschool.start"></td>
                            <td class="px-4 py-3 border-b" x-text="highschool.graduate"></td>
                            <td class="px-4 py-3 border-b" x-text="highschool.honors"></td>
                        </tr>
                    </template>
                    <template x-if="college.school || college.address || college.course || college.start || college.graduate || college.honors">
                        <tr class="even:bg-gray-50 hover:bg-blue-50 transition-colors">
                            <td class="px-4 py-3 border-b">College</td>
                            <td class="px-4 py-3 border-b" x-text="college.school"></td>
                            <td class="px-4 py-3 border-b" x-text="college.address"></td>
                            <td class="px-4 py-3 border-b" x-text="college.course"></td>
                            <td class="px-4 py-3 border-b" x-text="college.start"></td>
                            <td class="px-4 py-3 border-b" x-text="college.graduate"></td>
                            <td class="px-4 py-3 border-b" x-text="college.honors"></td>
                        </tr>
                    </template>
                    <template x-if="showMasters && (masters.school || masters.address || masters.course || masters.start || masters.graduate || masters.honors)">
                        <tr class="even:bg-gray-50 hover:bg-blue-50 transition-colors">
                            <td class="px-4 py-3 border-b">Master's</td>
                            <td class="px-4 py-3 border-b" x-text="masters.school"></td>
                            <td class="px-4 py-3 border-b" x-text="masters.address"></td>
                            <td class="px-4 py-3 border-b" x-text="masters.course"></td>
                            <td class="px-4 py-3 border-b" x-text="masters.start"></td>
                            <td class="px-4 py-3 border-b" x-text="masters.graduate"></td>
                            <td class="px-4 py-3 border-b" x-text="masters.honors"></td>
                        </tr>
                    </template>
                    <template x-if="showDoctorate && (doctorate.school || doctorate.address || doctorate.course || doctorate.start || doctorate.graduate || doctorate.honors)">
                        <tr class="even:bg-gray-50 hover:bg-blue-50 transition-colors">
                            <td class="px-4 py-3 border-b">Doctorate</td>
                            <td class="px-4 py-3 border-b" x-text="doctorate.school"></td>
                            <td class="px-4 py-3 border-b" x-text="doctorate.address"></td>
                            <td class="px-4 py-3 border-b" x-text="doctorate.course"></td>
                            <td class="px-4 py-3 border-b" x-text="doctorate.start"></td>
                            <td class="px-4 py-3 border-b" x-text="doctorate.graduate"></td>
                            <td class="px-4 py-3 border-b" x-text="doctorate.honors"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function educationalBackgroundForm() {
        return {
            currentSection: 'educational-background',
            elementary: { school: '', address: '', start: '', graduate: '', honors: '' },
            highschool: { school: '', address: '', start: '', graduate: '', honors: '' },
            college: { school: '', address: '', course: '', year_level: '', start: '', graduate: '', honors: '' },
            showMasters: false,
            masters: { school: '', address: '', course: '', year_level: '', start: '', graduate: '', honors: '' },
            showDoctorate: false,
            doctorate: { school: '', address: '', course: '', year_level: '', start: '', graduate: '', honors: '' },
            init() {
                this.markSectionAsVisited('educational-background');
            }
        }
    }
    document.addEventListener('alpine:init', () => {
        Alpine.data('educationalBackground', educationalBackgroundForm);
    });
</script>
@endsection
