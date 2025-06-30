@extends('layouts.personnel')

@section('title', 'Personal History Statement')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold mb-2">Personal History Statement</h1>
                <p class="text-blue-100">Complete your PHS form to provide comprehensive personal information.</p>
            </div>
            <div class="hidden md:block">
                <i class="fas fa-file-alt text-6xl text-blue-200 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Progress Overview -->
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Form Progress</h3>
            <span class="text-sm font-medium text-gray-500">0% Complete</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
            <div class="bg-blue-600 h-3 rounded-full transition-all duration-500" style="width: 0%"></div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">0</div>
                <div class="text-gray-600">Sections Completed</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-gray-400">8</div>
                <div class="text-gray-600">Total Sections</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">0</div>
                <div class="text-gray-600">Required Fields</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-orange-600">0</div>
                <div class="text-gray-600">Optional Fields</div>
            </div>
        </div>
    </div>

    <!-- Form Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Personal Information -->
        <a href="{{ route('phs.create') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-lg mr-3">
                        <i class="fas fa-user text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Personal Information</h3>
                        <p class="text-sm text-gray-600">Basic personal details</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Name Details:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Birth Information:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Address Details:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg group-hover:bg-blue-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Family Background -->
        <a href="{{ route('phs.family-background.create') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-lg mr-3">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Family Background</h3>
                        <p class="text-sm text-gray-600">Family and marital information</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Parents Information:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Spouse Details:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Children Information:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg group-hover:bg-green-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Educational Background -->
        <a href="{{ route('phs.educational-background') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 rounded-lg mr-3">
                        <i class="fas fa-graduation-cap text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Educational Background</h3>
                        <p class="text-sm text-gray-600">Academic and training history</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Elementary:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Secondary:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">College/University:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg group-hover:bg-purple-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Military History -->
        <a href="{{ route('phs.military-history.create') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg mr-3">
                        <i class="fas fa-medal text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Military History</h3>
                        <p class="text-sm text-gray-600">Service and assignment history</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Military Assignments:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Awards & Decorations:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Military Schools:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg group-hover:bg-red-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Civil Service -->
        <a href="{{ route('phs.employment-history.create') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 rounded-lg mr-3">
                        <i class="fas fa-briefcase text-orange-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Civil Service</h3>
                        <p class="text-sm text-gray-600">Employment and civil service info</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Employment History:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Civil Service Eligibility:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Work Experience:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-lg group-hover:bg-orange-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Character References -->
        <a href="{{ route('phs.credit-reputation') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-teal-100 rounded-lg mr-3">
                        <i class="fas fa-handshake text-teal-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Character References</h3>
                        <p class="text-sm text-gray-600">Personal and professional references</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Personal References:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Professional References:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Credit References:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg group-hover:bg-teal-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Legal Information -->
        <a href="{{ route('phs.arrest-record') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-indigo-100 rounded-lg mr-3">
                        <i class="fas fa-balance-scale text-indigo-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Legal Information</h3>
                        <p class="text-sm text-gray-600">Legal and conduct information</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Arrest Records:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Criminal Cases:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Civil Cases:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg group-hover:bg-indigo-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Miscellaneous -->
        <a href="{{ route('phs.organization') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-pink-100 rounded-lg mr-3">
                        <i class="fas fa-ellipsis-h text-pink-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Miscellaneous</h3>
                        <p class="text-sm text-gray-600">Additional information</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Organizations:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Skills & Hobbies:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Other Information:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-lg group-hover:bg-pink-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Personal Characteristics -->
        <a href="{{ route('phs.personal-characteristics.create') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-lg mr-3">
                        <i class="fas fa-user-check text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Personal Characteristics</h3>
                        <p class="text-sm text-gray-600">Physical and personal traits</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Physical Description:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Health Condition:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg group-hover:bg-yellow-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Places of Residence -->
        <a href="{{ route('phs.places-of-residence.create') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-cyan-100 rounded-lg mr-3">
                        <i class="fas fa-home text-cyan-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Places of Residence</h3>
                        <p class="text-sm text-gray-600">Residence history</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Current Address:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Previous Residences:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-cyan-600 text-white rounded-lg group-hover:bg-cyan-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Foreign Countries Visited -->
        <a href="{{ route('phs.foreign-countries.create') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-lime-100 rounded-lg mr-3">
                        <i class="fas fa-globe-asia text-lime-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Foreign Countries Visited</h3>
                        <p class="text-sm text-gray-600">Travel history</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Countries Visited:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Purpose of Visit:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-lime-600 text-white rounded-lg group-hover:bg-lime-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Credit Reputation -->
        <a href="{{ route('phs.credit-reputation') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-fuchsia-100 rounded-lg mr-3">
                        <i class="fas fa-credit-card text-fuchsia-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Credit Reputation</h3>
                        <p class="text-sm text-gray-600">Credit and financial standing</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Credit Institutions:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Credit Standing:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-fuchsia-600 text-white rounded-lg group-hover:bg-fuchsia-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>
                Start Section
            </span>
        </a>

        <!-- Review & Submit -->
        <a href="{{ route('phs.review') }}" class="group bg-white rounded-xl p-6 shadow-lg border border-gray-100 hover:shadow-2xl transition-shadow block cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="p-3 bg-gray-200 rounded-lg mr-3">
                        <i class="fas fa-clipboard-check text-gray-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Review & Submit</h3>
                        <p class="text-sm text-gray-600">Final review and submission</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">Not Started</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Review All Sections:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Submit Form:</span>
                    <span class="text-gray-400">Not filled</span>
                </div>
            </div>
            <span class="mt-4 inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg group-hover:bg-gray-700 transition-colors">
                <i class="fas fa-clipboard-check mr-2"></i>
                Review & Submit
            </span>
        </a>
    </div>

    <!-- Action Buttons -->
    <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100">
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button disabled class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                <i class="fas fa-save mr-2"></i>
                Save Progress
            </button>
            <button disabled class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                <i class="fas fa-eye mr-2"></i>
                Preview Form
            </button>
            <button disabled class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                <i class="fas fa-print mr-2"></i>
                Print Form
            </button>
            <button disabled class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                <i class="fas fa-paper-plane mr-2"></i>
                Submit Form
            </button>
        </div>
        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">Complete all required sections to enable form submission</p>
        </div>
    </div>
</div>
@endsection 