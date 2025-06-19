@extends('layouts.app')

@section('title', 'Educational Background - Personal History Statement')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 relative">
    <div class="absolute inset-0 bg-[url('/images/pma-background.jpg')] bg-cover bg-center bg-no-repeat opacity-10 blur-sm"></div>
    <div class="relative flex min-h-screen">
        @include('phs.components.sidebar-nav')
        <main class="flex-1 ml-72 p-8 mt-16">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white/95 backdrop-blur-sm rounded-xl shadow-lg p-8 mb-8">
                    <h2 class="text-3xl font-extrabold text-[#1B365D] mb-8 flex items-center">
                        <i class="fas fa-graduation-cap mr-3 text-[#D4AF37]"></i>
                        V: Educational Background
                    </h2>
                    <form class="space-y-10">
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-100 mb-2 relative">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-bold text-[#1B365D]">Elementary School</h3>
                                <button type="button" class="add-entry px-3 py-1.5 rounded-full bg-[#D4AF37] text-white hover:bg-[#B38F2A] text-sm flex items-center absolute right-6 top-6">
                                    <span class="text-lg mr-1">&#43;</span> Add
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 entry">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">School Name</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="Enter School Name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="Enter Location">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Attendance</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="e.g., 2005-2011">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Year Graduated</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="e.g., 2011">
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-100 mb-2 relative">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-bold text-[#1B365D]">High School</h3>
                                <button type="button" class="add-entry px-3 py-1.5 rounded-full bg-[#D4AF37] text-white hover:bg-[#B38F2A] text-sm flex items-center absolute right-6 top-6">
                                    <span class="text-lg mr-1">&#43;</span> Add
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 entry">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">School Name</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="Enter School Name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="Enter Location">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Attendance</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="e.g., 2011-2015">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Year Graduated</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="e.g., 2015">
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-100 mb-2 relative">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-bold text-[#1B365D]">College</h3>
                                <button type="button" class="add-entry px-3 py-1.5 rounded-full bg-[#D4AF37] text-white hover:bg-[#B38F2A] text-sm flex items-center absolute right-6 top-6">
                                    <span class="text-lg mr-1">&#43;</span> Add
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 entry">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">School Name</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="Enter School Name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="Enter Location">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Attendance</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="e.g., 2015-2019">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Year Graduated</label>
                                    <input type="text" class="w-full rounded-md px-3 py-2 border border-gray-300 focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] transition" placeholder="e.g., 2019">
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end pt-6 border-t border-gray-200">
                            <button type="submit" class="px-8 py-3 rounded-lg bg-black text-white hover:bg-gray-800 transition-colors font-bold text-lg flex items-center gap-2">
                                Next Section <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add-entry button logic (static demo, does not persist)
    document.querySelectorAll('.add-entry').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const section = btn.closest('.relative');
            const entryGrid = section.querySelector('.entry');
            const clone = entryGrid.cloneNode(true);
            // Clear input values in the clone
            clone.querySelectorAll('input').forEach(input => input.value = '');
            section.appendChild(clone);
        });
    });
</script>
@endpush
