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
        $data = $this->getCommonViewData('employment-history');

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.sections.employment-history-content', $data);
        }

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
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'company_name' => 'nullable|array',
                'company_name.*' => 'nullable|string|max:255',
                'employment_type' => 'nullable|array',
                'employment_type.*' => 'nullable|string|max:255',
                'company_address' => 'nullable|array',
                'company_address.*' => 'nullable|string|max:255',
                'start_date' => 'nullable|array',
                'start_date.*' => 'nullable|date',
                'end_date' => 'nullable|array',
                'end_date.*' => 'nullable|date',
                'dismissed' => 'nullable|in:yes,no',
                'dismissed_explanation' => 'nullable|string|max:1000',
            ]);
        } else {
            // Full validation for final submission
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
        }

        // Mark employment history as completed
        $this->markSectionAsCompleted('employment-history');

        // Return appropriate response based on mode
        if ($isSaveOnly) {
            return response()->json(['success' => true, 'message' => 'Employment history saved successfully']);
        }

        // TODO: Add storage logic
        // For now, just redirect to the next section
        return redirect()->route('phs.foreign-countries.create')
            ->with('success', 'Employment history saved successfully. Please continue with your foreign countries visited.');
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