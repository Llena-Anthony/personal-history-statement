@extends('layouts.phs-new')

@section('title', 'VII: Places of Residence Since Birth')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-home text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Places of Residence Since Birth</h1>
                <p class="text-gray-600">List all places you have resided in since birth</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('phs.places-of-residence.store') }}" class="space-y-8">
        @csrf
        
        <!-- Residence History -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                    <i class="fas fa-map-marker-alt mr-3 text-[#D4AF37]"></i>
                    Residence History
                </h3>
            </div>
            <div id="residences-container" class="space-y-4">
                <!-- Initial residence entry (default, not removable) -->
                <div class="residence-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">From (Year)</label>
                            <input type="number" name="residences[0][from]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">To (Year)</label>
                            <input type="number" name="residences[0][to]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" name="residences[0][address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-residence" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Residence
            </button>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('places-of-residence')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'places-of-residence')">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Residence History functionality
        const residencesContainer = document.getElementById('residences-container');
        const addResidenceBtn = document.getElementById('add-residence');

        addResidenceBtn.addEventListener('click', () => {
            const entries = residencesContainer.querySelectorAll('.residence-entry');
            const idx = entries.length;
            const residenceEntry = document.createElement('div');
            residenceEntry.className = 'residence-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
            residenceEntry.setAttribute('data-index', idx);
            residenceEntry.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">From (Year)</label>
                        <input type="number" name="residences[${idx}][from]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">To (Year)</label>
                        <input type="number" name="residences[${idx}][to]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <input type="text" name="residences[${idx}][address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address">
                    </div>
                </div>
                <button type="button" class="remove-residence absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
            `;
            residencesContainer.appendChild(residenceEntry);
        });

        residencesContainer.addEventListener('click', (e) => {
            if (e.target.closest('.remove-residence')) {
                const entries = residencesContainer.querySelectorAll('.residence-entry');
                if (entries.length > 1) {
                    e.target.closest('.residence-entry').remove();
                }
            }
        });
    });
</script>
@endsection
@php($currentSection = 'places-of-residence') 