<?php

namespace App\Http\Controllers\Personnel;

use App\Http\Controllers\Controller;
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
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        try {
            // Validate and transform input as needed
            $data = $request->except(['_token']);

            // Numeric/validation logic
            if (isset($data['height'])) {
                $height = floatval($data['height']);
                $data['height'] = min(9.99, $height);
            }
            if (isset($data['weight'])) {
                $weight = floatval($data['weight']);
                if ($weight > 300) {
                    $weight = $weight * 0.453592;
                }
                $data['weight'] = max(20, min(300, $weight));
            }
            if (isset($data['age'])) {
                $data['age'] = intval($data['age']);
                $data['age'] = max(1, min(120, $data['age']));
            }
            if (isset($data['shoe_size'])) {
                $data['shoe_size'] = floatval($data['shoe_size']);
                $data['shoe_size'] = max(1, min(20, $data['shoe_size']));
            }

            // Remove empty/null values
            $data = array_filter($data, function($value) {
                return $value !== null && $value !== '';
            });

            // Save using DataUpdate helper
            $username = auth()->user()->username;
            \App\Helper\DataUpdate::savePersonalCharacteristics($data, $username);

            \Log::info('PersonalCharacteristics after save:', $data);

            $this->markSectionAsCompleted('personal-characteristics');

            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Personal characteristics saved successfully']);
            }

            $nextRoute = route('personnel.phs.marital-status.create');
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'next_route' => $nextRoute
                ]);
            }

            return redirect($nextRoute)
                ->with('success', 'Personal characteristics saved successfully. Please continue with your marital status.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Exception in Personnel PersonalCharacteristicsController@store', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your personal characteristics. Please try again.');
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
            'organization',
            'miscellaneous',
        ];
    }
}
