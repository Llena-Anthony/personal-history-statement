@extends('layouts.phs-new')

@section('title', 'XII: Character and Reputation')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-user-shield text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">XII: Character and Reputation</h1>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('phs.character-and-reputation.store') }}" class="space-y-10">
        @csrf
        
        <!-- Character References Section -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-lg border border-gray-200">
                <h2 class="text-xl font-semibold text-[#1B365D] mb-4">A. Character References</h2>
                <p class="text-sm text-gray-600 mb-4">Give five (5) character references (known for three (3) years or longer except your relatives):</p>
                
                <div class="space-y-4">
                    @foreach ($characterReferences as $i => $reference)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Name {{ $i + 1 }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="character_references[{{ $i }}][name]" 
                                   value="{{ old('character_references.'.$i.'.name', $reference->ref_name ?? '') }}" 
                                   class="form-input" 
                                   placeholder="Full name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Address {{ $i + 1 }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="character_references[{{ $i }}][address]" 
                                   value="{{ old('character_references.'.$i.'.address', $reference->ref_address ?? '') }}" 
                                   class="form-input" 
                                   placeholder="Complete address">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Neighbors Section -->
            <div class="bg-white p-6 rounded-lg border border-gray-200">
                <h2 class="text-xl font-semibold text-[#1B365D] mb-4">B. Neighbors</h2>
                <p class="text-sm text-gray-600 mb-4">List down three (3) neighbors at your present residence:</p>
                
                <div class="space-y-4">
                    @foreach ($neighbors as $i => $neighbor)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Neighbor Name {{ $i + 1 }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="neighbors[{{ $i }}][name]" 
                                   value="{{ old('neighbors.'.$i.'.name', json_decode($neighbor->misc_details ?? '{}', true)['name'] ?? '') }}" 
                                   class="form-input" 
                                   placeholder="Full name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Neighbor Address {{ $i + 1 }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="neighbors[{{ $i }}][address]" 
                                   value="{{ old('neighbors.'.$i.'.address', json_decode($neighbor->misc_details ?? '{}', true)['address'] ?? '') }}" 
                                   class="form-input" 
                                   placeholder="Complete address">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('character-and-reputation')" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all shadow-none">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'character-and-reputation')">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

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
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        background-color: #1B365D;
        color: white;
        font-weight: 600;
        transition: background-color 0.2s;
    }
    .btn-primary:hover {
        background-color: #2B4B7D;
    }
    .btn-secondary {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        background-color: #f3f4f6;
        color: #1f2937;
        font-weight: 600;
        border: 1px solid #d1d5db;
        transition: background-color 0.2s;
    }
    .btn-secondary:hover {
        background-color: #e5e7eb;
    }
</style>
@endsection
@php($currentSection = 'character-and-reputation') 