@extends('layouts.app')

@section('title', 'Marital Status - Personal History Statement')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 relative">
    <div class="absolute inset-0 bg-[url('/images/pma-background.jpg')] bg-cover bg-center bg-no-repeat opacity-10 blur-sm"></div>
    <div class="relative flex min-h-screen">
    <!-- Fixed Sidebar -->
        <aside class="w-72 bg-white shadow-lg fixed top-0 left-0 h-screen overflow-y-auto z-40 flex flex-col">
        <!-- User Profile Section -->
            <div class="p-6 border-b border-gray-200 bg-white flex flex-col items-center">
                <div class="relative mb-3">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-[#D4AF37]">
                        <img src="/images/profile-placeholder.png" alt="User Photo" 
                            class="w-full h-full object-cover object-center transform scale-110">
                    </div>
                    <div class="absolute bottom-0 right-0 bg-green-500 w-4 h-4 rounded-full border-2 border-white"></div>
                </div>
                <div class="text-center">
                    <h3 class="text-base font-semibold text-gray-800">Gregorio Del Pilar</h3>
                    <p class="text-xs text-gray-500">Civilian</p>
                </div>
            </div>
            <!-- Progress Bar -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-600">Progress</span>
                    <span class="text-sm font-medium text-[#1B365D]">3/10</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-[#D4AF37] h-2 rounded-full" style="width: 30%"></div>
            </div>
        </div>
        <!-- Navigation -->
            <nav class="flex-1 p-6 bg-white">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('phs.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">I</span>
                            </span>
                            <span class="text-sm font-medium">Personal Details</span>
                        </a>
                    </li>
                    <li>
                        <a href="/phs/personal-characteristics" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">II</span>
                        </span>
                            <span class="text-sm font-medium">Personal Characteristics</span>
                    </a>
                </li>
                <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors bg-[#1B365D]/5 font-bold text-[#1B365D]">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-[#D4AF37]">
                                <span class="text-xs text-white font-bold">III</span>
                        </span>
                            <span class="text-sm font-bold">Marital Status</span>
                    </a>
                </li>
                <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">IV</span>
                        </span>
                            <span class="text-sm font-medium">Family History and Information</span>
                    </a>
                </li>
                <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">V</span>
                        </span>
                            <span class="text-sm font-medium">Educational Background</span>
                    </a>
                </li>
                <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">VI</span>
                        </span>
                            <span class="text-sm font-medium">Military History</span>
                    </a>
                </li>
                <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">VII</span>
                        </span>
                            <span class="text-sm font-medium">Places of Residence Since Birth</span>
                    </a>
                </li>
                <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">VIII</span>
                        </span>
                            <span class="text-sm font-medium">Employment History</span>
                    </a>
                </li>
                <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">IX</span>
                        </span>
                            <span class="text-sm font-medium">Foreign Countries Visited</span>
                    </a>
                </li>
                <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">X</span>
                        </span>
                            <span class="text-sm font-medium">Credit Reputation</span>
                    </a>
                </li>
            </ul>
        </nav>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 ml-72 p-8 mt-16">
            <div class="max-w-5xl mx-auto">
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-lg border border-green-400 bg-green-50 text-green-800 flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-6 p-4 rounded-lg border border-red-400 bg-red-50 text-red-800">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                            <span class="font-semibold">Please correct the following errors:</span>
                        </div>
                        <ul class="list-disc pl-6">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg p-8 mb-8">
                    <h2 class="text-3xl font-extrabold text-[#1B365D] mb-8">III: Marital Status</h2>
                    <form method="POST" action="{{ route('phs.marital-status.store') }}" class="space-y-8">
                        @csrf
                            <!-- Marital Status and Spouse Name -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Marital Status</label>
                                    <select name="marital_status" id="marital_status" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                        <option value="">Select</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Separated">Separated</option>
                                    </select>
                                </div>
                                <div id="spouse_section" style="display: none;" class="col-span-3">
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Name of Spouse</label>
                                    <div class="grid grid-cols-4 gap-2">
                                        <input type="text" name="spouse_first_name" placeholder="First Name" class="col-span-1 w-full rounded-md px-3 py-2 border border-gray-300">
                                        <input type="text" name="spouse_middle_name" placeholder="Middle Name" class="col-span-1 w-full rounded-md px-3 py-2 border border-gray-300">
                                        <input type="text" name="spouse_last_name" placeholder="Last Name" class="col-span-1 w-full rounded-md px-3 py-2 border border-gray-300">
                                        <input type="text" name="spouse_suffix" placeholder="Suffix" class="col-span-1 w-full rounded-md px-3 py-2 border border-gray-300">
                        </div>
                                </div>
                                </div>
                            <!-- Marriage and Spouse Details -->
                            <div id="spouse_details_section" style="display: none;">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Date of Marriage</label>
                                        <input type="date" name="marriage_date" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Place of Marriage</label>
                                        <input type="text" name="marriage_place" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                </div>
                                <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Date of Birth of Spouse</label>
                                        <input type="date" name="spouse_birth_date" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                </div>
                                <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Place of Birth of Spouse</label>
                                        <input type="text" name="spouse_birth_place" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                    </div>
                                </div>
                                <!-- Spouse Occupation, Employer, Place of Employment -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                                <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Occupation</label>
                                        <input type="text" name="spouse_occupation" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                </div>
                                <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Employer</label>
                                        <input type="text" name="spouse_employer" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                </div>
                                <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Place of Employment</label>
                                        <input type="text" name="spouse_employment_place" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                    </div>
                                </div>
                                <!-- Contact, Citizenship -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Contact Number</label>
                                        <input type="text" name="spouse_contact" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                </div>
                                <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Citizenship</label>
                                        <input type="text" name="spouse_citizenship" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                </div>
                                <div>
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Other Citizenship</label>
                                        <input type="text" name="spouse_other_citizenship" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                    </div>
                                </div>
                            </div>
                            <!-- Children Section -->
                            <div id="children_section" style="display: none;">
                                <label class="block text-xs font-medium text-gray-600 mb-2">CHILDREN
                                    <button type="button" id="add-child" class="ml-2 text-[#D4AF37] hover:text-[#1B365D] focus:outline-none" title="Add Child">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </label>
                                <div id="children-list">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-2 child-row">
                                        <input type="text" name="children[0][name]" placeholder="Name" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                        <input type="date" name="children[0][birth_date]" placeholder="Date of Birth" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                        <input type="text" name="children[0][citizenship_address]" placeholder="Citizenship/Address" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                        <input type="text" name="children[0][parent_name]" placeholder="Name of Father/Mother" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                        <button type="button" class="remove-child text-red-500 hover:text-red-700 ml-2 mt-2 md:mt-0" title="Remove Child" style="display:none"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- Navigation Buttons -->
                            <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
                                <a href="{{ route('phs.personal-characteristics.create') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-arrow-left mr-2"></i>Back
                                </a>
                                <button type="submit" class="px-6 py-2.5 rounded-lg bg-[#1B365D] text-white hover:bg-[#2B4B7D] transition-colors">
                                    Next Section
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                        </div>
                    </form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
                            let childIndex = 1;
                            const maritalStatusSelect = document.getElementById('marital_status');
                            const spouseSection = document.getElementById('spouse_section');
                            const spouseDetailsSection = document.getElementById('spouse_details_section');
                            const childrenSection = document.getElementById('children_section');

                            // Function to update section visibility
                            function updateSectionVisibility() {
                                const status = maritalStatusSelect.value;
                                
                                // Hide all sections by default
                                spouseSection.style.display = 'none';
                                spouseDetailsSection.style.display = 'none';
                                childrenSection.style.display = 'none';
                                
                                // Show relevant sections based on marital status
                                if (status === 'Married') {
                                    spouseSection.style.display = 'block';
                                    spouseDetailsSection.style.display = 'block';
                                    childrenSection.style.display = 'block';
                                } else if (status === 'Widowed' || status === 'Separated') {
                                    childrenSection.style.display = 'block';
                                }
                            }

                            // Initial visibility check
                            updateSectionVisibility();

                            // Listen for changes in marital status
                            maritalStatusSelect.addEventListener('change', updateSectionVisibility);

                            // Add Child functionality
                            document.getElementById('add-child').addEventListener('click', function() {
                                const row = document.createElement('div');
                                row.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-2 child-row';
                                row.innerHTML = `
                                    <input type="text" name="children[${childIndex}][name]" placeholder="Name" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                    <input type="date" name="children[${childIndex}][birth_date]" placeholder="Date of Birth" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                    <input type="text" name="children[${childIndex}][citizenship_address]" placeholder="Citizenship/Address" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                    <input type="text" name="children[${childIndex}][parent_name]" placeholder="Name of Father/Mother" class="w-full rounded-md px-3 py-2 border border-gray-300">
                                    <button type="button" class="remove-child text-red-500 hover:text-red-700 ml-2 mt-2 md:mt-0" title="Remove Child"><i class="fas fa-trash"></i></button>
                                `;
                                document.getElementById('children-list').appendChild(row);
                                childIndex++;
                                updateRemoveButtons();
                            });

                            function updateRemoveButtons() {
                                const removeButtons = document.querySelectorAll('.remove-child');
                                removeButtons.forEach(btn => btn.style.display = 'inline-block');
                                if (removeButtons.length === 1) removeButtons[0].style.display = 'none';
                                removeButtons.forEach(btn => {
                                    btn.onclick = function() {
                                        btn.parentElement.remove();
                                        updateRemoveButtons();
                                    };
                                });
                            }
                            updateRemoveButtons();
    });
</script>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection 