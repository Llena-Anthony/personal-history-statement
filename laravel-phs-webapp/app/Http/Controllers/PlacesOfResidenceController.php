<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

class PlacesOfResidenceController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $data = $this->getCommonViewData('places-of-residence');

        // Return partial for AJAX requests, full view for normal requests
        if (request()->ajax()) {
            return view('phs.sections.places-of-residence-content', $data);
        }

        return view('phs.places-of-residence', $data);
    }

    public function store(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'residences.*.address' => 'nullable|string|max:255',
                'residences.*.from_date' => 'nullable|date',
                'residences.*.to_date' => 'nullable|date',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'residences.*.address' => 'nullable|string|max:255',
                'residences.*.from_date' => 'nullable|date',
                'residences.*.to_date' => 'nullable|date',
            ]);
        }

        // Mark places of residence as completed
        $this->markSectionAsCompleted('places-of-residence');

        // Return appropriate response based on mode
        if ($isSaveOnly) {
            return response()->json(['success' => true, 'message' => 'Places of residence saved successfully']);
        }

        return redirect()->route('phs.employment-history.create')
            ->with('success', 'Places of residence saved successfully. Please continue with your employment history.');
    }
} 