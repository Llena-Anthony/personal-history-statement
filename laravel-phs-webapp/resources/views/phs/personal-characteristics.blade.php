@extends('layouts.phs-new')

@section('title', 'Personal Characteristics')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-user-tag text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Personal Characteristics</h1>
                <p class="text-gray-600">Please provide your physical attributes</p>
            </div>
        </div>
    </div>
    <form action="{{ route('phs.personal-characteristics.store') }}" method="POST" class="space-y-8">
        @csrf
        <!-- Form Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Height -->
            <div>
                <label for="height" class="block text-sm font-medium text-gray-700 mb-1">Height <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="number" step="0.01" name="height" id="height" value="{{ old('height') }}" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="0.00">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3"><span class="text-gray-500 text-sm">cm</span></div>
                </div>
                @error('height')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <!-- Weight -->
            <div>
                <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Weight <span class="text-red-500">*</span></label>
                <div class="relative">
                    <input type="number" step="0.01" name="weight" id="weight" value="{{ old('weight') }}" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="0.00">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3"><span class="text-gray-500 text-sm">kg</span></div>
                </div>
                @error('weight')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <!-- Blood Type -->
            <div>
                <label for="blood_type" class="block text-sm font-medium text-gray-700 mb-1">Blood Type</label>
                <input type="text" name="blood_type" id="blood_type" value="{{ old('blood_type') }}" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="A, B, AB, O">
                @error('blood_type')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <!-- Eye Color -->
            <div>
                <label for="eye_color" class="block text-sm font-medium text-gray-700 mb-1">Eye Color</label>
                <input type="text" name="eye_color" id="eye_color" value="{{ old('eye_color') }}" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Brown, Black, etc.">
                @error('eye_color')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <!-- Hair Color -->
            <div>
                <label for="hair_color" class="block text-sm font-medium text-gray-700 mb-1">Hair Color</label>
                <input type="text" name="hair_color" id="hair_color" value="{{ old('hair_color') }}" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Black, Brown, etc.">
                @error('hair_color')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <!-- Complexion -->
            <div>
                <label for="complexion" class="block text-sm font-medium text-gray-700 mb-1">Complexion</label>
                <input type="text" name="complexion" id="complexion" value="{{ old('complexion') }}" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Fair, Medium, Dark, etc.">
                @error('complexion')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <a href="{{ route('phs.create') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </a>
            <button type="submit" class="btn-primary">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>
@endsection

{{-- Pass currentSection to layout --}}
@php($currentSection = 'personal-characteristics') 