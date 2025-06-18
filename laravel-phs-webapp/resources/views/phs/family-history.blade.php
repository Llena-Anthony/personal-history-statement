@extends('layouts.app')

@section('title', 'Family History - Personal History Statement')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 relative">
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
                    <span class="text-sm font-medium text-[#1B365D]">4/10</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-[#D4AF37] h-2 rounded-full" style="width: 40%"></div>
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
                        <a href="{{ route('phs.personal-characteristics.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">II</span>
                            </span>
                            <span class="text-sm font-medium">Personal Characteristics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.marital-status.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">III</span>
                            </span>
                            <span class="text-sm font-medium">Marital Status</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors bg-[#1B365D]/5 font-bold text-[#1B365D]">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-[#D4AF37]">
                                <span class="text-xs text-white font-bold">IV</span>
                            </span>
                            <span class="text-sm font-bold">Family History and Information</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('phs.educational-background.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
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
                </ul>
            </nav>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 ml-72 p-8 mt-16">
            <div class="max-w-5xl mx-auto">
                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg p-8 mb-8">
                    <h2 class="text-3xl font-extrabold text-[#1B365D] mb-8">IV: Family History and Information</h2>
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
                    <form method="POST" action="{{ route('phs.family-history.store') }}" class="space-y-8">
                        @csrf
                        <!-- Father Details Section -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Father Details</h3>
                            <!-- Name Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">First Name</label>
                                    <input type="text" name="father_first_name" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Middle Name</label>
                                    <input type="text" name="father_middle_name" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Last Name</label>
                                    <input type="text" name="father_last_name" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Suffix</label>
                                    <input type="text" name="father_suffix" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                            </div>
                            <!-- Birth Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Date of Birth</label>
                                    <input type="date" name="father_birth_date" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Place of Birth</label>
                                    <input type="text" name="father_birth_place" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                            </div>
                            <!-- Employment Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Occupation</label>
                                    <input type="text" name="father_occupation" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Employer</label>
                                    <input type="text" name="father_employer" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Place of Employment</label>
                                    <input type="text" name="father_employment_place" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                            </div>
                            <!-- Citizenship Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Citizenship</label>
                                    <input type="text" name="father_citizenship" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Other Citizenship</label>
                                    <input type="text" name="father_other_citizenship" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">If Naturalized (Date)</label>
                                    <input type="date" name="father_naturalization_date" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">If Naturalized (Place)</label>
                                    <input type="text" name="father_naturalization_place" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                            </div>
                        </div>

                        <!-- Mother Details Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Mother Details</h3>
                            <!-- Name Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">First Name</label>
                                    <input type="text" name="mother_first_name" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Middle Name</label>
                                    <input type="text" name="mother_middle_name" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Last Name</label>
                                    <input type="text" name="mother_last_name" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Suffix</label>
                                    <input type="text" name="mother_suffix" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
                            <a href="{{ route('phs.marital-status.create') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
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