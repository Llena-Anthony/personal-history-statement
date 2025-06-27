<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;

class ForeignCountriesController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $data = $this->getCommonViewData('foreign-countries');

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.sections.foreign-countries-content', $data);
        }

        return view('phs.foreign-countries', $data);
    }

    public function store(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'countries.*.name' => 'nullable|string|max:255',
                'countries.*.purpose' => 'nullable|string|max:255',
                'countries.*.from_month' => 'nullable|string|max:2',
                'countries.*.from_year' => 'nullable|integer|min:1900|max:2030',
                'countries.*.to_month' => 'nullable|string|max:2',
                'countries.*.to_year' => 'nullable|integer|min:1900|max:2030',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'countries.*.name' => 'nullable|string|max:255',
                'countries.*.purpose' => 'nullable|string|max:255',
                'countries.*.from_month' => 'nullable|string|max:2',
                'countries.*.from_year' => 'nullable|integer|min:1900|max:2030',
                'countries.*.to_month' => 'nullable|string|max:2',
                'countries.*.to_year' => 'nullable|integer|min:1900|max:2030',
            ]);
        }

        // Mark foreign countries as completed
        $this->markSectionAsCompleted('foreign-countries');

        // Return appropriate response based on mode
        if ($isSaveOnly) {
            return response()->json(['success' => true, 'message' => 'Foreign countries visited saved successfully']);
        }

        return redirect()->route('phs.credit-reputation')
            ->with('success', 'Foreign countries visited saved successfully. Please continue with your credit reputation.');
    }
} 