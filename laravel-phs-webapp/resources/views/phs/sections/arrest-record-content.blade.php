<div x-data="arrestRecordForm()">
        <!-- Arrest Record and Conduct Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-gavel mr-3 text-[#D4AF37]"></i>
                Arrest Record and Conduct Information
            </h3>
            <div class="space-y-8">
                <!-- Question A: Have you ever been investigated/arrested, indicted or convicted for any violation of law? -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Have you ever been investigated/arrested, indicted or convicted for any violation of law?
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <select name="investigated_arrested" x-model="investigated_arrested" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                <option value="">Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <template x-if="investigated_arrested === 'yes'">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">If so, state name of court, nature of offense and disposition of case:</label>
                            <textarea name="investigated_arrested_details" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter details including court name, nature of offense, and disposition of case"></textarea>
                        </div>
                    </template>
                </div>

                <!-- Question B: Has any member of your family ever been investigated/arrested, indicted or convicted for any violation of law? -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Has any member of your family ever been investigated/arrested, indicted or convicted for any violation of law?
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <select name="family_investigated_arrested" x-model="family_investigated_arrested" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                <option value="">Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <template x-if="family_investigated_arrested === 'yes'">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">If so, state name of court, nature of offense and disposition of case:</label>
                            <textarea name="family_investigated_arrested_details" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter details including court name, nature of offense, and disposition of case"></textarea>
                        </div>
                    </template>
                </div>

                <!-- Question C: Have you ever been charged of any administrative case? -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Have you ever been charged of any administrative case?
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <select name="administrative_case" x-model="administrative_case" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                <option value="">Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <template x-if="administrative_case === 'yes'">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">If so, explain:</label>
                            <textarea name="administrative_case_details" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter explanation of the administrative case"></textarea>
                        </div>
                    </template>
                </div>

                <!-- Question D: Have you ever been arrested or detained pursuant to the provisions of PD 1081 and its implementing orders? -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Have you ever been arrested or detained pursuant to the provisions of PD 1081 and its implementing orders (GO, PD, LOI)?
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <select name="pd1081_arrested" x-model="pd1081_arrested" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                <option value="">Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <template x-if="pd1081_arrested === 'yes'">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">If so, state the nature of offense and disposition of case:</label>
                            <textarea name="pd1081_arrested_details" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter nature of offense and disposition of case"></textarea>
                        </div>
                    </template>
                </div>

                <!-- Question E: Do you take/use intoxicating liquor or narcotics? -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Do you take/use intoxicating liquor or narcotics?
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <select name="intoxicating_liquor_narcotics" x-model="intoxicating_liquor_narcotics" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                <option value="">Select</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <template x-if="intoxicating_liquor_narcotics === 'yes'">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">If so, to what extent:</label>
                            <textarea name="intoxicating_liquor_narcotics_details" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter the extent of use"></textarea>
                        </div>
                    </template>
                </div>
            </div>
        </div>
</div>

<script>
    function arrestRecordForm() {
        return {
            investigated_arrested: '{{ old('investigated_arrested', $arrestRecord->investigated_arrested ?? '') }}',
            family_investigated_arrested: '{{ old('family_investigated_arrested', $arrestRecord->family_investigated_arrested ?? '') }}',
            administrative_case: '{{ old('administrative_case', $arrestRecord->administrative_case ?? '') }}',
            pd1081_arrested: '{{ old('pd1081_arrested', $arrestRecord->pd1081_arrested ?? '') }}',
            intoxicating_liquor_narcotics: '{{ old('intoxicating_liquor_narcotics', $arrestRecord->intoxicating_liquor_narcotics ?? '') }}',
        }
    }

    // Call global initialization function for Arrest Record
    if (typeof window.initializeArrestRecord === 'function') {
        window.initializeArrestRecord();
    }
</script> 