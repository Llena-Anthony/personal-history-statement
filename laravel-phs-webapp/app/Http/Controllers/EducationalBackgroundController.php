<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

use App\Models\User;
use App\Helper\DataRetrieval;

class EducationalBackgroundController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $prefill = DataRetrieval::retrieveEducationalBackground(auth()->user()->username);
        $data = $this->getCommonViewData('educational-background');
        $data = array_merge($data, $prefill);
        return view('phs.educational-background', $data);
    }

    public function index()
    {
        return view('phs.educational-background', $this->getCommonViewData('educational-background'));
    }

    public function store(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';

        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'elementary_school' => 'nullable|string|max:255',
                'elementary_degree' => 'nullable|string|max:255',
                'elementary_period_from' => 'nullable|string|max:255',
                'elementary_period_to' => 'nullable|string|max:255',
                'elementary_highest_level' => 'nullable|string|max:255',
                'elementary_year_graduated' => 'nullable|string|max:255',
                'elementary_scholarship' => 'nullable|string|max:255',
                'high_school_school' => 'nullable|string|max:255',
                'high_school_degree' => 'nullable|string|max:255',
                'high_school_period_from' => 'nullable|string|max:255',
                'high_school_period_to' => 'nullable|string|max:255',
                'high_school_highest_level' => 'nullable|string|max:255',
                'high_school_year_graduated' => 'nullable|string|max:255',
                'high_school_scholarship' => 'nullable|string|max:255',
                'college_school' => 'nullable|string|max:255',
                'college_degree' => 'nullable|string|max:255',
                'college_period_from' => 'nullable|string|max:255',
                'college_period_to' => 'nullable|string|max:255',
                'college_highest_level' => 'nullable|string|max:255',
                'college_year_graduated' => 'nullable|string|max:255',
                'college_scholarship' => 'nullable|string|max:255',
                'graduate_school' => 'nullable|string|max:255',
                'graduate_degree' => 'nullable|string|max:255',
                'graduate_period_from' => 'nullable|string|max:255',
                'graduate_period_to' => 'nullable|string|max:255',
                'graduate_highest_level' => 'nullable|string|max:255',
                'graduate_year_graduated' => 'nullable|string|max:255',
                'graduate_scholarship' => 'nullable|string|max:255',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'elementary_school' => 'nullable|string|max:255',
                'elementary_degree' => 'nullable|string|max:255',
                'elementary_period_from' => 'nullable|string|max:255',
                'elementary_period_to' => 'nullable|string|max:255',
                'elementary_highest_level' => 'nullable|string|max:255',
                'elementary_year_graduated' => 'nullable|string|max:255',
                'elementary_scholarship' => 'nullable|string|max:255',
                'high_school_school' => 'nullable|string|max:255',
                'high_school_degree' => 'nullable|string|max:255',
                'high_school_period_from' => 'nullable|string|max:255',
                'high_school_period_to' => 'nullable|string|max:255',
                'high_school_highest_level' => 'nullable|string|max:255',
                'high_school_year_graduated' => 'nullable|string|max:255',
                'high_school_scholarship' => 'nullable|string|max:255',
                'college_school' => 'nullable|string|max:255',
                'college_degree' => 'nullable|string|max:255',
                'college_period_from' => 'nullable|string|max:255',
                'college_period_to' => 'nullable|string|max:255',
                'college_highest_level' => 'nullable|string|max:255',
                'college_year_graduated' => 'nullable|string|max:255',
                'college_scholarship' => 'nullable|string|max:255',
                'graduate_school' => 'nullable|string|max:255',
                'graduate_degree' => 'nullable|string|max:255',
                'graduate_period_from' => 'nullable|string|max:255',
                'graduate_period_to' => 'nullable|string|max:255',
                'graduate_highest_level' => 'nullable|string|max:255',
                'graduate_year_graduated' => 'nullable|string|max:255',
                'graduate_scholarship' => 'nullable|string|max:255',
            ]);
        }

        try {
            // Add user_id to validated data
            $validated['user_id'] = auth()->id();

            \Log::info('EducationalBackground validated data:', $validated);

            // Save or update educational background
            $educationalBackground = EducationalBackground::updateOrCreate(
                ['user_id' => auth()->id()],
                $validated
            );

            \Log::info('EducationalBackground before save:', ['user_id' => auth()->id(), 'data' => $validated]);

            \Log::info('EducationalBackground after save:', $educationalBackground->toArray());

            // Mark educational background as completed
            $this->markSectionAsCompleted('educational-background');

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Educational background saved successfully']);
            }

            return redirect()->route('phs.military-history.create')
                ->with('success', 'Educational background saved successfully. Please continue with your military history.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your educational background. Please try again.');
        }
    }

    /**
     * Get the list of PHS sections for progress calculation.
     *
     * @return array
     */
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
            'personal-characteristics',
            'marital-status',
            'family-history',
        ];
    }
}
