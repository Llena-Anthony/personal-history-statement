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
                <h1 class="text-3xl font-bold text-[#1B365D]">Places of Residence Since Birth</h1>
                <p class="text-gray-600">List all places you have resided in since birth</p>
            </div>
        </div>
    </div>

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
                        <input type="number" name="residences[0][from]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030" value="{{ old('residences.0.from', $residence->from ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">To (Year)</label>
                        <input type="number" name="residences[0][to]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="YYYY" min="1900" max="2030" value="{{ old('residences.0.to', $residence->to ?? '') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <input type="text" name="residences[0][address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter complete address" value="{{ old('residences.0.address', $residence->address ?? '') }}">
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
        if (typeof window.initializePlacesOfResidence === 'function') {
            window.initializePlacesOfResidence();
        }
    </script>
    <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
        <a href="{{ $previousSectionRoute }}" class="btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Back to Previous Section
        </a>
        <button type="submit" class="btn-primary">
            Save & Continue <i class="fas fa-arrow-right ml-2"></i>
        </button>
    </div>
</div>
@endsection 