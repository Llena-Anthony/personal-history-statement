@extends('layouts.phs-new')

@section('title', 'Family History')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-tree text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Family History</h1>
                <p class="text-gray-600">Please provide your family history information</p>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('phs.family-history.store') }}" class="space-y-8">
        @csrf
        <!-- Father Details Section -->
        <div>
            <h3 class="text-lg font-bold text-gray-900 mb-4">Father Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="father_first_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                    <input type="text" name="father_middle_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="father_last_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Suffix</label>
                    <input type="text" name="father_suffix" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" name="father_birth_date" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Place of Birth</label>
                    <input type="text" name="father_birth_place" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                    <input type="text" name="father_occupation" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employer</label>
                    <input type="text" name="father_employer" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
        </div>
        <!-- Mother Details Section -->
        <div>
            <h3 class="text-lg font-bold text-gray-900 mb-4">Mother Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="mother_first_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                    <input type="text" name="mother_middle_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="mother_last_name" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Suffix</label>
                    <input type="text" name="mother_suffix" class="w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
        </div>
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <a href="{{ route('phs.marital-status.create') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </a>
            <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>
@endsection

{{-- Pass currentSection to layout --}}
@php($currentSection = 'family-history') 