@extends('layouts.app')

@section('title', 'Personal Details - Personal History Statement')

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
                        <span class="w-6 h-6 rounded-full bg-yellow-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">I</span>
                        </span>
                        <span class="text-black">Personal Details</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.personal-characteristics.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">II</span>
                        </span>
                        <span class="text-gray-400">Personal Characteristics</span>
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
                    Personal Details
                </h2>

                <form method="POST" action="{{ route('phs.store') }}" class="space-y-8">
                    @csrf
                    
                    <!-- Name Section -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Full Name</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" name="last_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" name="first_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                <input type="text" name="middle_name" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Suffix</label>
                                <input type="text" name="suffix" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Personal Details Section -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Personal Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" name="date_of_birth" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Place of Birth</label>
                                <input type="text" name="place_of_birth" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                                <select name="gender" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Civil Status</label>
                                <select name="civil_status" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Civil Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Citizenship Section -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Citizenship</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Citizenship</label>
                                <select name="citizenship" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    <option value="">Select Citizenship</option>
                                    <option value="Filipino">Filipino</option>
                                    <option value="Dual Citizenship">Dual Citizenship</option>
                                </select>
                            </div>
                            <div id="dualCitizenshipFields" class="hidden">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Dual Citizenship by Birth</label>
                                        <input type="checkbox" name="dual_citizenship_by_birth" class="rounded border-gray-300 text-[#D4AF37] focus:ring-[#D4AF37]">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Dual Citizenship by Naturalization</label>
                                        <input type="checkbox" name="dual_citizenship_by_naturalization" class="rounded border-gray-300 text-[#D4AF37] focus:ring-[#D4AF37]">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Dual Citizenship Country</label>
                                        <input type="text" name="dual_citizenship_country" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Government IDs Section -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Government IDs</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">GSIS ID No.</label>
                                <input type="text" name="gsis_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">PhilHealth No.</label>
                                <input type="text" name="philhealth_no" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">TIN No.</label>
                                <input type="text" name="tin_no" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">PAG-IBIG ID No.</label>
                                <input type="text" name="pagibig_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">SSS No.</label>
                                <input type="text" name="sss_no" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Agency Employee No.</label>
                                <input type="text" name="agency_employee_no" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Residential Address</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">House/Block/Lot No.</label>
                                <input type="text" name="residential_house_no" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Street</label>
                                <input type="text" name="residential_street" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subdivision/Village</label>
                                <input type="text" name="residential_subdivision" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Barangay</label>
                                <input type="text" name="residential_barangay" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City/Municipality</label>
                                <input type="text" name="residential_city" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Province</label>
                                <input type="text" name="residential_province" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code</label>
                                <input type="text" name="residential_zip" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Permanent Address</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">House/Block/Lot No.</label>
                                <input type="text" name="permanent_house_no" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Street</label>
                                <input type="text" name="permanent_street" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subdivision/Village</label>
                                <input type="text" name="permanent_subdivision" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Barangay</label>
                                <input type="text" name="permanent_barangay" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City/Municipality</label>
                                <input type="text" name="permanent_city" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Province</label>
                                <input type="text" name="permanent_province" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">ZIP Code</label>
                                <input type="text" name="permanent_zip" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Contact Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Telephone No.</label>
                                <input type="tel" name="telephone" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mobile No.</label>
                                <input type="tel" name="mobile" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-6 border-t border-gray-200">
                        <div></div> <!-- Empty div for spacing -->
                        <a href="{{ route('phs.personal-characteristics.create') }}" class="px-6 py-2.5 rounded-lg bg-[#1B365D] text-white hover:bg-[#2B4B7D] transition-colors">
                            Next Section
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Handle dual citizenship fields
    document.addEventListener('DOMContentLoaded', function() {
        const citizenshipSelect = document.querySelector('select[name="citizenship"]');
        const dualCitizenshipFields = document.getElementById('dualCitizenshipFields');

        citizenshipSelect.addEventListener('change', function() {
            if (this.value === 'Dual Citizenship') {
                dualCitizenshipFields.classList.remove('hidden');
            } else {
                dualCitizenshipFields.classList.add('hidden');
            }
        });
    });
</script>
@endsection 