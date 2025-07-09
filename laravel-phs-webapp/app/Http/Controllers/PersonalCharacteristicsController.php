<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DescriptionDetail;
use App\Traits\PHSSectionTracking;
use App\Helper\DataRetrieval;

class PersonalCharacteristicsController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        // Load existing personal characteristics data for autofill
        $personalCharacteristics = (object) DataRetrieval::retrievePersonalCharacteristics(auth()->user()->username);

        $data = $this->getCommonViewData('personal-characteristics');
        $data['personalCharacteristics'] = $personalCharacteristics;

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
        try {
            // Get all request data without validation
            $data = $request->all();

            // Remove CSRF token and other non-database fields
            unset($data['_token']);

            // Filter out null and empty values to avoid NOT NULL constraint violations
            $data = array_filter($data, function($value) {
                return $value !== null && $value !== '';
            });

            // Add username to data
            $data['username'] = auth()->user()->username;

            // Simple check for height to fit database decimal(3,2) constraint
            if (isset($data['height'])) {
                $height = floatval($data['height']);
                // Limit height to 9.99 to fit decimal(3,2) constraint
                $data['height'] = min(9.99, $height);
            }

            // Convert and validate numeric fields (except height - save as provided)
            if (isset($data['weight'])) {
                $weight = floatval($data['weight']);
                // If weight is greater than 300, assume it's in pounds and convert to kg
                if ($weight > 300) {
                    $weight = $weight * 0.453592; // Convert pounds to kg
                }
                // Ensure weight is within valid range (20 to 300 kg)
                $data['weight'] = max(20, min(300, $weight));
            }

            if (isset($data['age'])) {
                $data['age'] = intval($data['age']);
                // Ensure age is within valid range (1 to 120)
                $data['age'] = max(1, min(120, $data['age']));
            }

            if (isset($data['shoe_size'])) {
                $data['shoe_size'] = floatval($data['shoe_size']);
                // Ensure shoe size is within valid range (1 to 20)
                $data['shoe_size'] = max(1, min(20, $data['shoe_size']));
            }

            // Save or update personal characteristics
            $personalCharacteristics = DescriptionDetail::updateOrCreate(
                ['username' => auth()->user()->username],
                $data
            );

            \Log::info('PersonalCharacteristics after save:', $personalCharacteristics->toArray());

            // Mark personal characteristics as completed
            $this->markSectionAsCompleted('personal-characteristics');

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Personal characteristics saved successfully']);
            }

            $nextRoute = auth()->user()->role === 'personnel'
                ? 'personnel.phs.marital-status.create'
                : 'phs.marital-status.create';

            return redirect()->route($nextRoute)
                ->with('success', 'Personal characteristics saved successfully. Please continue with your marital status.');
        } catch (\Exception $e) {
            \Log::error('PersonalCharacteristics save error:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'An error occurred while saving your personal characteristics. Please try again.');
        }
    }
}
