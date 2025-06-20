@extends('layouts.phs-new')

@section('title', 'Credit Reputation')

@section('content')
<div class="max-w-4xl mx-auto" x-data="creditReputationForm()">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <div class="w-12 h-12 bg-[#1B365D] rounded-full flex items-center justify-center">
                <i class="fas fa-credit-card text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-[#1B365D]">X: Credit Reputation</h1>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('phs.credit-reputation.store') }}" class="space-y-10">
        @csrf

        <!-- Question A -->
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <label class="font-medium text-gray-800">A. Are you entirely dependent on your salary?</label>
                <select name="dependent_on_salary" x-model="dependent_on_salary" class="form-input w-40">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <template x-if="dependent_on_salary === '0'">
                <div class="pl-6 space-y-2">
                    <template x-for="(income, index) in other_incomes" :key="index">
                        <div class="flex items-center space-x-2">
                            <input type="text" :name="'other_incomes[' + index + '][source]'" x-model="income.source" class="form-input flex-grow" placeholder="If no, state other source of income...">
                            <button type="button" @click="removeIncome(index)" x-show="other_incomes.length > 1" class="btn-circle btn-circle-sm btn-red">&times;</button>
                        </div>
                    </template>
                    <button type="button" @click="addIncome" class="btn-circle btn-blue"><i class="fas fa-plus"></i></button>
                </div>
            </template>
        </div>

        <!-- Question B -->
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <label class="font-medium text-gray-800">B. Do you have accounts or loans in banks and/or other credit institution?</label>
                <select name="has_loans" x-model="has_loans" class="form-input w-40">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <template x-if="has_loans === '1'">
                <div class="pl-6 space-y-2">
                    <template x-for="(account, index) in bank_accounts" :key="index">
                         <div class="flex items-center space-x-2">
                            <input type="text" :name="'bank_accounts[' + index + '][bank_name]'" x-model="account.bank_name" class="form-input flex-grow" placeholder="Name of bank or credit institution...">
                            <input type="text" :name="'bank_accounts[' + index + '][address]'" x-model="account.address" class="form-input flex-grow" placeholder="Address of bank or credit institution...">
                             <button type="button" @click="removeAccount(index)" x-show="bank_accounts.length > 1" class="btn-circle btn-circle-sm btn-red">&times;</button>
                        </div>
                    </template>
                    <button type="button" @click="addAccount" class="btn-circle btn-blue"><i class="fas fa-plus"></i></button>
                </div>
            </template>
        </div>

        <!-- Question C -->
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <label class="font-medium text-gray-800">C. Have you filed a statement of your Assets and Liabilities with any government agency?</label>
                <select name="has_filed_assets_liabilities" x-model="has_filed_assets_liabilities" class="form-input w-40">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <template x-if="has_filed_assets_liabilities === '1'">
                <div class="pl-6 flex items-center space-x-2">
                    <input type="text" name="assets_liabilities_agency" class="form-input flex-grow" placeholder="Name of agency">
                    <input type="text" name="assets_liabilities_date" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-input flex-grow" placeholder="DD/MM/YYYY">
                </div>
            </template>
        </div>
        
        <!-- Question D -->
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <label class="font-medium text-gray-800">D. Have you filed your latest Income Tax Returns?</label>
                <select name="has_filed_itr" x-model="has_filed_itr" class="form-input w-40">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
             <template x-if="has_filed_itr === '1'">
                <div class="pl-6">
                    <input type="number" step="0.01" name="itr_amount" class="form-input" placeholder="000.00">
                </div>
            </template>
        </div>
        
        <!-- Question E -->
        <div class="space-y-4">
            <label class="font-medium text-gray-800">E. Three (3) credit references in the Philippines.</label>
            <div class="pl-6 space-y-4">
                @foreach ($characterReferences as $i => $reference)
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Credit Reference <span class="text-xs italic">(Strictly no abbreviations. Write in full.)</span></label>
                        <input type="text" name="character_references[{{ $i }}][name]" value="{{ old('character_references.'.$i.'.name', $reference->name) }}" class="form-input">
                    </div>
                     <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Credit Reference Address</label>
                        <input type="text" name="character_references[{{ $i }}][address]" value="{{ old('character_references.'.$i.'.address', $reference->address) }}" class="form-input">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
            <a href="{{ route('phs.foreign-countries.create') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Previous Section
            </a>
            <button type="submit" class="btn-primary">
                Save & Continue <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </form>
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
</script>

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
        font-weight: 600;
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