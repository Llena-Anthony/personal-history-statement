@extends('layouts.phs-new')

@section('title', 'Personal Details')

@section('content')
<div x-data="{ modalOpen: true }">
    <!-- Modal Overlay -->
    <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 p-4" @click.self="modalOpen = false">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full p-8 relative" x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6 tracking-wide">INSTRUCTIONS</h2>
            <ol class="list-decimal list-inside text-base text-gray-700 space-y-3 mb-8">
                <li>Answer all questions completely; if a question is not applicable write "NA". Write "Unknown" only if you do not know the answer and if the answer cannot be derived from personal records. Use the blank pages at the back of this form for extra details.</li>
                <li>Type, print, or write carefully; illegible or incomplete forms will not receive due consideration.</li>
            </ol>
            
            <h2 class="text-2xl font-bold text-center text-red-600 mb-6 tracking-wide">WARNING</h2>
            <ol class="list-decimal list-inside text-base text-gray-700 space-y-3">
                <li>The correctness of all statements of entries made herein may be ascertained through investigation.</li>
                <li>Any deliberate omission or distortion of information may give sufficient cause for denial of clearance and unfavorable result of the investigation.</li>
                <li>The statements made herein are classified <span class="font-bold">CONFIDENTIAL</span>. Revelation or use other than the authorized purpose is prohibited by PMA security policy.</li>
            </ol>
            
            <div x-data="{ accepted: false }" class="text-center mt-10">
                <label class="inline-flex items-center mb-4">
                    <input type="checkbox" x-model="accepted" class="form-checkbox h-5 w-5 text-[#1B365D] rounded focus:ring-[#1B365D]">
                    <span class="ml-2 text-gray-700 font-medium">I have read and understood the instructions and warnings.</span>
                </label>
                <button @click="modalOpen = false" :disabled="!accepted" class="w-full bg-[#1B365D] text-white px-6 py-3 rounded-lg hover:bg-[#2B4B7D] transition disabled:bg-gray-400 disabled:cursor-not-allowed">
                    Accept and Proceed
                </button>
            </div>
        </div>
    </div>

    <!-- PHS Form -->
    <div :class="{ 'blur-sm pointer-events-none': modalOpen }">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-[#1B365D]">Personal Details</h1>
                        <p class="text-gray-600">Please provide your basic personal information</p>
                    </div>
                </div>
            </div>
        
            <!-- Form -->
            <form method="POST" action="{{ route('phs.store') }}" class="space-y-8">
                @csrf
                
                <!-- Personal Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                        <i class="fas fa-id-card mr-3 text-[#D4AF37]"></i>
                        Personal Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- First Name -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="first_name" id="first_name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter your first name">
                            @error('first_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Middle Name -->
                        <div>
                            <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Middle Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="middle_name" id="middle_name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter your middle name">
                            @error('middle_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Last Name -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="last_name" id="last_name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter your last name">
                            @error('last_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
        
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Suffix -->
                        <div>
                            <label for="suffix" class="block text-sm font-medium text-gray-700 mb-2">
                                Name Extension (Jr., Sr., III, etc.)
                            </label>
                            <input type="text" name="suffix" id="suffix"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="e.g., Jr., Sr., III">
                        </div>
        
                        <!-- Nickname -->
                        <div>
                            <label for="nickname" class="block text-sm font-medium text-gray-700 mb-2">
                                Nickname
                            </label>
                            <input type="text" name="nickname" id="nickname"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter your nickname">
                        </div>
                    </div>
                </div>
        
                <!-- Birth Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                        <i class="fas fa-birthday-cake mr-3 text-[#D4AF37]"></i>
                        Birth Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Date of Birth -->
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">
                                Date of Birth <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="date_of_birth" id="date_of_birth" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                            @error('date_of_birth')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Place of Birth -->
                        <div>
                            <label for="place_of_birth" class="block text-sm font-medium text-gray-700 mb-2">
                                Place of Birth <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="place_of_birth" id="place_of_birth" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="City, Province">
                            @error('place_of_birth')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
        
                <!-- Contact Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                        <i class="fas fa-phone mr-3 text-[#D4AF37]"></i>
                        Contact Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input type="email" name="email" id="email"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="your.email@example.com">
                        </div>
        
                        <!-- Mobile -->
                        <div>
                            <label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">
                                Mobile Number
                            </label>
                            <input type="tel" name="mobile" id="mobile"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="+63 9XX XXX XXXX">
                        </div>
                    </div>
        
                    <div class="mt-6">
                        <label for="home_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Home Address
                        </label>
                        <textarea name="home_address" id="home_address" rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                  placeholder="Enter your complete home address"></textarea>
                    </div>
                </div>
        
                <!-- Additional Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                        <i class="fas fa-info-circle mr-3 text-[#D4AF37]"></i>
                        Additional Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Religion -->
                        <div>
                            <label for="religion" class="block text-sm font-medium text-gray-700 mb-2">
                                Religion
                            </label>
                            <input type="text" name="religion" id="religion"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter your religion">
                        </div>
        
                        <!-- Nationality -->
                        <div>
                            <label for="nationality" class="block text-sm font-medium text-gray-700 mb-2">
                                Nationality
                            </label>
                            <input type="text" name="nationality" id="nationality"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="e.g., Filipino" value="Filipino">
                        </div>
                    </div>
        
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- TIN -->
                        <div>
                            <label for="tin" class="block text-sm font-medium text-gray-700 mb-2">
                                Tax Identification Number (TIN)
                            </label>
                            <input type="text" name="tin" id="tin"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="XXX-XXX-XXX-XXX">
                        </div>
        
                        <!-- Passport Number -->
                        <div>
                            <label for="passport_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Passport Number
                            </label>
                            <input type="text" name="passport_number" id="passport_number"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors"
                                   placeholder="Enter passport number">
                        </div>
                    </div>
                </div>
        
                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('client.dashboard') }}" class="btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Dashboard
                    </a>
                    
                    <button type="submit" class="btn-primary">
                        Save & Continue
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('phsForm', () => ({
            currentSection: 'personal-details',
            init() {
                this.markSectionAsVisited('personal-details');
            }
        }));
    });
</script>
@endsection 