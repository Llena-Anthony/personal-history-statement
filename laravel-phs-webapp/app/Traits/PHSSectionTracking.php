<?php

namespace App\Traits;

trait PHSSectionTracking
{
    /**
     * Get the current status of all PHS sections
     */
    protected function getSectionStatus()
    {
        $sections = [
            'personal-details' => session('phs_sections.personal-details', 'not-started'), // I: Personal Details
            'personal-characteristics' => session('phs_sections.personal-characteristics', 'not-started'), // II: Personal Characteristics
            'marital-status' => session('phs_sections.marital-status', 'not-started'), // III: Marital Status
            'family-history' => session('phs_sections.family-history', 'not-started'), // IV: Family History
            'educational-background' => session('phs_sections.educational-background', 'not-started'), // V: Educational Background
            'military-history' => session('phs_sections.military-history', 'not-started'), // VI: Military History
            'places-of-residence' => session('phs_sections.places-of-residence', 'not-started'), // VII: Places of Residence Since Birth
            'employment-history' => session('phs_sections.employment-history', 'not-started'), // VIII: Employment History
            'foreign-countries' => session('phs_sections.foreign-countries', 'not-started'), // IX: Foreign Countries Visited
            'credit-reputation' => session('phs_sections.credit-reputation', 'not-started'), // X: Credit Reputation
            'arrest-record' => session('phs_sections.arrest-record', 'not-started'), // XI: Arrest Record and Conduct
            'employment-history-2' => session('phs_sections.employment-history-2', 'not-started'), // XII: Employment tHistory (possible duplicate, clarify if needed)
            'organization' => session('phs_sections.organization', 'not-started'), // XIII: Organization
            'miscellaneous' => session('phs_sections.miscellaneous', 'not-started'), // XIV: Miscellaneous
        ];

        return $sections;
    }

    /**
     * Mark a section as visited
     */
    protected function markSectionAsVisited($sectionId)
    {
        session(["phs_sections.{$sectionId}" => 'visited']);
    }

    /**
     * Mark a section as completed
     */
    protected function markSectionAsCompleted($sectionId)
    {
        session(["phs_sections.{$sectionId}" => 'completed']);
    }

    /**
     * Get common view data for PHS sections
     */
    protected function getCommonViewData($currentSection)
    {
        $this->markSectionAsVisited($currentSection);
        
        return [
            'currentSection' => $currentSection,
            'sectionStatus' => $this->getSectionStatus()
        ];
    }
} 