@extends('layouts.phs-new')

@section('title', 'Character and Reputation')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-puzzle-piece text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">XII: Character and Reputation</h1>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('phs.character-and-reputation.store') }}" class="space-y-10">
        @csrf
        
        <!-- Questions -->
        <div class="space-y-6">
            <div>
                <label for="misc_type" class="block font-medium text-gray-800 mb-1">Type</label>
                <input type="text" name="misc_type" id="misc_type" class="form-input" placeholder="e.g., Hobbies, Skills, Awards (if not military)" value="{{ old('misc_type', $miscellaneous->misc_type ?? '') }}">
            </div>
            <div>
                <label for="misc_details" class="block font-medium text-gray-800 mb-1">Details</label>
                <p class="text-sm text-gray-600 mb-2">Please provide any other information that you believe should be included in this statement to assist in determining your qualifications for a position of trust. If none, write "NONE".</p>
                <textarea name="misc_details" id="misc_details" rows="6" class="form-input" placeholder="Type here...">{{ old('misc_details', $miscellaneous->misc_details ?? '') }}</textarea>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('miscellaneous')" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all shadow-none">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="submit" class="btn-primary">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>
@endsection
@php($currentSection = 'miscellaneous') 