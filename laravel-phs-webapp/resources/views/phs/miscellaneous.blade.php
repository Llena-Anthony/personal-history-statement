@extends('layouts.phs-new')

@section('title', 'Miscellaneous')

@section('content')
<div class="max-w-4xl mx-auto" x-data="confirmationModal()">

    <!-- Confirmation Modal -->
    <div x-show="showConfirmation" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-sm mx-auto text-center">
            <!-- Initial Confirmation View -->
            <div x-show="modalState === 'confirm'">
                <h2 class="text-2xl font-bold mb-4 text-[#1B365D]">Confirmation</h2>
                <p class="text-gray-700 mb-6">Please double-check all your entries before proceeding. Are you sure you want to finalize your submission?</p>
                <div class="flex justify-center space-x-4">
                    <button @click="showConfirmation = false" class="btn-secondary">Go Back & Review</button>
                    <button @click="startCountdown" class="btn-primary">Confirm & Proceed</button>
                </div>
            </div>

            <!-- Countdown View -->
            <div x-show="modalState === 'countdown'">
                <h2 class="text-2xl font-bold mb-4 text-green-600">Success!</h2>
                <p class="text-gray-700 mb-6">Your Personal History Statement has been submitted. Thank you.</p>
                <p class="text-gray-500">Redirecting to your dashboard in <strong x-text="countdown">5</strong> seconds...</p>
            </div>
        </div>
    </div>

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-puzzle-piece text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">XII: Character and Reputation</h1>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('phs.miscellaneous.store') }}" class="space-y-10">
        @csrf
        
        <!-- Questions -->
        <div class="space-y-6">
            <div>
                <label for="misc_type" class="block font-medium text-gray-800 mb-1">Type</label>
                <input type="text" name="misc_type" id="misc_type" class="form-input" placeholder="e.g., Hobbies, Skills, Awards (if not military)" value="{{ old('misc_type', $miscellaneous->misc_type ?? '') }}">
            </div>
            <div>
                <label for="misc_details" class="block font-medium text-gray-800 mb-1">Details</label>
                <p class="text-sm text-gray-600 mb-2">Please provide any other information that you believe should be included in this statement to assist in determining your qualifications for a position of trust. If none, write "NONE".</p>
                <textarea name="misc_details" id="misc_details" rows="6" class="form-input" placeholder="Type here...">{{ old('misc_details', $miscellaneous->misc_details ?? '') }}</textarea>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <a href="#" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </a>
            <button type="submit" class="btn-primary">
                Save & Finish <i class="fas fa-check ml-2"></i>
            </button>
        </div>
    </form>
</div>

<script>
    function confirmationModal() {
        return {
            showConfirmation: {{ session('show_confirmation', 'false') }},
            modalState: 'confirm', // 'confirm' or 'countdown'
            countdown: 5,
            startCountdown() {
                this.modalState = 'countdown';
                const interval = setInterval(() => {
                    this.countdown--;
                    if (this.countdown <= 0) {
                        clearInterval(interval);
                        window.location.href = "{{ route('client.dashboard') }}";
                    }
                }, 1000);
            }
        }
    }
</script>
@endsection
@php($currentSection = 'miscellaneous') 