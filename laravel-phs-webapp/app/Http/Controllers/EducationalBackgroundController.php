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
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'elementary' => 'nullable|array',
                'highschool' => 'nullable|array',
                'college' => 'nullable|array',
                'postgrad' => 'nullable|array',
                'other_schools_training' => 'nullable|string',
                'civil_service_qualifications' => 'nullable|string',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'elementary' => 'nullable|array',
                'highschool' => 'nullable|array',
                'college' => 'nullable|array',
                'postgrad' => 'nullable|array',
                'other_schools_training' => 'nullable|string',
                'civil_service_qualifications' => 'nullable|string',
            ]);
        }
        try {
            $username = auth()->user()->username;
            \App\Helper\DataUpdate::saveEducationalBackground($validated, $username);
            $this->markSectionAsCompleted('educational-background');
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
