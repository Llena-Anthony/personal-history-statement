@extends('layouts.phs-new')

@section('title', 'Military History')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-shield-alt text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Military History</h1>
                <p class="text-gray-600">Please provide your military service information</p>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('phs.military-history.store') }}" class="space-y-8">
        @csrf
        <!-- Basic Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Basic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Enlistment in the AFP</label>
                    <input type="date" name="enlistment_date" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Commission</label>
                    <input type="date" name="commission_date" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Source of Commission</label>
                    <select name="commission_source" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <option value="">Select Source</option>
                        <option value="PMA">PMA</option>
                        <option value="ROTC">ROTC</option>
                        <option value="OCC">OCC</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- Important Unit Assignments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-[#1B365D]">Assignments</h3>
                <button type="button" id="addAssignment" class="px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] transition-colors">
                    <i class="fas fa-plus mr-2"></i>Add Assignment
                </button>
            </div>
            <div id="assignments" class="space-y-4">
                <!-- Assignment template will be cloned here -->
            </div>
        </div>
        <!-- Military Schools Attended -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-[#1B365D]">Military Schools Attended</h3>
                <button type="button" class="add-school px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] transition-colors">
                    <i class="fas fa-plus mr-2"></i>Add School
                </button>
            </div>
            <div id="schools" class="space-y-4">
                <div class="school p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">School Name</label>
                            <input type="text" name="schools[0][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date of Attendance</label>
                            <input type="date" name="schools[0][date]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nature of Training</label>
                            <input type="text" name="schools[0][training]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <input type="text" name="schools[0][rating]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Decorations and Awards -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-[#1B365D]">Decorations, Awards, or Commendations Received</h3>
                <button type="button" class="add-award px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] transition-colors">
                    <i class="fas fa-plus mr-2"></i>Add Award
                </button>
            </div>
            <div id="awards" class="space-y-4">
                <div class="award p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Award/Decoration</label>
                            <input type="text" name="awards[0][name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="flex justify-between pt-6 border-t border-gray-200">
            <a href="{{ route('phs.educational-background') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </a>
            <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>
@endsection
@php($currentSection = 'military-history') 