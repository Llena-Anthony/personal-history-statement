@extends('layouts.phs-new')

@section('title', 'X: Credit Reputation')

@section('content')
<div class="max-w-4xl mx-auto" x-data="creditReputationForm()">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-credit-card text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">Credit Reputation</h1>
                <p class="text-gray-600">Please provide your credit reputation information</p>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('personnel.phs.credit-reputation.store') }}" class="space-y-8">
        @csrf
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
                <!-- Banks/Loans -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name and address of banks or other credit institutions with which you have accounts/loans:</label>
                    <div id="bank-accounts-list" class="space-y-4">
                        <template x-for="(account, index) in bank_accounts" :key="index">
                            <div class="bank-account-entry p-4 border border-gray-200 rounded-lg mt-4 relative">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <input type="text" :name="'bank_accounts[' + index + '][bank_name]'" x-model="account.bank_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter name of bank or credit institution">
                                    <input type="text" :name="'bank_accounts[' + index + '][address]'" x-model="account.address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter address of bank or credit institution">
                                </div>
                                <button type="button" @click="removeAccount(index)" x-show="bank_accounts.length > 1 && index > 0" class="remove-account absolute top-2 right-2 text-red-500 hover:text-red-700 transition-colors"><i class="fas fa-times-circle"></i></button>
                            </div>
                        </template>
                    </div>
                    <button type="button" @click="addAccount" class="mt-4 text-[#1B365D] hover:text-[#2B4B7D] transition-colors text-sm font-medium">
                        <i class="fas fa-plus mr-1"></i> Add Another Bank/Credit Institution
                    </button>
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
        <!-- Credit References -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-8">
            <h3 class="text-xl font-semibold text-[#1B365D] mb-6 flex items-center">
                <i class="fas fa-user-friends mr-3 text-[#D4AF37]"></i>
                Three (3) credit references in the Philippines
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($characterReferences as $i => $reference)
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Name</label>
                    <input type="text" name="character_references[{{ $i }}][name]" value="{{ old('character_references.'.$i.'.name', $reference->name) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter credit reference name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                    <input type="text" name="character_references[{{ $i }}][address]" value="{{ old('character_references.'.$i.'.address', $reference->address) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1B365D] focus:border-[#1B365D] transition-colors" placeholder="Enter credit reference address">
                </div>
                @endforeach
            </div>
        </div>
        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200 mt-8">
            <a href="{{ route('phs.foreign-countries.create') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </a>
            <button type="submit" class="btn-primary" onclick="handleFormSubmit(event, 'credit-reputation')">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
</div>

{{-- <script>
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
</script> --}}

@push('styles')
<style>
    .form-input {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        width: 100%;
        transition: box-shadow 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }
    .form-input:focus {
        border-color: #1B365D;
        box-shadow: 0 0 0 2px rgba(27, 54, 93, 0.3);
        outline: none;
    }
    .btn-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.25rem;
        height: 2.25rem;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .btn-circle-sm {
        width: 1.75rem;
        height: 1.75rem;
        font-size: 1rem;
    }
    .btn-blue { background-color: #1B365D; color: white; }
    .btn-blue:hover { background-color: #2B4B7D; }
    .btn-red { background-color: #ef4444; color: white; font-weight: bold; }
    .btn-red:hover { background-color: #dc2626; }
    .btn-primary {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        background-color: #1B365D;
        color: white;
        font-weight: 600;
        transition: background-color 0.2s;
    }
    .btn-primary:hover {
        background-color: #2B4B7D;
    }
    .btn-secondary {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        background-color: #f3f4f6;
        color: #1f2937;
        font-weight: 500;
        border: 1px solid #d1d5db;
        transition: background-color 0.2s;
    }
    .btn-secondary:hover {
        background-color: #e5e7eb;
    }
</style>
@endpush
@endsection
@php($currentSection = 'credit-reputation')
