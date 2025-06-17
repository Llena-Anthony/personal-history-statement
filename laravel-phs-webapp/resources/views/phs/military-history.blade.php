@extends('layouts.app')

@section('title', 'Military History - Personal History Statement')

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
                    <h3 class="text-base font-semibold text-gray-800">{{ auth()->user()->name }}</h3>
                    <p class="text-sm text-gray-500">Personal History Statement</p>
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
                        <span class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">II</span>
                        </span>
                        <span class="text-gray-400">Personal Characteristics</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.marital-status.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">III</span>
                        </span>
                        <span class="text-gray-400">Marital Status</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.family-history.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">IV</span>
                        </span>
                        <span class="text-gray-400">Family History and Information</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.educational-background.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">V</span>
                        </span>
                        <span class="text-gray-400">Educational Background</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.military-history.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-yellow-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VI</span>
                        </span>
                        <span class="text-black">Military History</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.places-of-residence.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VII</span>
                        </span>
                        <span class="text-gray-400">Places of Residence</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.employment-history.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VIII</span>
                        </span>
                        <span class="text-gray-400">Employment History</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.foreign-countries.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center mr-3">
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
                    <i class="fas fa-shield-alt mr-3 text-[#D4AF37]"></i>
                    Military History
                </h2>

                <form method="POST" action="{{ route('phs.military-history.store') }}" class="space-y-8">
                    @csrf

                    <!-- Basic Information -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Basic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Enlistment in the AFP</label>
                                <input type="date" name="enlistment_date" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Commission</label>
                                <input type="date" name="commission_date" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Source of Commission</label>
                                <input type="text" name="commission_source" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            </div>
                        </div>
                    </div>

                    <!-- Important Unit Assignments -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-[#1B365D]">Important Unit Assignments</h3>
                            <button type="button" class="add-assignment px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] transition-colors">
                                <i class="fas fa-plus mr-2"></i>Add Assignment
                            </button>
                        </div>
                        <div id="assignments" class="space-y-4">
                            <div class="assignment p-4 bg-white rounded-lg border border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                        <input type="date" name="assignments[0][date]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Unit</label>
                                        <input type="text" name="assignments[0][unit]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                                        <input type="text" name="assignments[0][position]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Military Schools Attended -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-[#1B365D]">Military Schools Attended</h3>
                            <button type="button" class="add-school px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] transition-colors">
                                <i class="fas fa-plus mr-2"></i>Add School
                            </button>
                        </div>
                        <div id="schools" class="space-y-4">
                            <div class="school p-4 bg-white rounded-lg border border-gray-200">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">School Name</label>
                                        <input type="text" name="schools[0][name]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Attendance</label>
                                        <input type="date" name="schools[0][date]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Nature of Training</label>
                                        <input type="text" name="schools[0][training]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                        <input type="text" name="schools[0][rating]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorations and Awards -->
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-[#1B365D]">Decorations, Awards, or Commendations Received</h3>
                            <button type="button" class="add-award px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] transition-colors">
                                <i class="fas fa-plus mr-2"></i>Add Award
                            </button>
                        </div>
                        <div id="awards" class="space-y-4">
                            <div class="award p-4 bg-white rounded-lg border border-gray-200">
                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Award/Decoration</label>
                                        <input type="text" name="awards[0][name]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('phs.educational-background.create') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                            Previous Section
                        </a>
                        <a href="{{ route('phs.places-of-residence.create') }}" class="px-6 py-2.5 rounded-lg bg-[#1B365D] text-white hover:bg-[#2B4B7D] transition-colors">
                            Next Section
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let assignmentCount = 1;
    let schoolCount = 1;
    let awardCount = 1;

    document.querySelector('.add-assignment').addEventListener('click', function() {
        const template = `
            <div class="assignment p-4 bg-white rounded-lg border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="date" name="assignments[${assignmentCount}][date]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Unit</label>
                        <input type="text" name="assignments[${assignmentCount}][unit]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Position</label>
                        <input type="text" name="assignments[${assignmentCount}][position]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                    </div>
                </div>
            </div>
        `;
        document.getElementById('assignments').insertAdjacentHTML('beforeend', template);
        assignmentCount++;
    });

    document.querySelector('.add-school').addEventListener('click', function() {
        const template = `
            <div class="school p-4 bg-white rounded-lg border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">School Name</label>
                        <input type="text" name="schools[${schoolCount}][name]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Attendance</label>
                        <input type="date" name="schools[${schoolCount}][date]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nature of Training</label>
                        <input type="text" name="schools[${schoolCount}][training]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                        <input type="text" name="schools[${schoolCount}][rating]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                    </div>
                </div>
            </div>
        `;
        document.getElementById('schools').insertAdjacentHTML('beforeend', template);
        schoolCount++;
    });

    document.querySelector('.add-award').addEventListener('click', function() {
        const template = `
            <div class="award p-4 bg-white rounded-lg border border-gray-200">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Award/Decoration</label>
                        <input type="text" name="awards[${awardCount}][name]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                    </div>
                </div>
            </div>
        `;
        document.getElementById('awards').insertAdjacentHTML('beforeend', template);
        awardCount++;
    });
</script>
@endpush
@endsection 