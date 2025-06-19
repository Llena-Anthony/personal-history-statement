@extends('layouts.phs-new')

@section('title', 'Educational Background')

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
        
        <!-- Progress Indicator -->
        <div class="bg-gray-100 rounded-lg p-4">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Section Progress</span>
                <span class="text-sm text-gray-500">3 of 10 sections</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-[#1B365D] h-2 rounded-full" style="width: 30%"></div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('phs.educational-background.store') }}" class="space-y-8">
        @csrf
        
        <!-- Elementary Education -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-school mr-3 text-[#D4AF37]"></i>
                Elementary Education
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- School Name -->
                <div>
                    <label for="elementary_school" class="block text-sm font-medium text-gray-700 mb-2">
                        School Name
                    </label>
                    <input type="text" name="elementary_school" id="elementary_school"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school name">
                </div>

                <!-- Address -->
                <div>
                    <label for="elementary_address" class="block text-sm font-medium text-gray-700 mb-2">
                        School Address
                    </label>
                    <input type="text" name="elementary_address" id="elementary_address"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school address">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <!-- Year Started -->
                <div>
                    <label for="elementary_start" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Started
                    </label>
                    <input type="number" name="elementary_start" id="elementary_start" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY">
                </div>

                <!-- Year Graduated -->
                <div>
                    <label for="elementary_graduate" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Graduated
                    </label>
                    <input type="number" name="elementary_graduate" id="elementary_graduate" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY">
                </div>

                <!-- Honors/Awards -->
                <div>
                    <label for="elementary_honors" class="block text-sm font-medium text-gray-700 mb-2">
                        Honors/Awards
                    </label>
                    <input type="text" name="elementary_honors" id="elementary_honors"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Valedictorian, Salutatorian">
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
                <!-- School Name -->
                <div>
                    <label for="highschool_school" class="block text-sm font-medium text-gray-700 mb-2">
                        School Name
                    </label>
                    <input type="text" name="highschool_school" id="highschool_school"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school name">
                </div>

                <!-- Address -->
                <div>
                    <label for="highschool_address" class="block text-sm font-medium text-gray-700 mb-2">
                        School Address
                    </label>
                    <input type="text" name="highschool_address" id="highschool_address"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school address">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <!-- Year Started -->
                <div>
                    <label for="highschool_start" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Started
                    </label>
                    <input type="number" name="highschool_start" id="highschool_start" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY">
                </div>

                <!-- Year Graduated -->
                <div>
                    <label for="highschool_graduate" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Graduated
                    </label>
                    <input type="number" name="highschool_graduate" id="highschool_graduate" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY">
                </div>

                <!-- Honors/Awards -->
                <div>
                    <label for="highschool_honors" class="block text-sm font-medium text-gray-700 mb-2">
                        Honors/Awards
                    </label>
                    <input type="text" name="highschool_honors" id="highschool_honors"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Valedictorian, Salutatorian">
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
                <!-- School Name -->
                <div>
                    <label for="college_school" class="block text-sm font-medium text-gray-700 mb-2">
                        School Name
                    </label>
                    <input type="text" name="college_school" id="college_school"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school name">
                </div>

                <!-- Address -->
                <div>
                    <label for="college_address" class="block text-sm font-medium text-gray-700 mb-2">
                        School Address
                    </label>
                    <input type="text" name="college_address" id="college_address"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter school address">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Course -->
                <div>
                    <label for="college_course" class="block text-sm font-medium text-gray-700 mb-2">
                        Course/Degree
                    </label>
                    <input type="text" name="college_course" id="college_course"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Bachelor of Science in Computer Science">
                </div>

                <!-- Year Level -->
                <div>
                    <label for="college_year_level" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Level
                    </label>
                    <select name="college_year_level" id="college_year_level"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
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
                <!-- Year Started -->
                <div>
                    <label for="college_start" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Started
                    </label>
                    <input type="number" name="college_start" id="college_start" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY">
                </div>

                <!-- Year Graduated -->
                <div>
                    <label for="college_graduate" class="block text-sm font-medium text-gray-700 mb-2">
                        Year Graduated
                    </label>
                    <input type="number" name="college_graduate" id="college_graduate" min="1900" max="2030"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="YYYY">
                </div>

                <!-- Honors/Awards -->
                <div>
                    <label for="college_honors" class="block text-sm font-medium text-gray-700 mb-2">
                        Honors/Awards
                    </label>
                    <input type="text" name="college_honors" id="college_honors"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Cum Laude, Magna Cum Laude">
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <a href="{{ route('phs.family-background.create') }}" 
               class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all">
                <i class="fas fa-arrow-left mr-2"></i>
                Previous Section
            </a>
            
            <button type="submit" 
                    class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all">
                Save & Continue
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
    // Initialize Alpine.js data for this section
    document.addEventListener('alpine:init', () => {
        Alpine.data('educationalBackground', () => ({
            currentSection: 'educational-background',
            init() {
                // Mark this section as visited
                this.markSectionAsVisited('educational-background');
            }
        }));
    });
</script>
@endsection
