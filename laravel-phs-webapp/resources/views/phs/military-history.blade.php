@extends('layouts.phs-new')

@section('title', 'VI: Military History')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-shield-alt text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Military History</h1>
                <p class="text-gray-600">Please provide your military service information</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('phs.military-history.store') }}" class="space-y-8">
        @csrf
        
        <!-- Basic Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-info-circle mr-3 text-[#D4AF37]"></i>
                Basic Military Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Enlistment in the AFP</label>
                    <input type="date" name="enlistment_date" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Source of Commission</label>
                    <input type="text" name="commission_source" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter source of commission">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Commission (From)</label>
                    <input type="date" name="commission_date_from" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Commission (To)</label>
                    <input type="date" name="commission_date_to" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
        </div>

        <!-- Unit Assignments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                    <i class="fas fa-map-marker-alt mr-3 text-[#D4AF37]"></i>
                    Important Unit Assignments since enlisted/CAD
                </h3>
            </div>
            <div id="assignments-container" class="space-y-4">
                <!-- Initial assignment entry (default, not removable) -->
                <div class="assignment-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (From)</label>
                            <input type="date" name="assignments[0][from]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (To)</label>
                            <input type="date" name="assignments[0][to]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Unit/Office</label>
                            <input type="text" name="assignments[0][unit_office]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter unit or office">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CO/Chief of Office</label>
                            <input type="text" name="assignments[0][co_chief]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter CO or Chief of Office">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-assignment" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Assignment
            </button>
        </div>

        <!-- Military Schools -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                    <i class="fas fa-graduation-cap mr-3 text-[#D4AF37]"></i>
                    Military Schools Attended
                </h3>
            </div>
            <div id="schools-container" class="space-y-4">
                <!-- Initial school entry (default, not removable) -->
                <div class="school-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">School</label>
                            <input type="text" name="schools[0][school]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter school name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <input type="text" name="schools[0][location]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter school location">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Attendance</label>
                            <input type="number" name="schools[0][date_attended]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nature of Training</label>
                            <input type="text" name="schools[0][nature_training]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter nature of training">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <input type="text" name="schools[0][rating]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter rating">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-school" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another School
            </button>
        </div>

        <!-- Awards -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                    <i class="fas fa-medal mr-3 text-[#D4AF37]"></i>
                    Decorations, Awards, or Commendations Received
                </h3>
            </div>
            <div id="awards-container" class="space-y-4">
                <!-- Initial award entry (default, not removable) -->
                <div class="award-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <input type="text" name="awards[0][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter award or decoration name">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-award" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Award
            </button>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('military-history')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'military-history')">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Unit Assignments functionality
        const assignmentsContainer = document.getElementById('assignments-container');
        const addAssignmentBtn = document.getElementById('add-assignment');

        addAssignmentBtn.addEventListener('click', () => {
            const entries = assignmentsContainer.querySelectorAll('.assignment-entry');
            const idx = entries.length;
            const assignmentEntry = document.createElement('div');
            assignmentEntry.className = 'assignment-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
            assignmentEntry.setAttribute('data-index', idx);
            assignmentEntry.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (From)</label>
                        <input type="date" name="assignments[${idx}][from]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (To)</label>
                        <input type="date" name="assignments[${idx}][to]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Unit/Office</label>
                        <input type="text" name="assignments[${idx}][unit_office]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter unit or office">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">CO/Chief of Office</label>
                        <input type="text" name="assignments[${idx}][co_chief]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter CO or Chief of Office">
                    </div>
                </div>
                <button type="button" class="remove-assignment absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
            `;
            assignmentsContainer.appendChild(assignmentEntry);
        });

        assignmentsContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-assignment')) {
                const entries = assignmentsContainer.querySelectorAll('.assignment-entry');
                if (entries.length > 1) {
                    e.target.closest('.assignment-entry').remove();
                }
            }
        });

        // Military Schools functionality
        const schoolsContainer = document.getElementById('schools-container');
        const addSchoolBtn = document.getElementById('add-school');

        addSchoolBtn.addEventListener('click', () => {
            const entries = schoolsContainer.querySelectorAll('.school-entry');
            const idx = entries.length;
            const schoolEntry = document.createElement('div');
            schoolEntry.className = 'school-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
            schoolEntry.setAttribute('data-index', idx);
            schoolEntry.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">School</label>
                        <input type="text" name="schools[${idx}][school]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter school name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="schools[${idx}][location]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter school location">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Attendance</label>
                        <input type="number" name="schools[${idx}][date_attended]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nature of Training</label>
                        <input type="text" name="schools[${idx}][nature_training]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter nature of training">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                        <input type="text" name="schools[${idx}][rating]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter rating">
                    </div>
                </div>
                <button type="button" class="remove-school absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
            `;
            schoolsContainer.appendChild(schoolEntry);
        });

        schoolsContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-school')) {
                const entries = schoolsContainer.querySelectorAll('.school-entry');
                if (entries.length > 1) {
                    e.target.closest('.school-entry').remove();
                    }
                }
            });

        // Awards functionality
        const awardsContainer = document.getElementById('awards-container');
        const addAwardBtn = document.getElementById('add-award');

        addAwardBtn.addEventListener('click', () => {
            const entries = awardsContainer.querySelectorAll('.award-entry');
            const idx = entries.length;
            const awardEntry = document.createElement('div');
            awardEntry.className = 'award-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
            awardEntry.setAttribute('data-index', idx);
            awardEntry.innerHTML = `
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <input type="text" name="awards[${idx}][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter award or decoration name">
                    </div>
                </div>
                <button type="button" class="remove-award absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
            `;
            awardsContainer.appendChild(awardEntry);
        });

        awardsContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-award')) {
                const entries = awardsContainer.querySelectorAll('.award-entry');
                if (entries.length > 1) {
                    e.target.closest('.award-entry').remove();
                }
            }
        });
    });
</script>
@endsection
@php($currentSection = 'military-history') 