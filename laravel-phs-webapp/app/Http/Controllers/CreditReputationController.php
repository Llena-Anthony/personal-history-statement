<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

use App\Models\CreditDetail;
use App\Models\CreditReferenceDetail;

use Illuminate\Support\Facades\Auth;
use App\Helper\DataRetrieval;

class CreditReputationController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $username = auth()->user()->username;
        $creditDetail = \App\Models\CreditDetail::where('username', $username)->first();
        $creditReferences = \App\Models\CreditReferenceDetail::with(['bankDetail.addressDetail'])->where('username', $username)->get();
        $bankAccounts = \App\Helper\DataRetrieval::retrieveBankAccounts($username);
        $otherIncomes = collect();
        // Provide a default creditReputation object to prevent undefined errors
        $creditReputation = (object)[
            'dependent_on_salary' => null,
            'has_loans' => null,
            'has_filed_assets_liabilities' => null,
            'has_filed_itr' => null,
        ];
        // Prefill credit reference addresses
        $creditReferencesArr = [];
        foreach ($creditReferences as $ref) {
            $address = $ref->bankDetail && $ref->bankDetail->addressDetail ? $ref->bankDetail->addressDetail : null;
            $creditReferencesArr[] = [
                'name' => $ref->bankDetail ? $ref->bankDetail->bank : '',
                'region' => $address ? $address->region : '',
                'province' => $address ? $address->province : '',
                'city' => $address ? $address->city : '',
                'barangay' => $address ? $address->barangay : '',
                'street' => $address ? $address->street : '',
            ];
        }
        // Prepare known banks for JS
        $knownBanks = \App\Models\BankDetail::with('addressDetail')->get()->map(function($bank) {
            return [
                'name' => $bank->bank,
                'region' => $bank->addressDetail->region ?? '',
                'province' => $bank->addressDetail->province ?? '',
                'city' => $bank->addressDetail->city ?? '',
                'barangay' => $bank->addressDetail->barangay ?? '',
                'street' => $bank->addressDetail->street ?? '',
            ];
        });
        $data = $this->getCommonViewData('credit-reputation');
        $data['creditDetail'] = $creditDetail;
        $data['creditReferences'] = collect($creditReferencesArr);
        $data['bankAccounts'] = $bankAccounts;
        $data['creditReputation'] = $creditReputation;
        $data['otherIncomes'] = $otherIncomes;
        $data['knownBanks'] = $knownBanks;
        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.sections.credit-reputation-content', $data)->render();
        }
        return view('phs.credit-reputation', $data);
    }

    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        try {
            // Validation (minimal for save-only, full for final submission)
            $refRules = [
                'character_references' => 'nullable|array',
                'character_references.*.name' => 'nullable|string|max:255',
                'character_references.*.region' => 'nullable|string|max:255',
                'character_references.*.province' => 'nullable|string|max:255',
                'character_references.*.city' => 'nullable|string|max:255',
                'character_references.*.barangay' => 'nullable|string|max:255',
                'character_references.*.street' => 'nullable|string|max:255',
            ];
            if ($isSaveOnly) {
                $validated = $request->validate($refRules + [
                    'other_incomes' => 'nullable|array',
                    'assets_liabilities_agency' => 'nullable|string|max:255',
                    'assets_liabilities_month' => 'nullable|string|max:2',
                    'assets_liabilities_year' => 'nullable|integer|min:1900|max:2030',
                    'itr_amount' => 'nullable|string|max:255',
                ]);
            } else {
                $validated = $request->validate($refRules + [
                    'other_incomes' => 'nullable|array',
                    'assets_liabilities_agency' => 'nullable|string|max:255',
                    'assets_liabilities_month' => 'nullable|string|max:2',
                    'assets_liabilities_year' => 'nullable|integer|min:1900|max:2030',
                    'itr_amount' => 'nullable|string|max:255',
                ]);
            }
            $username = auth()->user()->username;
            $data = [
                'credit' => [
                    'other_incomes' => $validated['other_incomes'] ?? [],
                    'assets_liabilities_agency' => $validated['assets_liabilities_agency'] ?? null,
                    'assets_liabilities_month' => $validated['assets_liabilities_month'] ?? null,
                    'assets_liabilities_year' => $validated['assets_liabilities_year'] ?? null,
                    'itr_amount' => $validated['itr_amount'] ?? null,
                ],
                'references' => array_map(function($ref) {
                    return [
                        'bank_name' => $ref['name'] ?? null,
                        'region' => $ref['region'] ?? null,
                        'province' => $ref['province'] ?? null,
                        'city' => $ref['city'] ?? null,
                        'barangay' => $ref['barangay'] ?? null,
                        'street' => $ref['street'] ?? null,
                    ];
                }, $validated['character_references'] ?? []),
            ];
            // Save logic: clear old, add new
            \App\Models\CreditReferenceDetail::where('username', $username)->delete();
            foreach ($data['references'] as $ref) {
                if (!empty($ref['bank_name'])) {
                    // Find or create address for the bank
                    $address = null;
                    if (!empty($ref['region']) || !empty($ref['province']) || !empty($ref['city']) || !empty($ref['barangay']) || !empty($ref['street'])) {
                        $address = \App\Models\AddressDetail::firstOrCreate([
                            'country' => 'Philippines',
                            'region' => $ref['region'] ?? '',
                            'province' => $ref['province'] ?? '',
                            'city' => $ref['city'] ?? '',
                            'barangay' => $ref['barangay'] ?? '',
                            'street' => $ref['street'] ?? '',
                        ]);
                    }
                    // Find or create the bank by name and address
                    $bank = \App\Models\BankDetail::firstOrCreate([
                        'bank' => $ref['bank_name'],
                        'bank_addr' => $address ? $address->addr_id : null,
                    ]);
                    \App\Models\CreditReferenceDetail::create([
                        'bank' => $bank->bank_id,
                        'username' => $username,
                    ]);
                }
            }
            // Save/update CreditDetail
            $creditData = $data['credit'];
            $other_income_src = null;
            if (!empty($creditData['other_incomes'])) {
                $other_income_src = json_encode(array_filter(array_column($creditData['other_incomes'], 'source')));
            }
            $saln_detail = null;
            if (!empty($creditData['assets_liabilities_agency']) || !empty($creditData['assets_liabilities_month']) || !empty($creditData['assets_liabilities_year'])) {
                $saln_detail = json_encode([
                    'agency' => $creditData['assets_liabilities_agency'] ?? null,
                    'month' => $creditData['assets_liabilities_month'] ?? null,
                    'year' => $creditData['assets_liabilities_year'] ?? null,
                ]);
            }
            $amount_paid = null;
            if (!empty($creditData['itr_amount'])) {
                $amount_paid = $creditData['itr_amount'];
            }
            \App\Models\CreditDetail::updateOrCreate(
                ['username' => $username],
                [
                    'other_income_src' => $other_income_src,
                    'saln_detail' => $saln_detail,
                    'amount_paid' => $amount_paid,
                ]
            );
            $this->markSectionAsCompleted('credit-reputation');
            session()->save();
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Credit reputation saved successfully']);
            }
            if ($request->ajax()) {
                $nextRoute = route('phs.arrest-record.create');
                return response()->json([
                    'success' => true,
                    'next_route' => $nextRoute
                ]);
            }
            return redirect()->route('phs.arrest-record.create')
                ->with('success', 'Credit reputation saved successfully. Please continue with your arrest record.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Exception in CreditReputationController@store', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your credit reputation. Please try again.');
        }
    }

    protected function getSections()
    {
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
            'character-and-reputation',
            'organization',
            'miscellaneous'
        ];
    }
}
