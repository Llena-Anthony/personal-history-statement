@extends('layouts.app')

@section('title', 'Personal Characteristics - Personal History Statement')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 relative">
    <!-- Background Overlay -->
    <div class="absolute inset-0 bg-[url('/images/pma-background.jpg')] bg-cover bg-center bg-no-repeat opacity-10 blur-sm"></div>

    <div class="relative flex min-h-screen">
        <!-- Fixed Sidebar -->
        <aside class="w-72 bg-white shadow-lg fixed top-0 left-0 h-screen overflow-y-auto z-40 flex flex-col">
            <!-- User Profile Section -->
            <div class="p-6 border-b border-gray-200 bg-white flex flex-col items-center">
                <div class="relative mb-3">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-[#D4AF37]">
                        <img src="/images/profile-placeholder.png" alt="User Photo" 
                            class="w-full h-full object-cover object-center transform scale-110">
                    </div>
                    <div class="absolute bottom-0 right-0 bg-green-500 w-4 h-4 rounded-full border-2 border-white"></div>
                </div>
                <div class="text-center">
                    <h3 class="text-base font-semibold text-gray-800">Gregorio Del Pilar</h3>
                    <p class="text-xs text-gray-500">Civilian</p>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-600">Progress</span>
                    <span class="text-sm font-medium text-[#1B365D]">2/9</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: 22%"></div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-6 bg-white">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('phs.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">I</span>
                            </span>
                            <span class="text-sm font-medium">Personal Details</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.personal-characteristics.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.personal-characteristics.create') ? 'bg-[#1B365D]/5 font-bold text-[#1B365D]' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.personal-characteristics.create') ? 'bg-[#D4AF37]' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">II</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.personal-characteristics.create') ? 'font-bold' : 'font-medium' }}">Personal Characteristics</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">III</span>
                            </span>
                            <span class="text-sm font-medium">Marital Status</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">IV</span>
                            </span>
                            <span class="text-sm font-medium">Family History and Information</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">V</span>
                            </span>
                            <span class="text-sm font-medium">Educational Background</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">VI</span>
                            </span>
                            <span class="text-sm font-medium">Military History</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">VII</span>
                            </span>
                            <span class="text-sm font-medium">Places of Residence Since Birth</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">VIII</span>
                            </span>
                            <span class="text-sm font-medium">Employment History</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">IX</span>
                            </span>
                            <span class="text-sm font-medium">Foreign Countries Visited</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">X</span>
                            </span>
                            <span class="text-sm font-medium">Credit Reputation</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-72 p-8 mt-16">
            <div class="max-w-5xl mx-auto">
                <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg p-8 mb-8">
                    <!-- Section Title -->
                    <h2 class="text-3xl font-extrabold text-[#1B365D] mb-8">II: Personal Characteristics</h2>

                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-500"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('phs.personal-characteristics.store') }}" method="POST" class="space-y-8">
                        @csrf
                        
                        <!-- Form Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 gap-y-6">
                            <!-- Height -->
                            <div>
                                <label for="height" class="block text-sm font-medium text-gray-700 mb-1">
                                    Height
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" step="0.01" name="height" id="height" 
                                        value="{{ old('height') }}"
                                        class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]"
                                        placeholder="0.00">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="text-gray-500 text-sm">cm</span>
                                    </div>
                                </div>
                                @error('height')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Weight -->
                            <div>
                                <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">
                                    Weight
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" step="0.01" name="weight" id="weight" 
                                        value="{{ old('weight') }}"
                                        class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]"
                                        placeholder="0.00">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="text-gray-500 text-sm">kg</span>
                                    </div>
                                </div>
                                @error('weight')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Blood Type -->
                            <div>
                                <label for="blood_type" class="block text-sm font-medium text-gray-700 mb-1">
                                    Blood Type
                                    <span class="text-red-500">*</span>
                                </label>
                                <select name="blood_type" id="blood_type" 
                                    class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Please Select</option>
                                    <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                                    <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                </select>
                                @error('blood_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Hair Color -->
                            <div>
                                <label for="hair_color" class="block text-sm font-medium text-gray-700 mb-1">
                                    Hair Color
                                    <span class="text-red-500">*</span>
                                </label>
                                <select name="hair_color" id="hair_color" 
                                    class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Please Select</option>
                                    <option value="Black" {{ old('hair_color') == 'Black' ? 'selected' : '' }}>Black</option>
                                    <option value="Brown" {{ old('hair_color') == 'Brown' ? 'selected' : '' }}>Brown</option>
                                    <option value="Blonde" {{ old('hair_color') == 'Blonde' ? 'selected' : '' }}>Blonde</option>
                                    <option value="Gray" {{ old('hair_color') == 'Gray' ? 'selected' : '' }}>Gray</option>
                                    <option value="White" {{ old('hair_color') == 'White' ? 'selected' : '' }}>White</option>
                                    <option value="Other" {{ old('hair_color') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('hair_color')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Eye Color -->
                            <div>
                                <label for="eye_color" class="block text-sm font-medium text-gray-700 mb-1">
                                    Eye Color
                                    <span class="text-red-500">*</span>
                                </label>
                                <select name="eye_color" id="eye_color" 
                                    class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Please Select</option>
                                    <option value="Brown" {{ old('eye_color') == 'Brown' ? 'selected' : '' }}>Brown</option>
                                    <option value="Black" {{ old('eye_color') == 'Black' ? 'selected' : '' }}>Black</option>
                                    <option value="Blue" {{ old('eye_color') == 'Blue' ? 'selected' : '' }}>Blue</option>
                                    <option value="Green" {{ old('eye_color') == 'Green' ? 'selected' : '' }}>Green</option>
                                    <option value="Hazel" {{ old('eye_color') == 'Hazel' ? 'selected' : '' }}>Hazel</option>
                                    <option value="Other" {{ old('eye_color') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('eye_color')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Complexion -->
                            <div>
                                <label for="complexion" class="block text-sm font-medium text-gray-700 mb-1">
                                    Complexion
                                    <span class="text-red-500">*</span>
                                </label>
                                <select name="complexion" id="complexion" 
                                    class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Please Select</option>
                                    <option value="Fair" {{ old('complexion') == 'Fair' ? 'selected' : '' }}>Fair</option>
                                    <option value="Light" {{ old('complexion') == 'Light' ? 'selected' : '' }}>Light</option>
                                    <option value="Medium" {{ old('complexion') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="Tan" {{ old('complexion') == 'Tan' ? 'selected' : '' }}>Tan</option>
                                    <option value="Dark" {{ old('complexion') == 'Dark' ? 'selected' : '' }}>Dark</option>
                                </select>
                                @error('complexion')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Identifying Marks -->
                            <div class="col-span-full">
                                <label for="identifying_marks" class="block text-sm font-medium text-gray-700 mb-1">
                                    Identifying Marks
                                    <span class="text-gray-500 text-sm">(e.g., scars, tattoos, birthmarks)</span>
                                </label>
                                <textarea name="identifying_marks" id="identifying_marks" rows="3" 
                                    class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]"
                                    placeholder="Describe any visible identifying marks...">{{ old('identifying_marks') }}</textarea>
                                @error('identifying_marks')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-end space-x-4 pt-4">
                            <a href="{{ route('phs.create') }}" 
                                class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                                Previous
                            </a>
                            <button type="submit" 
                                class="px-6 py-2.5 rounded-lg bg-[#1B365D] hover:bg-[#2B4B7D] text-white transition-colors">
                                Next
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection 