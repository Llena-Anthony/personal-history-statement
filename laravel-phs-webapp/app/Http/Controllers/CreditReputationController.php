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
        $data = $this->getCommonViewData('credit-reputation');
        $data['creditDetail'] = $creditDetail;
        $data['creditReferences'] = $creditReferences;
        // You may want to decode JSON fields for the view here if needed
        return view('phs.credit-reputation', $data);
    }

    public function store(Request $request)
    {
        $this->markSectionAsCompleted('credit-reputation');
        $username = auth()->user()->username;
        // Validation can be added here as needed
        $data = [
            'credit' => [
                'other_incomes' => $request->input('other_incomes', []),
                'assets_liabilities_agency' => $request->input('assets_liabilities_agency'),
                'assets_liabilities_month' => $request->input('assets_liabilities_month'),
                'assets_liabilities_year' => $request->input('assets_liabilities_year'),
                'itr_amount' => $request->input('itr_amount'),
            ],
            'references' => array_map(function($ref) {
                return [
                    'bank_name' => $ref['name'] ?? null,
                    'bank_address' => $ref['address'] ?? null,
                ];
            }, $request->input('character_references', [])),
        ];
        \App\Helper\DataUpdate::saveCreditReputation($data, $username);
        return redirect()->route('phs.arrest-record.create')
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
