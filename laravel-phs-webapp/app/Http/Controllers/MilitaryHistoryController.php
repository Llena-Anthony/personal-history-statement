<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

class MilitaryHistoryController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $data = $this->getCommonViewData('military-history');

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.military-history', $data)->render();
        }

        return view('phs.military-history', $data);
    }

    public function store(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'military_service' => 'nullable|string|max:255',
                'military_details' => 'nullable|string|max:1000',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'military_service' => 'nullable|string|max:255',
                'military_details' => 'nullable|string|max:1000',
            ]);
        }

        // Mark military history as completed
        $this->markSectionAsCompleted('military-history');

        // Return appropriate response based on mode
        if ($isSaveOnly) {
            return response()->json(['success' => true, 'message' => 'Military history saved successfully']);
        }

        return redirect()->route('phs.places-of-residence.create')
            ->with('success', 'Military history saved successfully. Please continue with your places of residence.');
    }
} 