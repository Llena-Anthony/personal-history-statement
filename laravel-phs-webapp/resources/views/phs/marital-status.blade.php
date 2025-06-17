@extends('layouts.app')

@section('title', 'Marital Status - Personal History Statement')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Fixed Sidebar -->
    <div class="w-72 bg-white shadow-lg fixed overflow-y-auto" style="position: fixed; top: 64px; left: 0; z-index: 40; height: calc(100vh - 64px);">
        <!-- User Profile Section -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-gray-500 text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Gregorio Del Pilar</h3>
                    <p class="text-sm text-gray-500">Civilian</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="p-6">
            <ul class="space-y-6">
                <li>
                    <a href="{{ route('phs.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">I</span>
                        </span>
                        <span class="text-gray-400">Personal Details</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.personal-characteristics.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">II</span>
                        </span>
                        <span class="text-gray-400">Personal Characteristics</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.marital-status.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-yellow-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">III</span>
                        </span>
                        <span class="text-black">Marital Status</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">IV</span>
                        </span>
                        <span class="text-gray-400">Family History and Information</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">V</span>
                        </span>
                        <span class="text-gray-400">Educational Background</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VI</span>
                        </span>
                        <span class="text-gray-400">Military History</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VII</span>
                        </span>
                        <span class="text-gray-400">Places of Residence Since Birth</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VIII</span>
                        </span>
                        <span class="text-gray-400">Employment History</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">IX</span>
                        </span>
                        <span class="text-gray-400">Foreign Countries Visited</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-72 p-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-[#1B365D] mb-6 flex items-center">
                    <i class="fas fa-ring mr-3 text-[#D4AF37]"></i>
                    Marital Status
                </h2>

                <form method="POST" action="{{ route('phs.marital-status.store') }}" class="space-y-8">
                    @csrf

                    <!-- Marital Status Section -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Marital Status</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Marital Status</label>
                                <select name="marital_status" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Marital Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Spouse Information Section -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Spouse Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Fields -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" name="spouse_first_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                <input type="text" name="spouse_middle_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" name="spouse_last_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                                <input type="text" name="spouse_suffix" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>

                            <!-- Marriage Details -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Marriage</label>
                                <input type="date" name="marriage_date" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Place of Marriage</label>
                                <input type="text" name="marriage_place" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>

                            <!-- Spouse Birth Details -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" name="spouse_birth_date" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                                <input type="text" name="spouse_birth_place" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>

                            <!-- Employment Details -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                                <input type="text" name="spouse_occupation" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Employer</label>
                                <input type="text" name="spouse_employer" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Place of Employment</label>
                                <input type="text" name="spouse_employment_place" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>

                            <!-- Contact and Citizenship -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                                <input type="tel" name="spouse_contact" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                                <select name="spouse_citizenship" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Citizenship</option>
                                    <option value="Filipino">Filipino</option>
                                    <option value="Dual Citizenship">Dual Citizenship</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Other Citizenship</label>
                                <input type="text" name="spouse_other_citizenship" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Children Section -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-[#1B365D]">Children</h3>
                            <button type="button" id="addChild" class="px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] transition-colors">
                                <i class="fas fa-plus mr-2"></i>Add Child
                            </button>
                        </div>
                        <div id="childrenContainer" class="space-y-6">
                            <!-- Child template will be cloned here -->
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('phs.personal-characteristics.create') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                            Previous Section
                        </a>
                        <a href="{{ route('phs.family-history.create') }}" class="px-6 py-2.5 rounded-lg bg-[#1B365D] text-white hover:bg-[#2B4B7D] transition-colors">
                            Next Section
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Child Template -->
<template id="childTemplate">
    <div class="child-entry bg-white p-4 rounded-lg border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h4 class="text-md font-medium text-gray-700">Child Information</h4>
            <button type="button" class="remove-child text-red-600 hover:text-red-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <input type="text" name="children[INDEX][name]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                <input type="date" name="children[INDEX][birth_date]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship/Address</label>
                <input type="text" name="children[INDEX][citizenship_address]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Name of Father/Mother</label>
                <input type="text" name="children[INDEX][parent_name]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
            </div>
        </div>
    </div>
</template>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('maritalStatusForm');
        const maritalStatusSelect = document.querySelector('select[name="marital_status"]');
        const spouseFields = document.querySelectorAll('[name^="spouse_"]');
        const marriageFields = document.querySelectorAll('[name^="marriage_"]');

        // Show/hide spouse fields based on marital status
        maritalStatusSelect.addEventListener('change', function() {
            const isMarried = this.value === 'Married';
            spouseFields.forEach(field => {
                field.closest('.md\\:col-span-2, div').style.display = isMarried ? 'block' : 'none';
            });
            marriageFields.forEach(field => {
                field.closest('.md\\:col-span-2, div').style.display = isMarried ? 'block' : 'none';
            });
        });

        // Handle child entries
        const addChildBtn = document.getElementById('addChild');
        const childrenContainer = document.getElementById('childrenContainer');
        const childTemplate = document.getElementById('childTemplate');
        let childIndex = 0;

        addChildBtn.addEventListener('click', function() {
            const childEntry = childTemplate.content.cloneNode(true);
            const inputs = childEntry.querySelectorAll('input');
            inputs.forEach(input => {
                input.name = input.name.replace('INDEX', childIndex);
            });
            childrenContainer.appendChild(childEntry);
            childIndex++;
        });

        // Handle remove child
        childrenContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-child') || e.target.closest('.remove-child')) {
                const childEntry = e.target.closest('.child-entry');
                if (childEntry) {
                    childEntry.remove();
                }
            }
        });

        // Handle form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Submit the form normally
            form.submit();
        });
    });
</script>
@endsection 