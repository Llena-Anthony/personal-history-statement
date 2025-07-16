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
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name of Court</label>
                                <input type="text" name="investigated_arrested_court_name" x-model="investigated_arrested_court_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter name of court">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nature of Offense</label>
                                <input type="text" name="investigated_arrested_nature_of_offense" x-model="investigated_arrested_nature_of_offense" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter nature of offense">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Disposition of Case</label>
                                <input type="text" name="investigated_arrested_disposition_of_case" x-model="investigated_arrested_disposition_of_case" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter disposition of case">
                            </div>
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
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name of Court</label>
                                <input type="text" name="family_investigated_arrested_court_name" x-model="family_investigated_arrested_court_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter name of court">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nature of Offense</label>
                                <input type="text" name="family_investigated_arrested_nature_of_offense" x-model="family_investigated_arrested_nature_of_offense" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter nature of offense">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Disposition of Case</label>
                                <input type="text" name="family_investigated_arrested_disposition_of_case" x-model="family_investigated_arrested_disposition_of_case" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter disposition of case">
                            </div>
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
                            <textarea name="administrative_case_details" x-model="administrative_case_details" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter explanation of the administrative case"></textarea>
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
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nature of Offense</label>
                                <input type="text" name="pd1081_arrested_nature_of_offense" x-model="pd1081_arrested_nature_of_offense" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter nature of offense">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Disposition of Case</label>
                                <input type="text" name="pd1081_arrested_disposition_of_case" x-model="pd1081_arrested_disposition_of_case" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter disposition of case">
                            </div>
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
                            <textarea name="intoxicating_liquor_narcotics_details" x-model="intoxicating_liquor_narcotics_details" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter the extent of use"></textarea>
                        </div>
                    </template>
                </div>
            </div>
        </div>
</div>

<script>
    function arrestRecordForm() {
        return {
            investigated_arrested: '{{ old('investigated_arrested', optional($arrestRecord->arrDesc)->arrest_detail_id ? 'yes' : 'no') }}',
            investigated_arrested_court_name: '{{ old('investigated_arrested_court_name', optional($arrestRecord->arrDesc)->court_name ?? '') }}',
            investigated_arrested_nature_of_offense: '{{ old('investigated_arrested_nature_of_offense', optional($arrestRecord->arrDesc)->nature_of_offense ?? '') }}',
            investigated_arrested_disposition_of_case: '{{ old('investigated_arrested_disposition_of_case', optional($arrestRecord->arrDesc)->disposition_of_case ?? '') }}',
            family_investigated_arrested: '{{ old('family_investigated_arrested', optional($arrestRecord->famArrDesc)->arrest_detail_id ? 'yes' : 'no') }}',
            family_investigated_arrested_court_name: '{{ old('family_investigated_arrested_court_name', optional($arrestRecord->famArrDesc)->court_name ?? '') }}',
            family_investigated_arrested_nature_of_offense: '{{ old('family_investigated_arrested_nature_of_offense', optional($arrestRecord->famArrDesc)->nature_of_offense ?? '') }}',
            family_investigated_arrested_disposition_of_case: '{{ old('family_investigated_arrested_disposition_of_case', optional($arrestRecord->famArrDesc)->disposition_of_case ?? '') }}',
            pd1081_arrested: '{{ old('pd1081_arrested', optional($arrestRecord->violationDesc)->arrest_detail_id ? 'yes' : 'no') }}',
            pd1081_arrested_nature_of_offense: '{{ old('pd1081_arrested_nature_of_offense', optional($arrestRecord->violationDesc)->nature_of_offense ?? '') }}',
            pd1081_arrested_disposition_of_case: '{{ old('pd1081_arrested_disposition_of_case', optional($arrestRecord->violationDesc)->disposition_of_case ?? '') }}',
            administrative_case: '{{ old('administrative_case', $arrestRecord->admin_case_desc ? 'yes' : 'no') }}',
            administrative_case_details: '{{ old('administrative_case_details', $arrestRecord->admin_case_desc ?? '') }}',
            intoxicating_liquor_narcotics: '{{ old('intoxicating_liquor_narcotics', $arrestRecord->extent_of_intoxication ? 'yes' : 'no') }}',
            intoxicating_liquor_narcotics_details: '{{ old('intoxicating_liquor_narcotics_details', $arrestRecord->extent_of_intoxication ?? '') }}',
        }
    }

    // Call global initialization function for Arrest Record
    if (typeof window.initializeArrestRecord === 'function') {
        window.initializeArrestRecord();
    }
</script> 