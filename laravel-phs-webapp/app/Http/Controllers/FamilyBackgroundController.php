<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

class FamilyBackgroundController extends Controller
{
    use PHSSectionTracking;

    /**
     * Show the form for creating a new family background.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('phs.family-background', $this->getCommonViewData('family-background'));
    }

    /**
     * Store a newly created family background in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Mark family background as completed
        $this->markSectionAsCompleted('family-background');
        
        // TODO: Add validation and storage logic
        return redirect()->route('phs.educational-background')
            ->with('success', 'Family background saved successfully!');
    }

    /**
     * Get the current status of all PHS sections
     */
    private function getSectionStatus()
    {
        $sections = [
            'personal-details' => session('phs_sections.personal-details', 'not-started'),
            'family-background' => session('phs_sections.family-background', 'not-started'),
            'educational-background' => session('phs_sections.educational-background', 'not-started'),
            'employment-history' => session('phs_sections.employment-history', 'not-started'),
            'military-history' => session('phs_sections.military-history', 'not-started'),
            'places-of-residence' => session('phs_sections.places-of-residence', 'not-started'),
            'foreign-countries' => session('phs_sections.foreign-countries', 'not-started'),
            'personal-characteristics' => session('phs_sections.personal-characteristics', 'not-started'),
            'marital-status' => session('phs_sections.marital-status', 'not-started'),
            'family-history' => session('phs_sections.family-history', 'not-started'),
        ];

        return $sections;
    }
} 