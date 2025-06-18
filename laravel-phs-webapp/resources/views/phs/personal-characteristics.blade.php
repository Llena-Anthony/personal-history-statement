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
                    <span class="text-sm font-medium text-[#1B365D]">2/10</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-[#D4AF37] h-2 rounded-full" style="width: 20%"></div>
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
                        <a href="/phs/personal-characteristics" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors bg-[#1B365D]/5 font-bold text-[#1B365D]">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-[#D4AF37]">
                                <span class="text-xs text-white font-bold">II</span>
                            </span>
                            <span class="text-sm font-bold">Personal Characteristics</span>
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
                    <form method="POST" action="#" class="space-y-8">
                        @csrf
                        <!-- Sex, Age, Height, Weight -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Sex</label>
                                <select name="sex" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Age</label>
                                <input type="number" name="age" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Height (cm)</label>
                                <input type="number" name="height" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Weight (kg)</label>
                                <input type="number" name="weight" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                            </div>
                        </div>
                        <!-- Body Build, Complexion, Blood Type -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Body Build</label>
                                <select name="body_build" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Select</option>
                                    <option value="Slim">Slim</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Athletic">Athletic</option>
                                    <option value="Heavy">Heavy</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Complexion</label>
                                <select name="complexion" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Select</option>
                                    <option value="Fair">Fair</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Dark">Dark</option>
                                    <option value="Olive">Olive</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Blood Type</label>
                                <select name="blood_type" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Select</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>
                        <!-- Hair Color, Scar/Mark or Other Feature -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Hair Color</label>
                                <select name="hair_color" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Select</option>
                                    <option value="Black">Black</option>
                                    <option value="Brown">Brown</option>
                                    <option value="Blonde">Blonde</option>
                                    <option value="Red">Red</option>
                                    <option value="Gray">Gray</option>
                                    <option value="White">White</option>
                                </select>
                            </div>
                            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Scar/Mark or Other Feature</label>
                                <input type="text" name="scar_or_feature" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                            </div>
                        </div>
                        <!-- State of Health, Recent Serious Illness -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">State of Health</label>
                                <select name="state_of_health" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Select</option>
                                    <option value="Excellent">Excellent</option>
                                    <option value="Good">Good</option>
                                    <option value="Fair">Fair</option>
                                    <option value="Poor">Poor</option>
                                </select>
                            </div>
                            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Recent Serious Illness</label>
                                <input type="text" name="recent_illness" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                            </div>
                        </div>
                        <!-- Shoe Size, Cap Size -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Shoe Size</label>
                                <select name="shoe_size" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Select</option>
                                    <option value="5">5 (22 cm)</option>
                                    <option value="5.5">5.5 (22.5 cm)</option>
                                    <option value="6">6 (23 cm)</option>
                                    <option value="6.5">6.5 (23.5 cm)</option>
                                    <option value="7">7 (24 cm)</option>
                                    <option value="7.5">7.5 (24.5 cm)</option>
                                    <option value="8">8 (25 cm)</option>
                                    <option value="8.5">8.5 (25.5 cm)</option>
                                    <option value="9">9 (26 cm)</option>
                                    <option value="9.5">9.5 (26.5 cm)</option>
                                    <option value="10">10 (27 cm)</option>
                                    <option value="10.5">10.5 (27.5 cm)</option>
                                    <option value="11">11 (28 cm)</option>
                                    <option value="11.5">11.5 (28.5 cm)</option>
                                    <option value="12">12 (29 cm)</option>
                                    <option value="12.5">12.5 (29.5 cm)</option>
                                    <option value="13">13 (30 cm)</option>
                                    <option value="13.5">13.5 (30.5 cm)</option>
                                    <option value="14">14 (31 cm)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Cap Size</label>
                                <select name="cap_size" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Select</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                        </div>
                        <!-- Navigation Buttons -->
                        <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
                            <a href="{{ route('phs.create') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </a>
                            <button type="submit" class="px-6 py-2.5 rounded-lg bg-[#1B365D] text-white hover:bg-[#2B4B7D] transition-colors">
                                Next Section
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection 