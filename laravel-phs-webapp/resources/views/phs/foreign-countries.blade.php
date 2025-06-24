@extends('layouts.phs-new')

@section('title', 'IX: Foreign Countries Visited')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-globe-asia text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Foreign Countries Visited</h1>
                <p class="text-gray-600">List all foreign countries you have visited.</p>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('phs.foreign-countries.store') }}" class="space-y-8">
        @csrf
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-globe-asia mr-3 text-[#D4AF37]"></i>
                Countries Visited
            </h3>
            <div id="countries" class="space-y-4">
                <div class="country-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Visit (From)</label>
                            <input type="month" name="countries[0][from]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter month/year">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Visit (To)</label>
                            <input type="month" name="countries[0][to]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter month/year">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Country Visited</label>
                            <input type="text" name="countries[0][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter country visited">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Purpose of Visit</label>
                            <input type="text" name="countries[0][purpose]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter purpose of visit">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Address Abroad</label>
                            <input type="text" name="countries[0][address_abroad]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter address abroad">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-country" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Country
            </button>
        </div>
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('foreign-countries')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'foreign-countries')">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const countriesContainer = document.getElementById('countries');
    const addCountryBtn = document.getElementById('add-country');

    addCountryBtn.addEventListener('click', () => {
        const entries = countriesContainer.querySelectorAll('.country-entry');
        const idx = entries.length;
        const countryEntry = document.createElement('div');
        countryEntry.className = 'country-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
        countryEntry.setAttribute('data-index', idx);
        countryEntry.innerHTML = `
            <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6\">
                <div>
                    <label class=\"block text-sm font-medium text-gray-700 mb-1\">Date of Visit (From)</label>
                    <input type=\"month\" name=\"countries[${idx}][from]\" class=\"w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]\" placeholder=\"Enter month/year\">
                </div>
                <div>
                    <label class=\"block text-sm font-medium text-gray-700 mb-1\">Date of Visit (To)</label>
                    <input type=\"month\" name=\"countries[${idx}][to]\" class=\"w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]\" placeholder=\"Enter month/year\">
                </div>
                <div class=\"md:col-span-2\">
                    <label class=\"block text-sm font-medium text-gray-700 mb-1\">Country Visited</label>
                    <input type=\"text\" name=\"countries[${idx}][name]\" class=\"w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]\" placeholder=\"Enter country visited\">
                </div>
                <div class=\"md:col-span-2\">
                    <label class=\"block text-sm font-medium text-gray-700 mb-1\">Purpose of Visit</label>
                    <input type=\"text\" name=\"countries[${idx}][purpose]\" class=\"w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]\" placeholder=\"Enter purpose of visit\">
                </div>
                <div class=\"md:col-span-2\">
                    <label class=\"block text-sm font-medium text-gray-700 mb-1\">Address Abroad</label>
                    <input type=\"text\" name=\"countries[${idx}][address_abroad]\" class=\"w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]\" placeholder=\"Enter address abroad\">
                </div>
            </div>
            <button type=\"button\" class=\"remove-country absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors\"><i class=\"fas fa-times-circle\"></i></button>
        `;
        countriesContainer.appendChild(countryEntry);
    });

    countriesContainer.addEventListener('click', (e) => {
        if (e.target.closest('.remove-country')) {
            const entries = countriesContainer.querySelectorAll('.country-entry');
            if (entries.length > 1) {
                e.target.closest('.country-entry').remove();
            }
        }
    });
});
</script>
@endsection
@php($currentSection = 'foreign-countries') 