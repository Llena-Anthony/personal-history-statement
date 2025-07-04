<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Models\User;

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
        // Load existing employment history data for autofill
        $employmentHistory = User::where('username', auth()->id())->first();

        $data = $this->getCommonViewData('employment-history');
        $data['employmentHistory'] = $employmentHistory;

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
                'inclusive_dates' => 'nullable|string|max:255',
                'employment_type' => 'nullable|string|max:255',
                'employment_address' => 'nullable|string|max:255',
                'employment_reason_for_leaving' => 'nullable|string|max:255',
                'employer_name' => 'nullable|string|max:255',
                'employer_addr' => 'nullable|string|max:255',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'inclusive_dates' => 'nullable|string|max:255',
                'employment_type' => 'nullable|string|max:255',
                'employment_address' => 'nullable|string|max:255',
                'employment_reason_for_leaving' => 'nullable|string|max:255',
                'employer_name' => 'nullable|string|max:255',
                'employer_addr' => 'nullable|string|max:255',
            ]);
        }

        try {
            // Add user_id to validated data
            $validated['user_id'] = auth()->id();

            \Log::info('EmploymentHistory validated data:', $validated);

            // Save or update employment history
            $employmentHistory = EmploymentHistory::updateOrCreate(
                ['user_id' => auth()->id()],
                $validated
            );

            \Log::info('EmploymentHistory before save:', ['user_id' => auth()->id(), 'data' => $validated]);

            // Mark employment history as completed
            $this->markSectionAsCompleted('employment-history');

            \Log::info('EmploymentHistory after save:', $employmentHistory->toArray());

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Employment history saved successfully']);
            }

            return redirect()->route('phs.places-of-residence.create')
                ->with('success', 'Employment history saved successfully. Please continue with your places of residence.');
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
