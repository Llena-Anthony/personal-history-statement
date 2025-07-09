<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Models\User;
use App\Helper\DataRetrieval;

class EmploymentHistoryController extends Controller
{
    use PHSSectionTracking;

    /**
     * Show the form for creating a new employment history entry.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $username = auth()->user()->username;
        $employment_history = \App\Models\EmploymentDetail::with('addressDetail')->where('username', $username)->get();
        $data = $this->getCommonViewData('employment-history');
        $data['employment_history'] = $employment_history;
        return view('phs.employment-history', $data);
    }

    /**
     * Store a newly created employment history entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';

        // Validation (keep as is, but for array of employment entries)
        if ($isSaveOnly) {
            $validated = $request->validate([
                'employment' => 'nullable|array',
                'employment.*.from_month' => 'nullable|string|max:2',
                'employment.*.from_year' => 'nullable|integer|min:1900|max:2030',
                'employment.*.to_month' => 'nullable|string|max:2',
                'employment.*.to_year' => 'nullable|integer|min:1900|max:2030',
                'employment.*.type' => 'nullable|string|max:255',
                'employment.*.employer_name' => 'nullable|string|max:255',
                'employment.*.employer_address' => 'nullable|string|max:255',
                'employment.*.reason_leaving' => 'nullable|string|max:255',
                'dismissed' => 'nullable|string|max:10',
                'dismissed_explanation' => 'nullable|string|max:255',
            ]);
        } else {
            $validated = $request->validate([
                'employment' => 'nullable|array',
                'employment.*.from_month' => 'nullable|string|max:2',
                'employment.*.from_year' => 'nullable|integer|min:1900|max:2030',
                'employment.*.to_month' => 'nullable|string|max:2',
                'employment.*.to_year' => 'nullable|integer|min:1900|max:2030',
                'employment.*.type' => 'nullable|string|max:255',
                'employment.*.employer_name' => 'nullable|string|max:255',
                'employment.*.employer_address' => 'nullable|string|max:255',
                'employment.*.reason_leaving' => 'nullable|string|max:255',
                'dismissed' => 'nullable|string|max:10',
                'dismissed_explanation' => 'nullable|string|max:255',
            ]);
        }

        try {
            $username = auth()->user()->username;
            $data = [
                'employment' => $validated['employment'] ?? [],
                'dismissed' => $validated['dismissed'] ?? null,
                'dismissed_explanation' => $validated['dismissed_explanation'] ?? null,
            ];
            \App\Helper\DataUpdate::saveEmploymentHistory($data, $username);

            $this->markSectionAsCompleted('employment-history');

            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Employment history saved successfully']);
            }

            return redirect()->route('phs.foreign-countries.create')
                ->with('success', 'Employment history saved successfully. Please continue with your foreign countries.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your employment history. Please try again.');
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
            'character-references',
            'organization',
            'miscellaneous'
        ];
    }
}
