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
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'other_incomes' => 'nullable|array',
                    'assets_liabilities_agency' => 'nullable|string|max:255',
                    'assets_liabilities_month' => 'nullable|string|max:2',
                    'assets_liabilities_year' => 'nullable|integer|min:1900|max:2030',
                    'itr_amount' => 'nullable|string|max:255',
                    'character_references' => 'nullable|array',
                    'character_references.*.name' => 'nullable|string|max:255',
                    'character_references.*.address' => 'nullable|string|max:255',
                ]);
            } else {
                $validated = $request->validate([
                    'other_incomes' => 'nullable|array',
                    'assets_liabilities_agency' => 'nullable|string|max:255',
                    'assets_liabilities_month' => 'nullable|string|max:2',
                    'assets_liabilities_year' => 'nullable|integer|min:1900|max:2030',
                    'itr_amount' => 'nullable|string|max:255',
                    'character_references' => 'nullable|array',
                    'character_references.*.name' => 'nullable|string|max:255',
                    'character_references.*.address' => 'nullable|string|max:255',
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
                        'bank_address' => $ref['address'] ?? null,
                    ];
                }, $validated['character_references'] ?? []),
            ];
            
            \App\Helper\DataUpdate::saveCreditReputation($data, $username);
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
