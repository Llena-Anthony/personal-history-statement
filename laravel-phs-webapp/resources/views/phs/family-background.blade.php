@extends('layouts.app')

@section('title', 'IV: Family History and Information - Personal History Statement')

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
                        <i class="fas fa-users mr-3 text-[#D4AF37]"></i>
                        IV: Family History and Information
                    </h2>

                    <form method="POST" action="{{ route('phs.family-background.store') }}" class="space-y-8">
                        @csrf

                        <!-- Father's Information -->
                        <fieldset class="bg-gray-50/80 backdrop-blur-sm rounded-lg p-6 border border-gray-100">
                            <legend class="text-lg font-semibold text-[#1B365D] mb-4 px-2">Father's Information</legend>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input type="text" name="father_last_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input type="text" name="father_first_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                                    <input type="text" name="father_middle_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Occupation</label>
                                    <input type="text" name="father_occupation" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                            </div>
                        </fieldset>

                        <!-- Mother's Information -->
                        <fieldset class="bg-gray-50/80 backdrop-blur-sm rounded-lg p-6 border border-gray-100">
                            <legend class="text-lg font-semibold text-[#1B365D] mb-4 px-2">Mother's Information</legend>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input type="text" name="mother_last_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input type="text" name="mother_first_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                                    <input type="text" name="mother_middle_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Occupation</label>
                                    <input type="text" name="mother_occupation" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                            </div>
                        </fieldset>

                        <!-- Siblings Information -->
                        <fieldset class="bg-gray-50/80 backdrop-blur-sm rounded-lg p-6 border border-gray-100">
                            <legend class="text-lg font-semibold text-[#1B365D] mb-4 px-2">Siblings Information</legend>
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" name="sibling_names[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Age</label>
                                        <input type="number" name="sibling_ages[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Sex</label>
                                        <select name="sibling_sexes[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                            <option value="">Select Sex</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="block text-sm font-medium text-gray-700">Occupation</label>
                                        <input type="text" name="sibling_occupations[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                </div>
                                <button type="button" class="text-[#D4AF37] hover:text-[#B38F2A] transition-colors text-sm font-medium">
                                    <i class="fas fa-plus mr-1"></i> Add Another Sibling
                                </button>
                            </div>
                        </fieldset>

                        @include('phs.components.form-navigation', [
                            'previousRoute' => route('phs.marital-status.create'),
                            'nextRoute' => route('phs.educational-background.create'),
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