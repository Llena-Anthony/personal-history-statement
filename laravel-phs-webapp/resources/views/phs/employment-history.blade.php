@extends('layouts.phs')

@section('title', 'VIII: Employment History - Personal History Statement')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
        <h2 class="text-2xl font-bold text-[#1B365D] mb-6 flex items-center">
            <i class="fas fa-briefcase mr-3 text-[#D4AF37]"></i>
            VIII: Employment History
        </h2>

        <form method="POST" action="{{ route('phs.employment-history.store') }}" class="space-y-8">
            @csrf
            <div id="employment-entries" class="space-y-8">
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Business/Company Name <span class="text-xs text-gray-400">(Strictly no abbreviations)</span></label>
                            <input type="text" name="company_name[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Type of Employment</label>
                            <input type="text" name="employment_type[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Business/Company Address</label>
                            <input type="text" name="company_address[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Start (MM/YYYY)</label>
                            <input type="month" name="start_date[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">End (MM/YYYY)</label>
                            <input type="month" name="end_date[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                        </div>
                    </div>
                    <button type="button" class="mt-4 flex items-center text-black hover:text-[#D4AF37] font-medium text-sm" onclick="addEmploymentEntry()">
                        <i class="fas fa-plus mr-1"></i> Add Another Employment
                    </button>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-[#1B365D] mb-4">Dismissal Information</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Have you been dismissed or forced to resign from a position?</label>
                        <select name="dismissed" id="dismissed-select" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                            <option value="">Select an option</option>
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>
                    <div id="dismissed-explanation" class="hidden">
                        <label class="block text-sm font-medium text-gray-700">If yes, explain...</label>
                        <input type="text" name="dismissed_explanation" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('phs.places-of-residence.create') }}" class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors">
                    Previous Section
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-[#1B365D] text-white hover:bg-[#2B4B7D] transition-colors">
                    Next Section
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function addEmploymentEntry() {
    const container = document.getElementById('employment-entries');
    const entry = document.createElement('div');
    entry.className = 'bg-gray-50 rounded-lg p-6 border border-gray-100';
    entry.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Business/Company Name <span class="text-xs text-gray-400">(Strictly no abbreviations)</span></label>
                <input type="text" name="company_name[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Type of Employment</label>
                <input type="text" name="employment_type[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Business/Company Address</label>
                <input type="text" name="company_address[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Start (MM/YYYY)</label>
                <input type="month" name="start_date[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
            </div>
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">End (MM/YYYY)</label>
                <input type="month" name="end_date[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition-colors">
            </div>
        </div>
        <button type="button" class="mt-4 text-red-600 hover:text-red-800" onclick="this.parentElement.remove()">
            <i class="fas fa-times mr-1"></i> Remove Entry
        </button>
    `;
    container.appendChild(entry);
}

const dismissedSelect = document.getElementById('dismissed-select');
if (dismissedSelect) {
    dismissedSelect.addEventListener('change', function() {
        const explanation = document.getElementById('dismissed-explanation');
        if (this.value === 'yes') {
            explanation.classList.remove('hidden');
        } else {
            explanation.classList.add('hidden');
        }
    });
}
</script>
@endsection 