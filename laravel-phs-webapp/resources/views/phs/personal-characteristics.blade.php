@extends('layouts.app')

@section('title', 'II: Personal Characteristics - Personal History Statement')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 relative">
    <!-- Background Overlay -->
    <div class="absolute inset-0 bg-[url('/images/pma-background.jpg')] bg-cover bg-center bg-no-repeat opacity-10 blur-sm"></div>

    <div class="relative flex min-h-screen">
        <!-- Fixed Sidebar -->
        <aside class="w-72 bg-white shadow-lg fixed top-0 left-0 h-screen overflow-y-auto z-40 flex flex-col">
            <!-- User Profile Section -->
            <div class="p-6 border-b border-gray-200 bg-white flex flex-col items-center">
                <img src="/images/profile-placeholder.png" alt="User Photo" class="w-16 h-16 rounded-full object-cover mb-2">
                <div class="text-center">
                    <h3 class="text-base font-semibold text-gray-800">Gregorio Del Pilar</h3>
                    <p class="text-xs text-gray-500">Civilian</p>
                </div>
            </div>
            <!-- Navigation -->
            <nav class="flex-1 p-6 bg-white">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('phs.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.create') ? 'bg-green-500' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">I</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.create') ? 'font-bold' : 'font-medium' }}">Personal Details</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.personal-characteristics.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.personal-characteristics.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.personal-characteristics.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">II</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.personal-characteristics.create') ? 'font-bold' : 'font-medium' }}">Personal Characteristics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.marital-status.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.marital-status.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.marital-status.create') ? 'bg-green-500' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">III</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.marital-status.create') ? 'font-bold' : 'font-medium' }}">Marital Status</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.family-background.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.family-background.create') ? 'font-bold text-gray-900' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.family-background.create') ? 'bg-yellow-400' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">IV</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.family-background.create') ? 'font-bold' : 'font-medium' }}">Family History and Information</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                            <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                                <span class="text-xs text-white">V</span>
                            </span>
                            <span class="text-gray-400">Educational Background</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                            <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                                <span class="text-xs text-white">VI</span>
                            </span>
                            <span class="text-gray-400">Military History</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                            <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                                <span class="text-xs text-white">VII</span>
                            </span>
                            <span class="text-gray-400">Places of Residence Since Birth</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                            <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                                <span class="text-xs text-white">VIII</span>
                            </span>
                            <span class="text-gray-400">Employment History</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                            <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                                <span class="text-xs text-white">IX</span>
                            </span>
                            <span class="text-gray-400">Foreign Countries Visited</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-72 p-8 mt-16">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg p-8 mb-8 pb-24">
                    <h2 class="text-2xl font-bold text-[#1B365D] mb-8 flex items-center">
                        <i class="fas fa-user-circle mr-3 text-[#D4AF37]"></i>
                        II: Personal Characteristics
                    </h2>

                    <form method="POST" action="{{ route('phs.personal-characteristics.store') }}" class="space-y-8">
                        @csrf

                        <!-- Physical Characteristics -->
                        <fieldset class="bg-gray-50/80 backdrop-blur-sm rounded-lg p-6 border border-gray-100">
                            <legend class="text-lg font-semibold text-[#1B365D] mb-4 px-2">Physical Characteristics</legend>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Height (cm)</label>
                                    <input type="number" name="height" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                                    <input type="number" name="weight" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Body Build</label>
                                    <select name="body_build" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                        <option value="">Select Body Build</option>
                                        <option value="Ectomorph">Ectomorph</option>
                                        <option value="Mesomorph">Mesomorph</option>
                                        <option value="Endomorph">Endomorph</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Complexion</label>
                                    <input type="text" name="complexion" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                            </div>
                        </fieldset>

                        <!-- Physical Features -->
                        <fieldset class="bg-gray-50/80 backdrop-blur-sm rounded-lg p-6 border border-gray-100">
                            <legend class="text-lg font-semibold text-[#1B365D] mb-4 px-2">Physical Features</legend>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Eye Color</label>
                                    <input type="text" name="eye_color" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Hair Color</label>
                                    <input type="text" name="hair_color" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Blood Type</label>
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
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Cap Size</label>
                                    <select name="cap_size" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                        <option value="">Select Cap Size</option>
                                        <option value="6">6</option>
                                        <option value="6 1/2">6 1/2</option>
                                        <option value="7">7</option>
                                        <option value="7 1/2">7 1/2</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Health Information -->
                        <fieldset class="bg-gray-50/80 backdrop-blur-sm rounded-lg p-6 border border-gray-100">
                            <legend class="text-lg font-semibold text-[#1B365D] mb-4 px-2">Health Information</legend>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">State of Health</label>
                                    <select name="state_of_health" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                        <option value="">Select State of Health</option>
                                        <option value="Excellent">Excellent</option>
                                        <option value="Good">Good</option>
                                        <option value="Fair">Fair</option>
                                        <option value="Poor">Poor</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Identifying Marks</label>
                                    <input type="text" name="identifying_marks" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                            </div>
                        </fieldset>

                        @include('phs.components.form-navigation', [
                            'previousRoute' => route('phs.create'),
                            'nextRoute' => route('phs.marital-status.create'),
                            'previousText' => 'Previous Section',
                            'nextText' => 'Next Section'
                        ])
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection 