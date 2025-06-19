@extends('layouts.phs-new')

@section('title', 'Miscellaneous')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-ellipsis-h text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Miscellaneous</h1>
                <p class="text-gray-600">Provide any additional information as required.</p>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('phs.miscellaneous.store') }}" class="space-y-8">
        @csrf
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-[#1B365D]">Miscellaneous Information</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Other Information</label>
                    <input type="text" name="other_info" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Remarks</label>
                    <input type="text" name="remarks" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                </div>
            </div>
        </div>
        <div class="flex justify-between pt-6 border-t border-gray-200">
            <a href="{{ route('phs.organization') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </a>
            <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all">
                Save & Finish <i class="fas fa-check ml-2"></i>
            </button>
        </div>
    </form>
</div>
@endsection
@php($currentSection = 'miscellaneous') 