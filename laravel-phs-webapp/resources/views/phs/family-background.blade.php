@extends('layouts.phs-new')

@section('title', 'Family Background')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-users text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Family Background</h1>
                <p class="text-gray-600">Please provide information about your family</p>
            </div>
        </div>
        
        <!-- Progress Indicator -->
        <div class="bg-gray-100 rounded-lg p-4">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Section Progress</span>
                <span class="text-sm text-gray-500">2 of 10 sections</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-[#1B365D] h-2 rounded-full" style="width: 20%"></div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('phs.family-background.store') }}" class="space-y-8">
        @csrf
        
        <!-- Father's Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-male mr-3 text-[#D4AF37]"></i>
                Father's Information
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Father's Name -->
                <div>
                    <label for="father_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Father's Full Name
                    </label>
                    <input type="text" name="father_name" id="father_name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter father's full name">
                </div>

                <!-- Father's Occupation -->
                <div>
                    <label for="father_occupation" class="block text-sm font-medium text-gray-700 mb-2">
                        Father's Occupation
                    </label>
                    <input type="text" name="father_occupation" id="father_occupation"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter father's occupation">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Father's Address -->
                <div>
                    <label for="father_address" class="block text-sm font-medium text-gray-700 mb-2">
                        Father's Address
                    </label>
                    <textarea name="father_address" id="father_address" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                              placeholder="Enter father's address"></textarea>
                </div>

                <!-- Father's Contact -->
                <div>
                    <label for="father_contact" class="block text-sm font-medium text-gray-700 mb-2">
                        Father's Contact Number
                    </label>
                    <input type="tel" name="father_contact" id="father_contact"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter contact number">
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
                <!-- Mother's Name -->
                <div>
                    <label for="mother_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Mother's Full Name
                    </label>
                    <input type="text" name="mother_name" id="mother_name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter mother's full name">
                </div>

                <!-- Mother's Occupation -->
                <div>
                    <label for="mother_occupation" class="block text-sm font-medium text-gray-700 mb-2">
                        Mother's Occupation
                    </label>
                    <input type="text" name="mother_occupation" id="mother_occupation"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter mother's occupation">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Mother's Address -->
                <div>
                    <label for="mother_address" class="block text-sm font-medium text-gray-700 mb-2">
                        Mother's Address
                    </label>
                    <textarea name="mother_address" id="mother_address" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                              placeholder="Enter mother's address"></textarea>
                </div>

                <!-- Mother's Contact -->
                <div>
                    <label for="mother_contact" class="block text-sm font-medium text-gray-700 mb-2">
                        Mother's Contact Number
                    </label>
                    <input type="tel" name="mother_contact" id="mother_contact"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter contact number">
                </div>
            </div>
        </div>

        <!-- Siblings Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6" x-data="{ siblingCount: 0 }">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-child mr-3 text-[#D4AF37]"></i>
                Siblings Information
            </h3>
            <div class="mb-6 max-w-xs">
                <label for="sibling_count" class="block text-sm font-medium text-gray-700 mb-2">
                    Number of Siblings
                </label>
                <input type="number" min="0" max="20" name="sibling_count" id="sibling_count"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                    placeholder="Enter number of siblings"
                    x-model.number="siblingCount">
            </div>
            <template x-for="i in siblingCount" :key="i">
                <div class="border border-gray-200 rounded-lg p-4 mb-6">
                    <h4 class="text-lg font-medium text-[#1B365D] mb-4">Sibling <span x-text="i"></span></h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label :for="'siblings_' + (i-1) + '_full_name'" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name
                            </label>
                            <input type="text" :name="'siblings[' + (i-1) + '][full_name]'" :id="'siblings_' + (i-1) + '_full_name'"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                placeholder="Enter sibling's full name">
                        </div>
                        <div>
                            <label :for="'siblings_' + (i-1) + '_occupation'" class="block text-sm font-medium text-gray-700 mb-2">
                                Occupation
                            </label>
                            <input type="text" :name="'siblings[' + (i-1) + '][occupation]'" :id="'siblings_' + (i-1) + '_occupation'"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                placeholder="Enter occupation">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label :for="'siblings_' + (i-1) + '_address'" class="block text-sm font-medium text-gray-700 mb-2">
                                Address
                            </label>
                            <textarea :name="'siblings[' + (i-1) + '][address]'" :id="'siblings_' + (i-1) + '_address'" rows="2"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                placeholder="Enter address"></textarea>
                        </div>
                        <div>
                            <label :for="'siblings_' + (i-1) + '_contact'" class="block text-sm font-medium text-gray-700 mb-2">
                                Contact Number
                            </label>
                            <input type="tel" :name="'siblings[' + (i-1) + '][contact]'" :id="'siblings_' + (i-1) + '_contact'"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                placeholder="Enter contact number">
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <a href="{{ route('phs.create') }}" 
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
        Alpine.data('familyBackground', () => ({
            currentSection: 'family-background',
            init() {
                // Mark this section as visited
                this.markSectionAsVisited('family-background');
            }
        }));
    });
</script>
@endsection 