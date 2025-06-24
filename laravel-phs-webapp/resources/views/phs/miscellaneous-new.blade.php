@extends('layouts.phs-new')

@section('title', 'XIV: Miscellaneous')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-puzzle-piece text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">XIV: Miscellaneous</h1>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('phs.miscellaneous.store') }}" class="space-y-10">
        @csrf
        
        <!-- Miscellaneous Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-[#1B365D] mb-4 flex items-center">
                <i class="fas fa-puzzle-piece mr-3 text-[#D4AF37]"></i>
                Miscellaneous Information
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="misc_type" class="block font-medium text-gray-800 mb-1">Type</label>
                    <input type="text" name="misc_type" id="misc_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="e.g., Hobbies, Skills, Awards (if not military)" value="{{ old('misc_type', $miscellaneous->misc_type ?? '') }}">
                </div>
                <div class="md:col-span-2">
                    <label for="misc_details" class="block font-medium text-gray-800 mb-1">Details</label>
                    <p class="text-sm text-gray-600 mb-2">Please provide any other information that you believe should be included in this statement to assist in determining your qualifications for a position of trust. If none, write "NONE".</p>
                    <textarea name="misc_details" id="misc_details" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors resize-none" placeholder="Type here...">{{ old('misc_details', $miscellaneous->misc_details ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('miscellaneous')" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1B365D] transition-all shadow-none">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="button" id="finishBtn" class="btn-primary">
                Finish <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

<!-- Redirect Modal -->
<div id="redirectModal" style="display: none;" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full text-center">
        <div class="mb-4">
            <i class="fas fa-spinner fa-spin text-3xl text-[#1B365D]"></i>
        </div>
        <h2 class="text-xl font-semibold mb-2">Redirecting to homepage...</h2>
        <p class="mb-4">You will be redirected in <span id="redirectSeconds">5</span> seconds.</p>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const finishBtn = document.getElementById('finishBtn');
    const form = finishBtn.closest('form');
    const modal = document.getElementById('redirectModal');
    const secondsSpan = document.getElementById('redirectSeconds');
    let submitted = false;

    finishBtn.addEventListener('click', function (e) {
        if (submitted) return; // Prevent double submission
        submitted = true;
        e.preventDefault();
        finishBtn.disabled = true;

        // Show modal and start timer
        modal.style.display = 'flex';
        let seconds = 5;
        secondsSpan.textContent = seconds;
        let countdown = setInterval(() => {
            seconds--;
            secondsSpan.textContent = seconds;
            if (seconds <= 0) {
                clearInterval(countdown);
                form.submit(); // Submit the form as normal
            }
        }, 1000);
    });
});
</script>
@endpush
@endsection
@php($currentSection = 'miscellaneous') 