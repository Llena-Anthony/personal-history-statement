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
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-[#1B365D]">Countries Visited</h3>
                <button type="button" id="addCountry" class="px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] transition-colors">
                    <i class="fas fa-plus mr-2"></i>Add Country
                </button>
            </div>
            <div id="countries" class="space-y-4">
                <div class="country p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <input type="text" name="countries[0][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">From (Year)</label>
                            <input type="number" name="countries[0][from]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">To (Year)</label>
                            <input type="number" name="countries[0][to]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('foreign-countries')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'foreign-countries')">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>
@endsection
@php($currentSection = 'foreign-countries') 