<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalCharacteristic;
use App\Traits\PHSSectionTracking;

class PersonalCharacteristicsController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $data = $this->getCommonViewData('personal-characteristics');

        // Check if it's an AJAX request
        if (request()->ajax()) {
            // For AJAX requests, return the full view with layout so content extraction works properly
            return view('phs.personal-characteristics', $data);
        }

        return view('phs.personal-characteristics', $data);
    }

    public function store(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'sex' => 'nullable|in:male,female',
                'age' => 'nullable|integer|min:1|max:120',
                'height' => 'nullable|numeric|min:0.50|max:2.50',
                'weight' => 'nullable|numeric|min:20|max:300',
                'body_build' => 'nullable|in:heavy,medium,light',
                'complexion' => 'nullable|in:dark,fair,light',
                'hair_color' => 'nullable|string|max:50',
                'eye_color' => 'nullable|string|max:50',
                'distinguishing_features' => 'nullable|string|max:1000',
                'health_status' => 'nullable|in:excellent,good,poor',
                'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                'recent_illness' => 'nullable|string|max:1000',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'sex' => 'required|in:male,female',
                'age' => 'required|integer|min:1|max:120',
                'height' => 'required|numeric|min:0.50|max:2.50',
                'weight' => 'required|numeric|min:20|max:300',
                'body_build' => 'required|in:heavy,medium,light',
                'complexion' => 'required|in:dark,fair,light',
                'hair_color' => 'required|string|max:50',
                'eye_color' => 'required|string|max:50',
                'distinguishing_features' => 'nullable|string|max:1000',
                'health_status' => 'required|in:excellent,good,poor',
                'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
                'recent_illness' => 'nullable|string|max:1000',
            ]);
        }

        // Add user_id to the validated data
        $validated['user_id'] = auth()->id();

        // Create or update personal characteristics
        PersonalCharacteristic::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        // Mark section as completed
        $this->markSectionAsCompleted('personal-characteristics');

        // Return appropriate response based on mode
        if ($isSaveOnly) {
            return response()->json(['success' => true, 'message' => 'Personal characteristics saved successfully']);
        }

        return redirect()->route('phs.marital-status.create')
            ->with('success', 'Personal characteristics saved successfully. Please continue with your marital status.');
    }
} 