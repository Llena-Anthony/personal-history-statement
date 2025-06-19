@extends('layouts.app')

@section('title', 'Personal Details - Personal History Statement')

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
                    <span class="text-sm font-medium text-[#1B365D]">1/9</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-[#D4AF37] h-2 rounded-full" style="width: 11%"></div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-6 bg-white">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('phs.create') }}" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('phs.create') ? 'bg-[#1B365D]/5 font-bold text-[#1B365D]' : 'text-gray-400 hover:text-gray-700' }}">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full {{ request()->routeIs('phs.create') ? 'bg-[#D4AF37]' : 'bg-gray-200' }}">
                                <span class="text-xs text-white font-bold">I</span>
                            </span>
                            <span class="text-sm {{ request()->routeIs('phs.create') ? 'font-bold' : 'font-medium' }}">Personal Details</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 py-2 px-3 rounded-lg transition-colors text-gray-400 hover:text-gray-700">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-gray-200">
                                <span class="text-xs text-white font-bold">II</span>
                            </span>
                            <span class="text-sm font-medium">Personal Characteristics</span>
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
                    <h2 class="text-3xl font-extrabold text-[#1B365D] mb-8">I: Personal Details</h2>
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
                    <form method="POST" action="{{ route('phs.store') }}" class="space-y-8">
                        @csrf
                        <!-- Name Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 gap-y-6">
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                        </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name <span class="text-red-500">*</span></label>
                                <input type="text" name="middle_name" value="{{ old('middle_name') }}" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                    </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                        </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Suffix <span class="text-xs text-gray-400">(e.g. Sr, IV, etc)</span></label>
                                <input type="text" name="suffix" value="{{ old('suffix') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]" placeholder="e.g. Sr, IV, etc">
                            </div>
                        </div>
                        <!-- Rank, AFPSN, Br of Svc, Present Job/Assignment -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 gap-y-6">
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rank</label>
                                <input type="text" name="rank" value="{{ old('rank') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                        </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">AFPSN</label>
                                <input type="text" name="afpsn" value="{{ old('afpsn') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                        </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Br of Svc</label>
                                <input type="text" name="branch_of_service" value="{{ old('branch_of_service') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                        </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Present Job / Assignment</label>
                                <input type="text" name="present_job" value="{{ old('present_job') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                            </div>
                        </div>
                        <!-- Religion, Home Address, Business/Duty Address -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 gap-y-6">
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Religion</label>
                                <select name="religion" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Please Select</option>
                                    <option value="Roman Catholic">Roman Catholic</option>
                                    <option value="Christian">Christian</option>
                                    <option value="Muslim">Muslim</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Home Address</label>
                                <input type="text" name="home_address" value="{{ old('home_address') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                        </div>
                            <div class="col-span-1 md:col-span-2 lg:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Business / Duty Address</label>
                                <input type="text" name="business_address" value="{{ old('business_address') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                    </div>
                        </div>
                        <!-- Date of Birth, Place of Birth, Nationality -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 gap-y-6">
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth <span class="text-red-500">*</span></label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]" placeholder="DD/MM/YYYY">
                        </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth <span class="text-red-500">*</span></label>
                                <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}" required class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                        </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nationality</label>
                                <select name="nationality" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                                    <option value="">Please Select</option>
                                    <option value="Filipino">Filipino</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <!-- Change in Name, Nickname, Email Address -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 gap-y-6">
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center">Change in Name <span class="ml-1 text-gray-400" title="If you have legally changed your name, indicate here."><i class="fas fa-info-circle"></i></span></label>
                                <input type="text" name="change_in_name" value="{{ old('change_in_name') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                        </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nickname</label>
                                <input type="text" name="nickname" value="{{ old('nickname') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                        </div>
                            <div class="col-span-1 md:col-span-2 lg:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                    </div>
                        </div>
                        <!-- Tax ID, Passport, Expiration, Mobile/Telephone -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 gap-y-6">
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tax Identification Number</label>
                                <input type="text" name="tin" value="{{ old('tin') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                        </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Passport Number</label>
                                <input type="text" name="passport_number" value="{{ old('passport_number') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                        </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Expiration Date</label>
                                <input type="date" name="passport_expiry" value="{{ old('passport_expiry') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]" placeholder="DD/MM/YYYY">
                        </div>
                        <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mobile / Telephone Number</label>
                                <input type="text" name="mobile" value="{{ old('mobile') }}" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37]">
                            </div>
                        </div>
                        <!-- Navigation Buttons -->
                        <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
                            <button type="button" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>Back
                            </button>
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

@push('scripts')
<script>
    // Auto-save functionality
    let autoSaveTimeout;
    const form = document.querySelector('form');
    
    form.addEventListener('input', function() {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(() => {
            // Save form data to localStorage
            const formData = new FormData(form);
            const data = {};
            formData.forEach((value, key) => data[key] = value);
            localStorage.setItem('phs_personal_details', JSON.stringify(data));
        }, 1000);
    });

    // Load saved data on page load
    window.addEventListener('load', function() {
        const savedData = localStorage.getItem('phs_personal_details');
        if (savedData) {
            const data = JSON.parse(savedData);
            Object.keys(data).forEach(key => {
                const input = form.querySelector(`[name="${key}"]`);
                if (input) input.value = data[key];
            });
        }
    });

    // Clear saved data on successful submission
    form.addEventListener('submit', function() {
        localStorage.removeItem('phs_personal_details');
    });
</script>
@endpush
@endsection 