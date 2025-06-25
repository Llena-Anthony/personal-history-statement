@extends('layouts.phs-new')

@section('title', 'XII: Character and Reputation')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-user-shield text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Character and Reputation</h1>
                <p class="text-gray-600">Please provide your character references and neighbor information.</p>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('phs.character-and-reputation.store') }}" class="space-y-8">
        @csrf
        
        <!-- Character References Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-friends mr-3 text-[#D4AF37]"></i>
                Character References
            </h3>
            <p class="text-sm text-gray-600 mb-6">Give five (5) character references (known for three (3) years or longer except your relatives):</p>
            
            <div class="space-y-6">
                @foreach ($characterReferences as $i => $reference)
                <div class="p-4 border border-gray-200 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Name {{ $i + 1 }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="character_references[{{ $i }}][name]" 
                                   value="{{ old('character_references.'.$i.'.name', $reference->ref_name ?? '') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" 
                                   placeholder="Enter full name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Address {{ $i + 1 }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="character_references[{{ $i }}][address]" 
                                   value="{{ old('character_references.'.$i.'.address', $reference->ref_address ?? '') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" 
                                   placeholder="Enter complete address">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Neighbors Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-home mr-3 text-[#D4AF37]"></i>
                Neighbors
            </h3>
            <p class="text-sm text-gray-600 mb-6">List down three (3) neighbors at your present residence:</p>
            
            <div class="space-y-6">
                @foreach ($neighbors as $i => $neighbor)
                <div class="p-4 border border-gray-200 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Neighbor Name {{ $i + 1 }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="neighbors[{{ $i }}][name]" 
                                   value="{{ old('neighbors.'.$i.'.name', json_decode($neighbor->misc_details ?? '{}', true)['name'] ?? '') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" 
                                   placeholder="Enter full name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Neighbor Address {{ $i + 1 }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="neighbors[{{ $i }}][address]" 
                                   value="{{ old('neighbors.'.$i.'.address', json_decode($neighbor->misc_details ?? '{}', true)['address'] ?? '') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" 
                                   placeholder="Enter complete address">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
            <a href="{{ route('phs.arrest-record') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </a>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'character-and-reputation')">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

@push('styles')
<style>
    .form-input {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        width: 100%;
        transition: box-shadow 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }
    .form-input:focus {
        border-color: #1B365D;
        box-shadow: 0 0 0 2px rgba(27, 54, 93, 0.3);
        outline: none;
    }
    .btn-primary {
        @apply inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all;
    }
    .btn-secondary {
        @apply inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all;
    }
</style>
@endpush

@endsection
@php($currentSection = 'character-and-reputation') 