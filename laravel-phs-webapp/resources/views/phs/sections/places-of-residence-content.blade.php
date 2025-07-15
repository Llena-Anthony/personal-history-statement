@extends('layouts.phs-new')

@section('title', 'VII: Places of Residence Since Birth')

@section('content')
@php
    $sectionOrder = [
        'personal-details',
        'personal-characteristics',
        'marital-status',
        'family-background',
        'educational-background',
        'military-history',
        'places-of-residence',
        'employment-history',
        'foreign-countries',
        'credit-reputation',
        'arrest-record',
        'character-and-reputation',
        'organization',
        'miscellaneous'
    ];
    $sectionName = 'places-of-residence';
    $currentIndex = array_search($sectionName, $sectionOrder);
    $previousSection = $currentIndex > 0 ? $sectionOrder[$currentIndex - 1] : null;
    $previousSectionRoute = $previousSection ? route('phs.' . $previousSection . '.create') : route('client.dashboard');
@endphp
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-home text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">VII: Places of Residence Since Birth</h1>
                <p class="text-gray-600">List all places you have resided in since birth</p>
            </div>
        </div>
    </div>

    <form id="places-of-residence-form" action="{{ route('phs.places-of-residence.store') }}" method="POST" onsubmit="return handleFormSubmit(event, 'places-of-residence')">
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">From (Year)</label>
                            <input type="number" name="residences[0][from]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030" value="{{ old('residences.0.from', $residence->from ?? '') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">To (Year)</label>
                            <input type="number" name="residences[0][to]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030" value="{{ old('residences.0.to', $residence->to ?? '') }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Region</label>
                            <select name="residences[0][region]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" onchange="loadProvinces('residences[0]')">
                                <option value="">Select Region</option>
                                {{-- Populate with regions dynamically or server-side --}}
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Province</label>
                            <select name="residences[0][province]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" onchange="loadCities('residences[0]')">
                                <option value="">Select Province</option>
                                {{-- Populate with provinces dynamically or server-side --}}
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">City/Municipality</label>
                            <select name="residences[0][city]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" onchange="loadBarangays('residences[0]')">
                                <option value="">Select City/Municipality</option>
                                {{-- Populate with cities dynamically or server-side --}}
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Barangay</label>
                            <select name="residences[0][barangay]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                <option value="">Select Barangay</option>
                                {{-- Populate with barangays dynamically or server-side --}}
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Street Address</label>
                            <input type="text" name="residences[0][street]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter street address" value="{{ old('residences.0.street', $residence->street ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-residence" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Residence
            </button>
        </div>

        <!-- Initialize dynamic functionality after AJAX load -->
        <script>
            function runPHSResidenceInitWhenReady() {
                if (typeof window.initializePlacesOfResidence === 'function') {
                    console.log('PHS: initializePlacesOfResidence found, running...');
                    window.initializePlacesOfResidence();
                } else {
                    console.log('PHS: initializePlacesOfResidence not yet defined, retrying...');
                    setTimeout(runPHSResidenceInitWhenReady, 100);
                }
            }
            runPHSResidenceInitWhenReady();
        </script>
        <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
            <a href="{{ $previousSectionRoute }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Back to Previous Section
            </a>
            <button type="submit" class="btn-primary">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>
@endsection 