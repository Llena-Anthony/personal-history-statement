@extends('layouts.phs-new')

@section('title', 'Places of Residence Since Birth')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-home text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Places of Residence Since Birth</h1>
                <p class="text-gray-600">List all places you have resided in since birth.</p>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('phs.places-of-residence.store') }}" class="space-y-8">
        @csrf
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-[#1B365D]">Residence History</h3>
                <button type="button" id="addResidence" class="px-4 py-2 bg-[#1B365D] text-white rounded-lg hover:bg-[#2B4B7D] transition-colors">
                    <i class="fas fa-plus mr-2"></i>Add Residence
                </button>
            </div>
            <div id="residences" class="space-y-4">
                <div class="residence-entry p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">From (Year)</label>
                            <input type="number" name="residences[0][from]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">To (Year)</label>
                            <input type="number" name="residences[0][to]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <input type="text" name="residences[0][address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" class="remove-btn text-red-500 hover:text-red-700 font-semibold">Remove</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between pt-6 border-t border-gray-200">
            <a href="{{ route('phs.military-history.create') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </a>
            <button type="submit" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#1B365D] hover:bg-[#2B4B7D] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>
@endsection
@php($currentSection = 'places-of-residence')

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function setupDynamicFields(containerId, addButtonId, entryClass, allowRemoveLast = false) {
            const container = document.getElementById(containerId);
            if (!container) return;

            const addButton = document.getElementById(addButtonId);
            if (!addButton) return;
            
            const templateEntry = container.querySelector('.' + entryClass);
            if (!templateEntry) return;
            
            const template = templateEntry.cloneNode(true);
            let index = container.querySelectorAll('.' + entryClass).length;

            container.addEventListener('click', function(e) {
                const removeBtn = e.target.closest('.remove-btn');
                if (removeBtn) {
                    const entry = removeBtn.closest('.' + entryClass);
                    if (entry) {
                        if (container.querySelectorAll('.' + entryClass).length > 1 || allowRemoveLast) {
                            entry.remove();
                        }
                    }
                }
            });

            addButton.addEventListener('click', function () {
                const newEntry = template.cloneNode(true);
                newEntry.querySelectorAll('input, select').forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace(/\[\d+\]/, '[' + index + ']'));
                    }
                    input.value = ''; // Clear the value of new inputs
                });
                
                container.appendChild(newEntry);
                index++;
            });
        }
        setupDynamicFields('residences', 'addResidence', 'residence-entry', true);
    });
</script>
@endpush 