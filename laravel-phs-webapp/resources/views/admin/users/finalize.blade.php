@extends('layouts.admin')

@section('title', 'Creating User')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-semibold text-[#1B365D]">Creating User Account</h2>
            <p class="mt-1 text-gray-600">Please wait while we create the user account...</p>
        </div>

        <div class="p-6">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#1B365D] mx-auto"></div>
                <p class="mt-4 text-gray-600">Processing your request...</p>
            </div>

            <form id="finalizeForm" method="POST" action="{{ route('admin.users.finalize') }}" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</div>

<script>
    // Auto-submit the form when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('finalizeForm').submit();
    });
</script>
@endsection 