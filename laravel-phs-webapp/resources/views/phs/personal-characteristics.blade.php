@extends('layouts.app')

@section('title', 'Personal Characteristics - Personal History Statement')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Fixed Sidebar -->
    <div class="w-72 bg-white shadow-lg fixed overflow-y-auto" style="position: fixed; top: 64px; left: 0; z-index: 40; height: calc(100vh - 64px);">
        <!-- User Profile Section -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-gray-500 text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Gregorio Del Pilar</h3>
                    <p class="text-sm text-gray-500">Civilian</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="p-6">
            <ul class="space-y-6">
                <li>
                    <a href="{{ route('phs.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">I</span>
                        </span>
                        <span class="text-gray-400">Personal Details</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.personal-characteristics.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-yellow-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">II</span>
                        </span>
                        <span class="text-black">Personal Characteristics</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">III</span>
                        </span>
                        <span class="text-gray-400">Marital Status</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">IV</span>
                        </span>
                        <span class="text-gray-400">Family History and Information</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">V</span>
                        </span>
                        <span class="text-gray-400">Educational Background</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VI</span>
                        </span>
                        <span class="text-gray-400">Military History</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VII</span>
                        </span>
                        <span class="text-gray-400">Places of Residence Since Birth</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VIII</span>
                        </span>
                        <span class="text-gray-400">Employment History</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">IX</span>
                        </span>
                        <span class="text-gray-400">Foreign Countries Visited</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-72 p-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-[#1B365D] mb-6 flex items-center">
                    <i class="fas fa-user-circle mr-3 text-[#D4AF37]"></i>
                    Personal Characteristics
                </h2>

                <form method="POST" action="{{ route('phs.personal-characteristics.store') }}" class="space-y-8">
                    @csrf

                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Sex -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sex</label>
                                <select name="sex" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <!-- Age -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                                <input type="number" name="age" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>

                            <!-- Height -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Height (meters)</label>
                                <input type="number" step="0.01" name="height" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>

                            <!-- Weight -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Weight (kg)</label>
                                <input type="number" name="weight" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>

                            <!-- Body Build -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Body Build</label>
                                <select name="body_build" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Body Build</option>
                                    <option value="slim">Slim</option>
                                    <option value="medium">Medium</option>
                                    <option value="athletic">Athletic</option>
                                    <option value="heavy">Heavy</option>
                                </select>
                            </div>

                            <!-- Complexion -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Complexion</label>
                                <select name="complexion" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Complexion</option>
                                    <option value="fair">Fair</option>
                                    <option value="medium">Medium</option>
                                    <option value="dark">Dark</option>
                                    <option value="olive">Olive</option>
                                </select>
                            </div>

                            <!-- Blood Type -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Blood Type</label>
                                <select name="blood_type" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Blood Type</option>
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

                            <!-- Hair Color -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Hair Color</label>
                                <select name="hair_color" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Hair Color</option>
                                    <option value="black">Black</option>
                                    <option value="brown">Brown</option>
                                    <option value="blonde">Blonde</option>
                                    <option value="red">Red</option>
                                    <option value="gray">Gray</option>
                                    <option value="white">White</option>
                                </select>
                            </div>

                            <!-- Scar/Mark -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Scar/Mark or Other Distinguishing Feature</label>
                                <textarea name="distinguishing_features" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors"></textarea>
                            </div>

                            <!-- Present State of Health -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Present State of Health</label>
                                <select name="health_status" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Health Status</option>
                                    <option value="excellent">Excellent</option>
                                    <option value="good">Good</option>
                                    <option value="fair">Fair</option>
                                    <option value="poor">Poor</option>
                                </select>
                            </div>

                            <!-- Recent Serious Illness -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Recent Serious Illness</label>
                                <input type="text" name="recent_illness" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>

                            <!-- Shoe Size -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Shoe Size (US)</label>
                                <input type="number" step="0.5" name="shoe_size" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>

                            <!-- Cap Size -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Cap Size</label>
                                <select name="cap_size" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Cap Size</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('phs.create') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                            Previous Section
                        </a>
                        <a href="{{ route('phs.marital-status.create') }}" class="px-6 py-2.5 rounded-lg bg-[#1B365D] text-white hover:bg-[#2B4B7D] transition-colors">
                            Next Section
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 