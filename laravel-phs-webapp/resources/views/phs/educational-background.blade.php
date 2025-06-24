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
                                   placeholder="Enter school name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Address
                            </label>
                            <input type="text" name="elementary[0][address]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter school address">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Started
                            </label>
                            <input type="number" name="elementary[0][start]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Graduated
                            </label>
                            <input type="number" name="elementary[0][graduate]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY">
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
                                   placeholder="Enter school name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Address
                            </label>
                            <input type="text" name="highschool[0][address]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter school address">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Started
                            </label>
                            <input type="number" name="highschool[0][start]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Graduated
                            </label>
                            <input type="number" name="highschool[0][graduate]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY">
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
                                   placeholder="Enter school name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Address
                            </label>
                            <input type="text" name="college[0][address]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter school address">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Course/Degree
                            </label>
                            <input type="text" name="college[0][course]"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="e.g., Bachelor of Science in Computer Science">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Level
                            </label>
                            <select name="college[0][year_level]"
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Started
                            </label>
                            <input type="number" name="college[0][start]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Year Graduated
                            </label>
                            <input type="number" name="college[0][graduate]" min="1900" max="2030"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="YYYY">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-college" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another College
            </button>
        </div>

        <!-- Post Graduate Studies Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-graduate mr-3 text-[#D4AF37]"></i>
                Post Graduate Studies
            </h3>
            <div id="postgraduate-container" class="space-y-4">
                <!-- Initial post graduate entry -->
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
                <i class="fas fa-plus mr-1"></i> Add Another Post Graduate
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
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'educational-background')">
                Save & Continue
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
    function educationalBackgroundForm() {
        return {
            currentSection: 'educational-background',
            init() {
                this.markSectionAsVisited('educational-background');
                this.initializeAddButtons();
            },
            initializeAddButtons() {
                // Elementary Education
                this.setupAddButton('add-elementary', 'elementary-container', 'elementary-entry', 'elementary');
                
                // High School Education
                this.setupAddButton('add-highschool', 'highschool-container', 'highschool-entry', 'highschool');
                
                // College Education
                this.setupAddButton('add-college', 'college-container', 'college-entry', 'college');
                
                // Post Graduate Studies
                this.setupAddButton('add-postgraduate', 'postgraduate-container', 'postgraduate-entry', 'postgraduate');
            },
            setupAddButton(buttonId, containerId, entryClass, level) {
                const button = document.getElementById(buttonId);
                if (!button) return;
                
                button.addEventListener('click', () => {
                    const container = document.getElementById(containerId);
                    if (!container) return;
                    
                    const entries = container.querySelectorAll(`.${entryClass}`);
                    const idx = entries.length;
                    
                    const newEntry = document.createElement('div');
                    newEntry.className = `${entryClass} p-4 border border-gray-200 rounded-lg mt-4 relative`;
                    newEntry.setAttribute('data-index', idx);
                    
                    // Create the HTML for the new entry based on level
                    newEntry.innerHTML = this.getEntryHTML(level, idx);
                    
                    // Add remove button for non-first entries
                    if (idx > 0) {
                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'remove-entry absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors';
                        removeBtn.innerHTML = '<i class="fas fa-times-circle"></i>';
                        removeBtn.onclick = () => {
                            if (container.querySelectorAll(`.${entryClass}`).length > 1) {
                                newEntry.remove();
                            }
                        };
                        newEntry.appendChild(removeBtn);
                    }
                    
                    container.appendChild(newEntry);
                });
            },
            getEntryHTML(level, idx) {
                const baseFields = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">School Name</label>
                            <input type="text" name="${level}[${idx}][school]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter school name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">School Address</label>
                            <input type="text" name="${level}[${idx}][address]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter school address">
                        </div>
                    </div>
                `;
                
                const yearFields = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year Started</label>
                            <input type="number" name="${level}[${idx}][start]" min="1900" max="2030" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="YYYY">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Year Graduated</label>
                            <input type="number" name="${level}[${idx}][graduate]" min="1900" max="2030" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="YYYY">
                        </div>
                    </div>
                `;
                
                if (level === 'elementary' || level === 'highschool' || level === 'postgraduate') {
                    return baseFields + yearFields;
                } else {
                    const courseFields = `
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Course/Degree</label>
                                <input type="text" name="${level}[${idx}][course]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Bachelor of Science in Computer Science">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Year Level</label>
                                <select name="${level}[${idx}][year_level]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
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
                    `;
                    return baseFields + courseFields + yearFields;
                }
            }
        }
    }
    
    document.addEventListener('alpine:init', () => {
        Alpine.data('educationalBackground', educationalBackgroundForm);
    });
</script>
@endsection
