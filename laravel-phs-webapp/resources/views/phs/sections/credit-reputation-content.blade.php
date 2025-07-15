<div x-data="creditReputationForm()">
        <!-- Combined Section for A-D -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-credit-card mr-3 text-[#D4AF37]"></i>
                Credit Reputation Information
            </h3>
            <div class="space-y-8">
                <!-- Dependent on Salary -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Are you entirely dependent on your salary?</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <select name="dependent_on_salary" x-model="dependent_on_salary" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <template x-if="dependent_on_salary === '0'">
                            <div class="col-span-2">
                                <label class='block text-sm font-medium text-gray-700 mb-2'>If no, state other source of income:</label>
                                <div class="space-y-4">
                                    <template x-for="(income, index) in other_incomes" :key="index">
                                        <div class="other-income-entry p-4 border border-gray-200 rounded-lg mt-4 relative">
                                            <div class="grid grid-cols-1 gap-2">
                                                <input type="text" :name="'other_incomes[' + index + '][source]'" x-model="income.source" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter other source of income">
                                            </div>
                                            <button type="button" @click="removeIncome(index)" x-show="other_incomes.length > 1 && index > 0" class="remove-income absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
                                        </div>
                                    </template>
                                </div>
                                <button type="button" @click="addIncome" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                                    <i class="fas fa-plus mr-1"></i> Add Another Source of Income
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
                <!-- Single textarea for bank accounts/loans -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name and address of banks or other credit institutions with which you have accounts/loans:</label>
                    <textarea name="bank_accounts_details" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="Enter name and address">{{ old('bank_accounts_details', $bankAccountsDetails ?? '') }}</textarea>
                </div>
                <!-- Assets and Liabilities -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Have you filed a statement of your assets and liabilities with any government agency?</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <select name="has_filed_assets_liabilities" x-model="has_filed_assets_liabilities" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <template x-if="has_filed_assets_liabilities === '1'">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">If yes, what agency and when?</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <input type="text" name="assets_liabilities_agency" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter name of agency">
                                <div>
                                    <div class="flex space-x-2">
                                        <select name="assets_liabilities_month" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]">
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
                                        <input type="number" name="assets_liabilities_year" min="1900" max="2030" class="w-1/2 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D]" placeholder="Year">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <!-- ITR -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Have you filed your latest income tax returns?</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <select name="has_filed_itr" x-model="has_filed_itr" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors">
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <template x-if="has_filed_itr === '1'">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Amount paid for the last calendar year:</label>
                            <input type="number" step="0.01" name="itr_amount" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter amount paid for the last calendar year">
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <!-- Credit References (detailed address fields) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-friends mr-3 text-[#D4AF37]"></i>
                Three (3) credit references in the Philippines
            </h3>
            @php
                $oldCreditReferences = old('character_references', $creditReferences->toArray() ?? []);
            @endphp
            @for ($i = 0; $i < 3; $i++)
                <div class="credit-reference-entry p-4 border border-gray-200 rounded-lg mt-4 mb-4">
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-500 mb-1">Bank/Institution Name</label>
                        <input type="text" name="character_references[{{ $i }}][name]" id="credit_reference_bank_name_{{ $i }}" value="{{ $oldCreditReferences[$i]['name'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg credit-reference-bank-name" placeholder="Enter bank/institution name" data-index="{{ $i }}">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Region</label>
                            <select name="character_references[{{ $i }}][region]" id="credit_reference_region_{{ $i }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg credit-reference-region" data-index="{{ $i }}" onchange="loadProvinces('credit_reference_{{ $i }}')">
                                <option value="">Select Region</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Province</label>
                            <select name="character_references[{{ $i }}][province]" id="credit_reference_province_{{ $i }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg credit-reference-province" data-index="{{ $i }}" onchange="loadCities('credit_reference_{{ $i }}')">
                                <option value="">Select Province</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">City/Municipality</label>
                            <select name="character_references[{{ $i }}][city]" id="credit_reference_city_{{ $i }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg credit-reference-city" data-index="{{ $i }}" onchange="loadBarangays('credit_reference_{{ $i }}')">
                                <option value="">Select City/Municipality</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Barangay</label>
                            <select name="character_references[{{ $i }}][barangay]" id="credit_reference_barangay_{{ $i }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg credit-reference-barangay" data-index="{{ $i }}">
                                <option value="">Select Barangay</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Street Address</label>
                            <input type="text" name="character_references[{{ $i }}][street]" id="credit_reference_street_{{ $i }}" value="{{ $oldCreditReferences[$i]['street'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg credit-reference-street" data-index="{{ $i }}" placeholder="Enter street address">
                        </div>
                    </div>
                </div>
            @endfor
        </div>
</div>

<script>
    function creditReputationForm() {
        return {
            dependent_on_salary: '{{ old('dependent_on_salary', $creditReputation->dependent_on_salary) }}',
            has_loans: '{{ old('has_loans', $creditReputation->has_loans) }}',
            has_filed_assets_liabilities: '{{ old('has_filed_assets_liabilities', $creditReputation->has_filed_assets_liabilities) }}',
            has_filed_itr: '{{ old('has_filed_itr', $creditReputation->has_filed_itr) }}',

            other_incomes: @json(old('other_incomes', $otherIncomes->map->only(['source']))),
            bank_accounts: @json(old('bank_accounts', $bankAccounts->map->only(['bank_name', 'address']))),

            addIncome() { this.other_incomes.push({ source: '' }); },
            removeIncome(index) { if (this.other_incomes.length > 1) this.other_incomes.splice(index, 1); },
            addAccount() { this.bank_accounts.push({ bank_name: '', address: '' }); },
            removeAccount(index) { if (this.bank_accounts.length > 1) this.bank_accounts.splice(index, 1); },
        }
    }

    // Call global initialization function for Credit Reputation
    if (typeof window.initializeCreditReputation === 'function') {
        window.initializeCreditReputation();
    }

// --- Bank Autofill Logic for Credit References ---
window.knownBanks = @json($knownBanks);

function autofillCreditReferenceAddress(index) {
    const nameInput = document.getElementById('credit_reference_bank_name_' + index);
    const regionSelect = document.getElementById('credit_reference_region_' + index);
    const provinceSelect = document.getElementById('credit_reference_province_' + index);
    const citySelect = document.getElementById('credit_reference_city_' + index);
    const barangaySelect = document.getElementById('credit_reference_barangay_' + index);
    const streetInput = document.getElementById('credit_reference_street_' + index);
    if (!nameInput) return;
    const value = nameInput.value.trim().toLowerCase();
    const found = window.knownBanks.find(b => b.name.toLowerCase() === value);
    if (found) {
        // Set values (triggers change events for dynamic loading)
        regionSelect.value = found.region;
        regionSelect.dispatchEvent(new Event('change'));
        setTimeout(() => {
            provinceSelect.value = found.province;
            provinceSelect.dispatchEvent(new Event('change'));
            setTimeout(() => {
                citySelect.value = found.city;
                citySelect.dispatchEvent(new Event('change'));
                setTimeout(() => {
                    barangaySelect.value = found.barangay;
                    streetInput.value = found.street;
                }, 300);
            }, 300);
        }, 300);
    }
}

for (let i = 0; i < 3; i++) {
    const nameInput = document.getElementById('credit_reference_bank_name_' + i);
    if (nameInput) {
        nameInput.addEventListener('blur', function() { autofillCreditReferenceAddress(i); });
    }
}

// Dynamic address select loading for each credit reference
for (let i = 0; i < 3; i++) {
    window['loadProvinces'] = window['loadProvinces'] || function(type){};
    window['loadCities'] = window['loadCities'] || function(type){};
    window['loadBarangays'] = window['loadBarangays'] || function(type){};
    // On page load, initialize region select
    if (document.getElementById('credit_reference_region_' + i)) {
        // You may want to call your region loading function here
        // e.g., loadRegionsForCreditReference(i);
    }
}
</script>
