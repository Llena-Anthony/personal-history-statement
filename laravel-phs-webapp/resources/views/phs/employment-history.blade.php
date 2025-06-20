@extends('layouts.phs-new')

@section('title', 'VIII: Employment History')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-[#1B365D] mb-6">VIII: Employment History</h2>

        <form method="POST" action="{{ route('phs.employment-history.store') }}" class="space-y-6">
            @csrf
            <div id="employment-entries" class="space-y-6">
                @php
                    $employmentEntries = old('company_name') ? count(old('company_name')) : 1;
                @endphp

                @for ($i = 0; $i < $employmentEntries; $i++)
                <div class="employment-entry relative pt-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Business/Company Name <span class="text-xs text-gray-400">(Strictly no abbreviations. Write in full.)</span></label>
                            <input type="text" name="company_name[]" value="{{ old('company_name.'.$i) }}" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                        </div>
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Type of Employment</label>
                            <input type="text" name="employment_type[]" value="{{ old('employment_type.'.$i) }}" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Business/Company Address</label>
                            <input type="text" name="company_address[]" value="{{ old('company_address.'.$i) }}" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                        </div>
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">Start</label>
                            <input type="month" name="start_date[]" value="{{ old('start_date.'.$i) }}" placeholder="MM/YYYY" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                        </div>
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">End</label>
                            <input type="month" name="end_date[]" value="{{ old('end_date.'.$i) }}" placeholder="MM/YYYY" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 flex items-center space-x-2">
                        <button type="button" class="add-entry text-blue-500 hover:text-blue-700 transition-colors" title="Add another entry">
                            <i class="fas fa-plus-circle fa-lg"></i>
                        </button>
                        <button type="button" class="remove-entry text-red-500 hover:text-red-700 transition-colors" title="Remove this entry">
                            <i class="fas fa-minus-circle fa-lg"></i>
                        </button>
                    </div>
                </div>
                @endfor
            </div>

            <hr class="my-8">
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Have you been dismissed or forced to resign from a position?</label>
                    <select name="dismissed" id="dismissed-select" class="mt-1 block w-full md:w-1/4 px-3 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                        <option value="">Select an option</option>
                        <option value="no" {{ old('dismissed') == 'no' ? 'selected' : '' }}>No</option>
                        <option value="yes" {{ old('dismissed') == 'yes' ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
                <div id="dismissed-explanation" class="{{ old('dismissed') == 'yes' ? '' : 'hidden' }}">
                    <label for="dismissed_explanation" class="block text-sm font-medium text-gray-700">Why were you dismissed or forced to resign from a position?</label>
                    <input type="text" name="dismissed_explanation" id="dismissed_explanation" value="{{ old('dismissed_explanation') }}" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors" placeholder="Explain the circumstances here...">
                </div>
            </div>

            <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
                <a href="{{ route('phs.places-of-residence.create') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Previous Section
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-[#1B365D] text-white hover:bg-[#2B4B7D] transition-colors">
                    Save & Continue<i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const entriesContainer = document.getElementById('employment-entries');

    const manageButtons = () => {
        const entries = entriesContainer.querySelectorAll('.employment-entry');
        entries.forEach((entry, index) => {
            const addBtn = entry.querySelector('.add-entry');
            const removeBtn = entry.querySelector('.remove-entry');

            addBtn.style.display = (index === entries.length - 1) ? 'inline-flex' : 'none';
            removeBtn.style.display = (entries.length > 1) ? 'inline-flex' : 'none';
        });
    };

    const addEntry = () => {
        const newEntry = entriesContainer.querySelector('.employment-entry').cloneNode(true);
        newEntry.querySelectorAll('input').forEach(input => input.value = '');
        entriesContainer.appendChild(newEntry);
        manageButtons();
    };

    const removeEntry = (btn) => {
        btn.closest('.employment-entry').remove();
        manageButtons();
    };

    entriesContainer.addEventListener('click', function (e) {
        if (e.target.closest('.add-entry')) {
            addEntry();
        }
        if (e.target.closest('.remove-entry')) {
            removeEntry(e.target.closest('.remove-entry'));
        }
    });

    const dismissedSelect = document.getElementById('dismissed-select');
    if (dismissedSelect) {
        dismissedSelect.addEventListener('change', function() {
            const explanation = document.getElementById('dismissed-explanation');
            explanation.classList.toggle('hidden', this.value !== 'yes');
        });
    }

    manageButtons();
});
</script>
@endpush 