@extends('layouts.phs-new')

@section('title', 'Personal Characteristics')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-user-tag text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Personal Characteristics</h1>
                <p class="text-gray-600">Please provide your physical attributes and health information</p>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('phs.personal-characteristics.store') }}" method="POST" class="space-y-8">
        @csrf
        
        <!-- Section 1: Physical Attributes -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user mr-3 text-[#D4AF37]"></i>
                Description
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Sex -->
                <div>
                    <label for="sex" class="block text-sm font-medium text-gray-700 mb-2">
                        Sex <span class="text-red-500">*</span>
                    </label>
                    <select name="sex" id="sex" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Sex</option>
                        <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('sex')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                <!-- Age -->
                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700 mb-2">
                        Age <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="age" id="age" value="{{ old('age') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter age" min="1" max="120">
                    @error('age')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                <!-- Height -->
                <div>
                    <label for="height" class="block text-sm font-medium text-gray-700 mb-2">
                        Height <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" step="0.01" name="height" id="height" value="{{ old('height') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                               placeholder="0.00" min="0.50" max="2.50">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <span class="text-gray-500 text-sm">meters</span>
                        </div>
                    </div>
                    @error('height')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                <!-- Weight -->
                <div>
                    <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">
                        Weight <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" step="0.01" name="weight" id="weight" value="{{ old('weight') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                               placeholder="0.00" min="20" max="300">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <span class="text-gray-500 text-sm">kg</span>
                        </div>
                    </div>
                    @error('weight')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                <!-- Body Build -->
                <div>
                    <label for="body_build" class="block text-sm font-medium text-gray-700 mb-2">
                        Body Build <span class="text-red-500">*</span>
                    </label>
                    <select name="body_build" id="body_build" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Body Build</option>
                        <option value="heavy" {{ old('body_build') == 'heavy' ? 'selected' : '' }}>Heavy</option>
                        <option value="medium" {{ old('body_build') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="light" {{ old('body_build') == 'light' ? 'selected' : '' }}>Light</option>
                    </select>
                    @error('body_build')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                <!-- Complexion -->
                <div>
                    <label for="complexion" class="block text-sm font-medium text-gray-700 mb-2">
                        Complexion <span class="text-red-500">*</span>
                    </label>
                    <select name="complexion" id="complexion" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Complexion</option>
                        <option value="dark" {{ old('complexion') == 'dark' ? 'selected' : '' }}>Dark</option>
                        <option value="fair" {{ old('complexion') == 'fair' ? 'selected' : '' }}>Fair</option>
                        <option value="light" {{ old('complexion') == 'light' ? 'selected' : '' }}>Light</option>
                    </select>
                    @error('complexion')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                <!-- Hair Color -->
                <div>
                    <label for="hair_color" class="block text-sm font-medium text-gray-700 mb-2">
                        Color of Hair <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="hair_color" id="hair_color" value="{{ old('hair_color') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter hair color">
                    @error('hair_color')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                <!-- Eye Color -->
                <div>
                    <label for="eye_color" class="block text-sm font-medium text-gray-700 mb-2">
                        Color of Eyes <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="eye_color" id="eye_color" value="{{ old('eye_color') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                           placeholder="Enter eye color">
                    @error('eye_color')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            
            <!-- Scars/Marks & Other Distinguishing Features -->
            <div class="mt-6">
                <label for="distinguishing_features" class="block text-sm font-medium text-gray-700 mb-2">
                    Scars, Marks & Other Distinguishing Features
                </label>
                <textarea name="distinguishing_features" id="distinguishing_features" rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                          placeholder="Describe any scars, marks, tattoos, or other distinguishing features...">{{ old('distinguishing_features') }}</textarea>
                @error('distinguishing_features')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        
        <!-- Section 2: Health Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-heartbeat mr-3 text-[#D4AF37]"></i>
                Physical Condition
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Present State of Health -->
                <div>
                    <label for="health_status" class="block text-sm font-medium text-gray-700 mb-2">
                        Present State of Health <span class="text-red-500">*</span>
                    </label>
                    <select name="health_status" id="health_status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Health Status</option>
                        <option value="excellent" {{ old('health_status') == 'excellent' ? 'selected' : '' }}>Excellent</option>
                        <option value="good" {{ old('health_status') == 'good' ? 'selected' : '' }}>Good</option>
                        <option value="poor" {{ old('health_status') == 'poor' ? 'selected' : '' }}>Poor</option>
                    </select>
                    @error('health_status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                <!-- Blood Type -->
                <div>
                    <label for="blood_type" class="block text-sm font-medium text-gray-700 mb-2">
                        Blood Type <span class="text-red-500">*</span>
                    </label>
                    <select name="blood_type" id="blood_type" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                        <option value="">Select Blood Type</option>
                        <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                        <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                        <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                        <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                        <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                        <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                        <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                        <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                    </select>
                    @error('blood_type')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            
            <!-- Recent Serious Illness -->
            <div class="mt-6">
                <label for="recent_illness" class="block text-sm font-medium text-gray-700 mb-2">
                    Recent Serious Illness
                </label>
                <textarea name="recent_illness" id="recent_illness" rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                          placeholder="Describe any recent serious illness, surgery, or medical conditions...">{{ old('recent_illness') }}</textarea>
                @error('recent_illness')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        
        <!-- Navigation -->
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