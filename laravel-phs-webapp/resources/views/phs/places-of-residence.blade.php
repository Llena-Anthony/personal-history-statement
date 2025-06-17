@extends('layouts.app')

@section('title', 'Places of Residence - Personal History Statement')

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
                        <span class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VI</span>
                        </span>
                        <span class="text-gray-400">Military History</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.places-of-residence.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-yellow-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VII</span>
                        </span>
                        <span class="text-black">Places of Residence</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.employment-history.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                        <span class="w-6 h-6 rounded-full bg-gray-400 flex items-center justify-center mr-3">
                            <span class="text-xs text-white">VIII</span>
                        </span>
                        <span class="text-gray-400">Employment History</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('phs.foreign-countries.create') }}" class="flex items-center text-gray-600 hover:text-gray-900">
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
                    <i class="fas fa-home mr-3 text-[#D4AF37]"></i>
                    Places of Residence Since Birth
                </h2>

                <form method="POST" action="{{ route('phs.places-of-residence.store') }}" class="space-y-8">
                    @csrf

                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-[#1B365D]">Residence History</h3>
                            <button type="button" class="add-residence px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] transition-colors">
                                <i class="fas fa-plus mr-2"></i>Add Residence
                            </button>
                        </div>
                        <div id="residences" class="space-y-4">
                            <div class="residence grid grid-cols-1 md:grid-cols-3 gap-6 p-4 bg-white rounded-lg border border-gray-200">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Residence Address</label>
                                    <input type="text" name="residences[0][address]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">From (MM/YYYY)</label>
                                    <input type="month" name="residences[0][from_date]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Until (MM/YYYY)</label>
                                    <input type="month" name="residences[0][until_date]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('phs.military-history.create') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                            Previous Section
                        </a>
                        <button type="submit" class="px-6 py-2.5 rounded-lg bg-[#1B365D] text-white hover:bg-[#2B4B7D] transition-colors">
                            Next Section
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let residenceCount = 1;
    document.querySelector('.add-residence').addEventListener('click', function() {
        const template = `
            <div class="residence grid grid-cols-1 md:grid-cols-3 gap-6 p-4 bg-white rounded-lg border border-gray-200">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Residence Address</label>
                    <input type="text" name="residences[${residenceCount}][address]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">From (MM/YYYY)</label>
                    <input type="month" name="residences[${residenceCount}][from_date]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Until (MM/YYYY)</label>
                    <input type="month" name="residences[${residenceCount}][until_date]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                </div>
            </div>
        `;
        document.getElementById('residences').insertAdjacentHTML('beforeend', template);
        residenceCount++;
    });
</script>
@endpush
@endsection 