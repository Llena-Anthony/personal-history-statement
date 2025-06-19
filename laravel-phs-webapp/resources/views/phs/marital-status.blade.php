@extends('layouts.phs-new')

@section('title', 'Marital Status')

@section('content')
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
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Separated">Separated</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Spouse Information (Conditional) -->
        <div id="spouse-section" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hidden">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user mr-3 text-[#D4AF37]"></i>
                Spouse Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Spouse Name -->
                <div>
                    <label for="spouse_first_name" class="block text-sm font-medium text-gray-700 mb-2">
                        First Name *
                    </label>
                    <input type="text" name="spouse_first_name" id="spouse_first_name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter first name">
                </div>

                <div>
                    <label for="spouse_middle_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Middle Name
                    </label>
                    <input type="text" name="spouse_middle_name" id="spouse_middle_name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter middle name">
                </div>

                <div>
                    <label for="spouse_last_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Last Name *
                    </label>
                    <input type="text" name="spouse_last_name" id="spouse_last_name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter last name">
                </div>

                <div>
                    <label for="spouse_suffix" class="block text-sm font-medium text-gray-700 mb-2">
                        Suffix
                    </label>
                    <input type="text" name="spouse_suffix" id="spouse_suffix"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="e.g., Jr., Sr., III">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Marriage Details -->
                <div>
                    <label for="marriage_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Date of Marriage *
                    </label>
                    <input type="date" name="marriage_date" id="marriage_date"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>

                <div>
                    <label for="marriage_place" class="block text-sm font-medium text-gray-700 mb-2">
                        Place of Marriage *
                    </label>
                    <input type="text" name="marriage_place" id="marriage_place"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter place of marriage">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Spouse Birth Details -->
                <div>
                    <label for="spouse_birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Date of Birth *
                    </label>
                    <input type="date" name="spouse_birth_date" id="spouse_birth_date"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                </div>

                <div>
                    <label for="spouse_birth_place" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Place of Birth *
                    </label>
                    <input type="text" name="spouse_birth_place" id="spouse_birth_place"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter place of birth">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Spouse Employment -->
                <div>
                    <label for="spouse_occupation" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Occupation
                    </label>
                    <input type="text" name="spouse_occupation" id="spouse_occupation"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter occupation">
                </div>

                <div>
                    <label for="spouse_employer" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Employer
                    </label>
                    <input type="text" name="spouse_employer" id="spouse_employer"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter employer">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Spouse Contact -->
                <div>
                    <label for="spouse_contact" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Contact Number
                    </label>
                    <input type="tel" name="spouse_contact" id="spouse_contact"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter contact number">
                </div>

                <div>
                    <label for="spouse_citizenship" class="block text-sm font-medium text-gray-700 mb-2">
                        Spouse's Citizenship *
                    </label>
                    <input type="text" name="spouse_citizenship" id="spouse_citizenship"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter citizenship">
                </div>
            </div>
        </div>

        <!-- Children Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-child mr-3 text-[#D4AF37]"></i>
                Children Information
            </h3>
            
            <div id="children-container" class="space-y-4">
                <div class="child-entry grid grid-cols-1 md:grid-cols-2 gap-4 p-4 border border-gray-200 rounded-lg">
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
                </div>
            </div>
            
            <button type="button" id="add-child" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Child
            </button>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <a href="{{ route('phs.educational-background') }}" 
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
        Alpine.data('maritalStatus', () => ({
            currentSection: 'marital-status',
            init() {
                // Mark this section as visited
                this.markSectionAsVisited('marital-status');
            }
        }));
    });

    // Marital status change handler
    document.getElementById('marital_status').addEventListener('change', function() {
        const spouseSection = document.getElementById('spouse-section');
        if (this.value === 'Married') {
            spouseSection.classList.remove('hidden');
        } else {
            spouseSection.classList.add('hidden');
        }
    });

    // Add child functionality
    let childCount = 1;
    document.getElementById('add-child').addEventListener('click', function() {
        const container = document.getElementById('children-container');
        const newChild = document.createElement('div');
        newChild.className = 'child-entry grid grid-cols-1 md:grid-cols-2 gap-4 p-4 border border-gray-200 rounded-lg';
        newChild.innerHTML = `
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Child's Name</label>
                <input type="text" name="children[${childCount}][name]" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                       placeholder="Enter child's name">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                <input type="date" name="children[${childCount}][birth_date]" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
            </div>
        `;
        container.appendChild(newChild);
        childCount++;
    });
</script>
@endsection 