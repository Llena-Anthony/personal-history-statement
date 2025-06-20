<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

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
        return view('phs.employment-history', $this->getCommonViewData('employment-history'));
    }

    /**
     * Store a newly created employment history entry.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // TODO: Add validation rules
        $validated = $request->validate([
            'company_name' => 'required|array',
            'company_name.*' => 'required|string|max:255',
            'employment_type' => 'required|array',
            'employment_type.*' => 'required|string|max:255',
            'company_address' => 'required|array',
            'company_address.*' => 'required|string|max:255',
            'start_date' => 'required|array',
            'start_date.*' => 'required|date',
            'end_date' => 'required|array',
            'end_date.*' => 'required|date|after_or_equal:start_date.*',
            'dismissed' => 'required|in:yes,no',
            'dismissed_explanation' => 'required_if:dismissed,yes|nullable|string|max:1000',
        ]);

        // TODO: Add storage logic
        // For now, just redirect to the next section
        return redirect()->route('phs.organization.create');
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