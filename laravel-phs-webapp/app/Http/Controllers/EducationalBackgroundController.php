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
        $username = auth()->user()->username;
        // Prefill: retrieve all EducationDetail records for the user, grouped by level and special
        $educationDetails = \App\Models\EducationDetail::where('username', $username)->get();
        $prefill = [
            'elementary' => $educationDetails->where('educ_level', 'elementary')->values()->all(),
            'highschool' => $educationDetails->where('educ_level', 'highschool')->values()->all(),
            'college' => $educationDetails->where('educ_level', 'college')->values()->all(),
            'postgraduate' => $educationDetails->where('educ_level', 'postgraduate')->values()->all(),
            'other_schools_training' => optional($educationDetails->where('educ_level', 'other_training')->first())->other_training ?? '',
            'civil_service_qualifications' => optional($educationDetails->where('educ_level', 'civil_service')->first())->civil_service ?? '',
        ];
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
        // Accept arrays for each level and special fields
        $validated = $request->validate([
            'elementary' => 'nullable|array',
            'elementary.*.school' => 'nullable|string|max:255',
            'elementary.*.address' => 'nullable|string|max:255',
            'elementary.*.start' => 'nullable|string|max:255',
            'elementary.*.graduate' => 'nullable|string|max:255',
            'highschool' => 'nullable|array',
            'highschool.*.school' => 'nullable|string|max:255',
            'highschool.*.address' => 'nullable|string|max:255',
            'highschool.*.start' => 'nullable|string|max:255',
            'highschool.*.graduate' => 'nullable|string|max:255',
            'college' => 'nullable|array',
            'college.*.school' => 'nullable|string|max:255',
            'college.*.address' => 'nullable|string|max:255',
            'college.*.start' => 'nullable|string|max:255',
            'college.*.graduate' => 'nullable|string|max:255',
            'postgraduate' => 'nullable|array',
            'postgraduate.*.school' => 'nullable|string|max:255',
            'postgraduate.*.address' => 'nullable|string|max:255',
            'postgraduate.*.start' => 'nullable|string|max:255',
            'postgraduate.*.graduate' => 'nullable|string|max:255',
            'other_schools_training' => 'nullable|string',
            'civil_service_qualifications' => 'nullable|string',
        ]);
        \App\Helper\DataUpdate::saveOrUpdateEducationDetails(auth()->user()->username, $validated);
        $this->markSectionAsCompleted('educational-background');
        if ($isSaveOnly) {
            return response()->json(['success' => true, 'message' => 'Educational background saved successfully']);
        }
        return redirect()->route('phs.military-history.create')
            ->with('success', 'Educational background saved successfully. Please continue with your military history.');
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
