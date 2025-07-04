<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

use App\Models\CreditDetail;
use App\Models\CreditReferenceDetail;

use Illuminate\Support\Facades\Auth;

class CreditReputationController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $creditReputation = CreditDetail::where('username', auth()->id())->first();

        // $creditReputation = CreditDetail::with(['otherIncomes', 'bankAccounts', 'characterReferences'])->firstOrNew(['user_id' => $user->id]);

        $commonData = $this->getCommonViewData('credit-reputation');

        $viewData = array_merge($commonData, [
            'creditReputation' => $creditReputation,
            'otherIncomes' => '$creditReputation->otherIncomes->isEmpty() ? collect([new OtherIncome()]) : $creditReputation->otherIncomes',
            'bankAccounts' => null,
            'characterReferences' => $creditReputation && $creditReputation->characterReferences
                ? $creditReputation->characterReferences
                : collect([new CreditReferenceDetail()]),
        ]);

        // $viewData = $commonData;

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

        \Log::info('CreditReputation request data:', $request->all());

        try {
            // Update or create CreditReputation
            $creditReputation = CreditReputation::updateOrCreate(
                ['user_id' => $user->id],
                $request->only([
                    'dependent_on_salary',
                    'has_loans',
                    'has_filed_assets_liabilities',
                    'assets_liabilities_agency',
                    'assets_liabilities_month',
                    'assets_liabilities_year',
                    'has_filed_itr',
                    'itr_amount',
                ])
            );

            \Log::info('CreditReputation after save:', $creditReputation->toArray());

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

            \Log::info('CreditReputation related data after save:', [
                'other_incomes' => $creditReputation->otherIncomes()->get()->toArray(),
                'bank_accounts' => $creditReputation->bankAccounts()->get()->toArray(),
                'character_references' => $creditReputation->characterReferences()->get()->toArray(),
            ]);

            // The next section is arrest-record
            return redirect()->route('phs.arrest-record')
                ->with('success', 'Credit reputation saved successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your credit reputation. Please try again.');
        }
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
