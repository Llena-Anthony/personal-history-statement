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
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('phs.family-background.store') }}" class="space-y-8">
        @csrf
        
        <!-- Father's Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-male mr-3 text-[#D4AF37]"></i>
                Father Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                    <input type="text" name="father_first_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name *</label>
                    <input type="text" name="father_middle_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                    <input type="text" name="father_last_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Suffix (e.g. Sr, IV, etc)</label>
                    <input type="text" name="father_suffix" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                    <input type="date" name="father_birth_date" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth *</label>
                    <input type="text" name="father_birth_place" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                    <input type="text" name="father_occupation" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employer</label>
                    <input type="text" name="father_employer" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Employment</label>
                    <input type="text" name="father_place_of_employment" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship</label>
                    <input type="text" name="father_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Other Citizenship</label>
                    <input type="text" name="father_other_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">If Naturalized (Provide Date and Place)</label>
                    <input type="text" name="father_naturalized_details" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
        </div>

        <!-- Mother's Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-female mr-3 text-[#D4AF37]"></i>
                Mother Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                    <input type="text" name="mother_first_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name *</label>
                    <input type="text" name="mother_middle_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                    <input type="text" name="mother_last_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Suffix (e.g. Sr, IV, etc)</label>
                    <input type="text" name="mother_suffix" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                    <input type="date" name="mother_birth_date" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth *</label>
                    <input type="text" name="mother_birth_place" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                    <input type="text" name="mother_occupation" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employer</label>
                    <input type="text" name="mother_employer" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Employment</label>
                    <input type="text" name="mother_place_of_employment" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Citizenship</label>
                    <input type="text" name="mother_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Other Citizenship</label>
                    <input type="text" name="mother_other_citizenship" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">If Naturalized (Provide Date and Place)</label>
                    <input type="text" name="mother_naturalized_details" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
        </div>

        <!-- Children Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8" x-data="{ childCount: 0 }">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-child mr-3 text-[#D4AF37]"></i>
                Children Information
            </h3>
            <div class="mb-6 max-w-xs">
                <label for="child_count" class="block text-sm font-medium text-gray-700 mb-2">
                    Number of Children
                </label>
                <input type="number" min="0" max="20" name="child_count" id="child_count"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                    placeholder="Enter number of children"
                    x-model.number="childCount">
            </div>
            <template x-for="i in childCount" :key="i">
                <div class="border border-gray-200 rounded-lg p-4 mb-6">
                    <h4 class="text-lg font-medium text-[#1B365D] mb-4">Child <span x-text="i"></span></h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label :for="'children_' + (i-1) + '_first_name'" class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                            <input type="text" :name="'children[' + (i-1) + '][first_name]'" :id="'children_' + (i-1) + '_first_name'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label :for="'children_' + (i-1) + '_middle_name'" class="block text-sm font-medium text-gray-700 mb-1">Middle Name *</label>
                            <input type="text" :name="'children[' + (i-1) + '][middle_name]'" :id="'children_' + (i-1) + '_middle_name'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label :for="'children_' + (i-1) + '_last_name'" class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                            <input type="text" :name="'children[' + (i-1) + '][last_name]'" :id="'children_' + (i-1) + '_last_name'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label :for="'children_' + (i-1) + '_suffix'" class="block text-sm font-medium text-gray-700 mb-1">Suffix (e.g. Sr, IV, etc)</label>
                            <input type="text" :name="'children[' + (i-1) + '][suffix]'" :id="'children_' + (i-1) + '_suffix'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label :for="'children_' + (i-1) + '_birth_date'" class="block text-sm font-medium text-gray-700 mb-1">Date of Birth *</label>
                            <input type="date" :name="'children[' + (i-1) + '][birth_date]'" :id="'children_' + (i-1) + '_birth_date'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label :for="'children_' + (i-1) + '_birth_place'" class="block text-sm font-medium text-gray-700 mb-1">Place of Birth *</label>
                            <input type="text" :name="'children[' + (i-1) + '][birth_place]'" :id="'children_' + (i-1) + '_birth_place'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label :for="'children_' + (i-1) + '_occupation'" class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                            <input type="text" :name="'children[' + (i-1) + '][occupation]'" :id="'children_' + (i-1) + '_occupation'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label :for="'children_' + (i-1) + '_employer'" class="block text-sm font-medium text-gray-700 mb-1">Employer</label>
                            <input type="text" :name="'children[' + (i-1) + '][employer]'" :id="'children_' + (i-1) + '_employer'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label :for="'children_' + (i-1) + '_place_of_employment'" class="block text-sm font-medium text-gray-700 mb-1">Place of Employment</label>
                            <input type="text" :name="'children[' + (i-1) + '][place_of_employment]'" :id="'children_' + (i-1) + '_place_of_employment'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label :for="'children_' + (i-1) + '_citizenship'" class="block text-sm font-medium text-gray-700 mb-1">Citizenship</label>
                            <input type="text" :name="'children[' + (i-1) + '][citizenship]'" :id="'children_' + (i-1) + '_citizenship'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label :for="'children_' + (i-1) + '_other_citizenship'" class="block text-sm font-medium text-gray-700 mb-1">Other Citizenship</label>
                            <input type="text" :name="'children[' + (i-1) + '][other_citizenship]'" :id="'children_' + (i-1) + '_other_citizenship'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label :for="'children_' + (i-1) + '_naturalized_details'" class="block text-sm font-medium text-gray-700 mb-1">If Naturalized (Provide Date and Place)</label>
                            <input type="text" :name="'children[' + (i-1) + '][naturalized_details]'" :id="'children_' + (i-1) + '_naturalized_details'" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <a href="{{ route('phs.create') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Previous Section
            </a>
            
            <button type="submit" class="btn-primary">
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