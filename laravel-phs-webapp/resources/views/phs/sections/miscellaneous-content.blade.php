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
        
        <!-- Hobbies, Sports, and Pastimes Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-[#1B365D] mb-4 flex items-center">
                <i class="fas fa-running mr-3 text-[#D4AF37]"></i>
                Hobbies, Sports, and Pastimes
            </h2>
            <div>
                <label for="hobbies" class="block font-medium text-gray-800 mb-1">Please list your hobbies, sports, and pastimes:</label>
                <textarea name="hobbies" id="hobbies" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors resize-none" placeholder="e.g., Reading, Basketball, Photography, etc. If none, write 'NONE'">{{ old('hobbies', $personalDetail->hobbies ?? '') }}</textarea>
            </div>
        </div>

        <!-- Language and Dialect Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-[#1B365D] mb-4 flex items-center">
                <i class="fas fa-language mr-3 text-[#D4AF37]"></i>
                Language and Dialect Proficiency
            </h2>
            <p class="text-sm text-gray-600 mb-4">Indicate your proficiency level as FLUENT, FAIR, or POOR for each language/dialect.</p>
            
            <div id="languages-container">
                @if(isset($fluencies) && count($fluencies) > 0)
                    @foreach($fluencies as $index => $fluency)
                        <div class="language-entry p-4 border border-gray-200 rounded-lg mt-4 relative" data-index="{{ $index }}">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Language/Dialect</label>
                                    <input type="text" name="languages[{{ $index }}][language]" placeholder="e.g., English, Tagalog, Spanish" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" value="{{ $fluency->languageDetail->lang_desc ?? '' }}" readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Speak</label>
                                    <select name="languages[{{ $index }}][speak]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Select</option>
                                        <option value="FLUENT" {{ ($fluency->speak_fluency ?? '') === 'FLUENT' ? 'selected' : '' }}>FLUENT</option>
                                        <option value="FAIR" {{ ($fluency->speak_fluency ?? '') === 'FAIR' ? 'selected' : '' }}>FAIR</option>
                                        <option value="POOR" {{ ($fluency->speak_fluency ?? '') === 'POOR' ? 'selected' : '' }}>POOR</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Read</label>
                                    <select name="languages[{{ $index }}][read]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Select</option>
                                        <option value="FLUENT" {{ ($fluency->read_fluency ?? '') === 'FLUENT' ? 'selected' : '' }}>FLUENT</option>
                                        <option value="FAIR" {{ ($fluency->read_fluency ?? '') === 'FAIR' ? 'selected' : '' }}>FAIR</option>
                                        <option value="POOR" {{ ($fluency->read_fluency ?? '') === 'POOR' ? 'selected' : '' }}>POOR</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Write</label>
                                    <select name="languages[{{ $index }}][write]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                        <option value="">Select</option>
                                        <option value="FLUENT" {{ ($fluency->write_fluency ?? '') === 'FLUENT' ? 'selected' : '' }}>FLUENT</option>
                                        <option value="FAIR" {{ ($fluency->write_fluency ?? '') === 'FAIR' ? 'selected' : '' }}>FAIR</option>
                                        <option value="POOR" {{ ($fluency->write_fluency ?? '') === 'POOR' ? 'selected' : '' }}>POOR</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="language-entry p-4 border border-gray-200 rounded-lg mt-4 relative" data-index="0">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Language/Dialect</label>
                                <input type="text" name="languages[0][language]" placeholder="e.g., English, Tagalog, Spanish" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Speak</label>
                                <select name="languages[0][speak]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="">Select</option>
                                    <option value="FLUENT">FLUENT</option>
                                    <option value="FAIR">FAIR</option>
                                    <option value="POOR">POOR</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Read</label>
                                <select name="languages[0][read]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="">Select</option>
                                    <option value="FLUENT">FLUENT</option>
                                    <option value="FAIR">FAIR</option>
                                    <option value="POOR">POOR</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Write</label>
                                <select name="languages[0][write]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
                                    <option value="">Select</option>
                                    <option value="FLUENT">FLUENT</option>
                                    <option value="FAIR">FAIR</option>
                                    <option value="POOR">POOR</option>
                                </select>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            <button type="button" id="add-language" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium cursor-pointer">
                <i class="fas fa-plus mr-1"></i> Add Another Language
            </button>
        </div>

        <!-- Lie Detection Test Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-[#1B365D] mb-4 flex items-center">
                <i class="fas fa-question-circle mr-3 text-[#D4AF37]"></i>
                Lie Detection Test
            </h2>
            <div>
                <label class="block font-medium text-gray-800 mb-3">Are you willing to undergo periodic lie detection test?</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="undergo_lie_detection" value="yes" class="mr-3 text-[#1B365D] focus:ring-[#1B365D]" {{ old('undergo_lie_detection', $personalDetail->undergo_lie_detection ?? '') === 'yes' ? 'checked' : '' }}>
                        <span class="text-gray-800">Yes</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="undergo_lie_detection" value="no" class="mr-3 text-[#1B365D] focus:ring-[#1B365D]" {{ old('undergo_lie_detection', $personalDetail->undergo_lie_detection ?? '') === 'no' ? 'checked' : '' }}>
                        <span class="text-gray-800">No</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <button type="button" onclick="window.navigateToPreviousSection('miscellaneous')" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </button>
            <button type="button" id="finishBtn" class="btn-primary">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
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

<script>
    // Call global initialization function for Miscellaneous
    if (typeof window.initializeMiscellaneous === 'function') {
        window.initializeMiscellaneous();
    }

    // Set the dashboard route
    var $dashboardRoute = "{{ route('personnel.dashboard') }}";
</script> 