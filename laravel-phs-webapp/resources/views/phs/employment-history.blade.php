@extends('layouts.phs-new')

@section('title', 'VIII: Employment History')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-briefcase text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Employment History</h1>
                <p class="text-gray-600">Please provide your employment information</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('phs.employment-history.store') }}" class="space-y-8">
        @csrf
        <!-- Employment Entries -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold text-[#1B365D] flex items-center">
                    <i class="fas fa-building mr-3 text-[#D4AF37]"></i>
                    Employment Entries
                </h3>
            </div>
            <div id="employment-entries" class="space-y-4">
                <!-- Initial employment entry (default, not removable) -->
                <div class="employment-entry p-4 border border-gray-200 rounded-lg" data-index="0">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (From)</label>
                            <div class="flex space-x-2">
                                <select name="employment[0][from_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="employment[0][from]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="employment-from-month-year-group-0">
                                    <select name="employment[0][from_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input type="number" name="employment[0][from_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (To)</label>
                            <div class="flex space-x-2">
                                <select name="employment[0][to_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="exact">Exact Date</option>
                                    <option value="month_year">Month/Year</option>
                                </select>
                                <input type="date" name="employment[0][to]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <div class="w-2/3 flex space-x-2 hidden" id="employment-to-month-year-group-0">
                                    <select name="employment[0][to_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <input type="number" name="employment[0][to_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type of Employment</label>
                            <input type="text" name="employment[0][type]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employment type">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name of Employer</label>
                            <input type="text" name="employment[0][employer_name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address of Employer</label>
                            <input type="text" name="employment[0][employer_address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer address">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Leaving</label>
                            <input type="text" name="employment[0][reason_leaving]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter reason for leaving">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-employment" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-1"></i> Add Another Employment
            </button>
        </div>

        <!-- Dismissal Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-exclamation-triangle mr-3 text-[#D4AF37]"></i>
                Dismissal Information
            </h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Have you been dismissed or forced to resign from a position?</label>
                    <select name="dismissed" id="dismissed-select" class="w-full md:w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <option value="">Select an option</option>
                        <option value="no" {{ old('dismissed') == 'no' ? 'selected' : '' }}>No</option>
                        <option value="yes" {{ old('dismissed') == 'yes' ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
                <div id="dismissed-explanation" class="{{ old('dismissed') == 'yes' ? '' : 'hidden' }}">
                    <label for="dismissed_explanation" class="block text-sm font-medium text-gray-700 mb-2">If yes, please explain</label>
                    <input type="text" name="dismissed_explanation" id="dismissed_explanation" value="{{ old('dismissed_explanation') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Explain the circumstances here...">
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('employment-history')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'employment-history')">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Function to handle employment date type changes
    function handleEmploymentDateTypeChange(selectElement, isFrom = true) {
        const entry = selectElement.closest('.employment-entry');
        const index = entry.getAttribute('data-index');
        const dateInput = entry.querySelector(`input[name="employment[${index}][${isFrom ? 'from' : 'to'}"]`);
        const monthYearGroup = entry.querySelector(`#employment-${isFrom ? 'from' : 'to'}-month-year-group-${index}`);
        
        if (selectElement.value === 'exact') {
            dateInput.classList.remove('hidden');
            monthYearGroup.classList.add('hidden');
        } else {
            dateInput.classList.add('hidden');
            monthYearGroup.classList.remove('hidden');
        }
    }

    // Function to synchronize employment date types for a specific entry
    function synchronizeEmploymentDateTypes(entry, changedSelect) {
        const index = entry.getAttribute('data-index');
        const fromSelect = entry.querySelector(`select[name="employment[${index}][from_type]"]`);
        const toSelect = entry.querySelector(`select[name="employment[${index}][to_type]"]`);
        
        console.log('Synchronizing employment dates for entry', index, ':', {
            changedSelect: changedSelect.name,
            fromSelectValue: fromSelect.value,
            toSelectValue: toSelect.value
        });
        
        if (changedSelect === fromSelect) {
            toSelect.value = fromSelect.value;
            console.log('Updated "to" select to:', toSelect.value);
        } else {
            fromSelect.value = toSelect.value;
            console.log('Updated "from" select to:', fromSelect.value);
        }
        
        // Always update both UI states after synchronization
        const fromDateInput = entry.querySelector(`input[name="employment[${index}][from]"]`);
        const fromMonthYearGroup = entry.querySelector(`#employment-from-month-year-group-${index}`);
        const toDateInput = entry.querySelector(`input[name="employment[${index}][to]"]`);
        const toMonthYearGroup = entry.querySelector(`#employment-to-month-year-group-${index}`);
        
        if (fromSelect.value === 'exact') {
            fromDateInput.classList.remove('hidden');
            fromMonthYearGroup.classList.add('hidden');
            toDateInput.classList.remove('hidden');
            toMonthYearGroup.classList.add('hidden');
        } else {
            fromDateInput.classList.add('hidden');
            fromMonthYearGroup.classList.remove('hidden');
            toDateInput.classList.add('hidden');
            toMonthYearGroup.classList.remove('hidden');
        }
    }

    // Add event listeners for initial employment date type selects
    const initialEmploymentFromTypeSelect = document.querySelector('select[name="employment[0][from_type]"]');
    const initialEmploymentToTypeSelect = document.querySelector('select[name="employment[0][to_type]"]');
    const initialEmploymentEntry = document.querySelector('.employment-entry[data-index="0"]');
    
    if (initialEmploymentFromTypeSelect && initialEmploymentEntry) {
        initialEmploymentFromTypeSelect.addEventListener('change', function() {
            synchronizeEmploymentDateTypes(initialEmploymentEntry, this);
        });
    }
    
    if (initialEmploymentToTypeSelect && initialEmploymentEntry) {
        initialEmploymentToTypeSelect.addEventListener('change', function() {
            synchronizeEmploymentDateTypes(initialEmploymentEntry, this);
        });
    }

    // Employment Entries functionality
    const employmentContainer = document.getElementById('employment-entries');
    const addEmploymentBtn = document.getElementById('add-employment');

    addEmploymentBtn.addEventListener('click', () => {
        const entries = employmentContainer.querySelectorAll('.employment-entry');
        const idx = entries.length;
        const employmentEntry = document.createElement('div');
        employmentEntry.className = 'employment-entry p-4 border border-gray-200 rounded-lg mt-4 relative';
        employmentEntry.setAttribute('data-index', idx);
        employmentEntry.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (From)</label>
                    <div class="flex space-x-2">
                        <select name="employment[${idx}][from_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            <option value="exact">Exact Date</option>
                            <option value="month_year">Month/Year</option>
                        </select>
                        <input type="date" name="employment[${idx}][from]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <div class="w-2/3 flex space-x-2 hidden" id="employment-from-month-year-group-${idx}">
                            <select name="employment[${idx}][from_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="">Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <input type="number" name="employment[${idx}][from_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Inclusive Dates (To)</label>
                    <div class="flex space-x-2">
                        <select name="employment[${idx}][to_type]" class="w-1/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            <option value="exact">Exact Date</option>
                            <option value="month_year">Month/Year</option>
                        </select>
                        <input type="date" name="employment[${idx}][to]" class="w-2/3 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                        <div class="w-2/3 flex space-x-2 hidden" id="employment-to-month-year-group-${idx}">
                            <select name="employment[${idx}][to_month]" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                <option value="">Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <input type="number" name="employment[${idx}][to_year]" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type of Employment</label>
                    <input type="text" name="employment[${idx}][type]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employment type">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name of Employer</label>
                    <input type="text" name="employment[${idx}][employer_name]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address of Employer</label>
                    <input type="text" name="employment[${idx}][employer_address]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter employer address">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Leaving</label>
                    <input type="text" name="employment[${idx}][reason_leaving]" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Enter reason for leaving">
                </div>
            </div>
            <button type="button" class="remove-employment absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
        `;
        employmentContainer.appendChild(employmentEntry);

        // Add event listeners for the new employment date type selects
        const newEmploymentFromTypeSelect = employmentEntry.querySelector(`select[name="employment[${idx}][from_type]"]`);
        const newEmploymentToTypeSelect = employmentEntry.querySelector(`select[name="employment[${idx}][to_type]"]`);
        
        newEmploymentFromTypeSelect.addEventListener('change', function() {
            synchronizeEmploymentDateTypes(employmentEntry, this);
        });
        
        newEmploymentToTypeSelect.addEventListener('change', function() {
            synchronizeEmploymentDateTypes(employmentEntry, this);
        });
    });

    employmentContainer.addEventListener('click', (e) => {
        if (e.target.closest('.remove-employment')) {
            const entries = employmentContainer.querySelectorAll('.employment-entry');
            if (entries.length > 1) {
                e.target.closest('.employment-entry').remove();
            }
        }
    });

    // Dismissal select logic
    const dismissedSelect = document.getElementById('dismissed-select');
    if (dismissedSelect) {
        dismissedSelect.addEventListener('change', function() {
            const explanation = document.getElementById('dismissed-explanation');
            explanation.classList.toggle('hidden', this.value !== 'yes');
        });
    }
});
</script>
@endsection
@php($currentSection = 'employment-history') 