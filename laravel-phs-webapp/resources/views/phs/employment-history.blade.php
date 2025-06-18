@extends('layouts.app')

@section('title', 'VIII: Employment History - Personal History Statement')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 relative">
    <div class="absolute inset-0 bg-[url('/images/pma-background.jpg')] bg-cover bg-center bg-no-repeat opacity-10 blur-sm"></div>
    <div class="relative flex min-h-screen">
        @include('phs.components.sidebar-nav')
        <main class="flex-1 ml-72 p-8 mt-16 flex justify-center items-start">
            <div class="w-full max-w-4xl bg-white/95 backdrop-blur-sm rounded-xl shadow-lg p-8 mb-8 pb-24">
                <div class="flex items-center mb-8">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#D4AF37] mr-4">
                        <i class="fas fa-briefcase text-white text-xl"></i>
                    </span>
                    <h2 class="text-2xl font-bold text-[#1B365D]">VIII: Employment History</h2>
                </div>
                <form method="POST" action="{{ route('phs.employment-history.store') }}" class="space-y-8">
                    @csrf
                    <div id="employment-entries" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Business/Company Name <span class="text-xs text-gray-400">(Strictly no abbreviations)</span></label>
                                <input type="text" name="company_name[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Type of Employment</label>
                                <input type="text" name="employment_type[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Business/Company Address</label>
                                <input type="text" name="company_address[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Start (MM/YYYY)</label>
                                <input type="month" name="start_date[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">End (MM/YYYY)</label>
                                <input type="month" name="end_date[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
                            </div>
                        </div>
                        <button type="button" class="mt-4 flex items-center text-black hover:text-[#D4AF37] font-medium text-sm" onclick="addEmploymentEntry()">
                            <i class="fas fa-plus mr-1"></i> Add Another Employment
                        </button>
                    </div>
                    <div class="mt-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Have you been dismissed or forced to resign from a position?</label>
                        <select name="dismissed" id="dismissed-select" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
                            <option value="">Select an option</option>
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                        <div id="dismissed-explanation" class="mt-4 hidden">
                            <label class="block text-sm font-medium text-gray-700">If yes, explain...</label>
                            <input type="text" name="dismissed_explanation" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
                        </div>
                    </div>
                    <div class="flex justify-end mt-8">
                        @include('phs.components.form-navigation', [
                            'previousRoute' => route('phs.places-of-residence.create'),
                            'nextRoute' => route('phs.foreign-countries.create'),
                            'previousText' => 'Previous Section',
                            'nextText' => 'Next Section'
                        ])
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
<script>
function addEmploymentEntry() {
    const container = document.getElementById('employment-entries');
    const entry = document.createElement('div');
    entry.className = 'grid grid-cols-1 md:grid-cols-2 gap-6 mt-8';
    entry.innerHTML = `
        <div class="space-y-2 md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Business/Company Name <span class="text-xs text-gray-400">(Strictly no abbreviations)</span></label>
            <input type="text" name="company_name[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Type of Employment</label>
            <input type="text" name="employment_type[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Business/Company Address</label>
            <input type="text" name="company_address[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Start (MM/YYYY)</label>
            <input type="month" name="start_date[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
        </div>
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">End (MM/YYYY)</label>
            <input type="month" name="end_date[]" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-black transition-colors">
        </div>
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