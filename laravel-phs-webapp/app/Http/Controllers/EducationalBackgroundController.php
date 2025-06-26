<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

class EducationalBackgroundController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $viewData = $this->getCommonViewData('educational-background');
        
        // Return partial for AJAX requests, full view for normal requests
        if (request()->ajax()) {
            return view('phs.sections.educational-background-content', $viewData);
        }
        
        return view('phs.educational-background', $viewData);
    }

    public function index()
    {
        return view('phs.educational-background', $this->getCommonViewData('educational-background'));
    }

    public function store(Request $request)
    {
        // Mark as completed
        $this->markSectionAsCompleted('educational-background');

        // TODO: Add validation and data storage

        // The next section is likely 'employment-history'
        return redirect()->route('phs.employment-history.create')
            ->with('success', 'Educational background saved successfully!');
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