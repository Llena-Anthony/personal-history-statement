<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Models\CreditReputation;
use App\Models\OtherIncome;
use App\Models\BankAccount;
use App\Models\CharacterReference;
use Illuminate\Support\Facades\Auth;

class CreditReputationController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $user = Auth::user();
        $creditReputation = CreditReputation::with(['otherIncomes', 'bankAccounts', 'characterReferences'])->firstOrNew(['user_id' => $user->id]);

        $commonData = $this->getCommonViewData('credit-reputation');
        
        $viewData = array_merge($commonData, [
            'creditReputation' => $creditReputation,
            'otherIncomes' => $creditReputation->otherIncomes->isEmpty() ? collect([new OtherIncome()]) : $creditReputation->otherIncomes,
            'bankAccounts' => $creditReputation->bankAccounts->isEmpty() ? collect([new BankAccount()]) : $creditReputation->bankAccounts,
            'characterReferences' => $creditReputation->characterReferences->isEmpty() ? collect(array_fill(0, 3, new CharacterReference())) : $creditReputation->characterReferences,
        ]);

        if (request()->ajax()) {
            return view('phs.sections.credit-reputation-content', $viewData);
        }

        return view('phs.credit-reputation', $viewData);
    }

    public function store(Request $request)
    {
        $this->markSectionAsCompleted('credit-reputation');
        
        // Validation can be added here as needed
        $user = Auth::user();

        // Update or create CreditReputation
        $creditReputation = CreditReputation::updateOrCreate(
            ['user_id' => $user->id],
            $request->only([
                'dependent_on_salary',
                'has_loans',
                'has_filed_assets_liabilities',
                'assets_liabilities_agency',
                'assets_liabilities_date',
                'has_filed_itr',
                'itr_amount',
            ])
        );

        // Clear and create OtherIncomes
        $creditReputation->otherIncomes()->delete();
        if ($request->has('other_incomes')) {
            foreach ($request->other_incomes as $income) {
                if (!empty($income['source'])) {
                    $creditReputation->otherIncomes()->create($income);
                }
            }
        }
        
        // Clear and create BankAccounts
        $creditReputation->bankAccounts()->delete();
        if ($request->has('bank_accounts')) {
            foreach ($request->bank_accounts as $account) {
                if (!empty($account['bank_name'])) {
                    $creditReputation->bankAccounts()->create($account);
                }
            }
        }

        // Clear and create CharacterReferences
        $creditReputation->characterReferences()->delete();
        if ($request->has('character_references')) {
            foreach ($request->character_references as $reference) {
                if (!empty($reference['name'])) {
                    $creditReputation->characterReferences()->create($reference);
                }
            }
        }

        // The next section is arrest-record
        return redirect()->route('phs.arrest-record')
            ->with('success', 'Credit reputation saved successfully.');
    }
    
    protected function getSections()
    {
        // Define all sections for progress tracking
        return [
            'personal-details',
            'family-background',
            'educational-background',
            'employment-history',
            'military-history',
            'places-of-residence',
            'foreign-countries',
            'credit-reputation',
            'arrest-record',
            'character-references',
            'organization',
            'miscellaneous'
        ];
    }
}
