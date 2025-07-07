<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Models\User;

class ForeignCountriesController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        // Load existing foreign visits data for autofill
        $foreignVisits = User::where('username', auth()->id())->first();

        $data = $this->getCommonViewData('foreign-countries');
        $data['foreignVisits'] = $foreignVisits;

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

        try {
            \Log::info('ForeignCountries validated data:', $validated);

            // Clear existing foreign visits for this user
            ForeignVisit::where('user_id', auth()->id())->delete();

            // Save new foreign visits
            if (isset($validated['countries'])) {
                foreach ($validated['countries'] as $country) {
                    if (!empty($country['name'])) {
                        ForeignVisit::create([
                            'user_id' => auth()->id(),
                            'country_name' => $country['name'],
                            'purpose' => $country['purpose'] ?? null,
                            'from_month' => $country['from_month'] ?? null,
                            'from_year' => $country['from_year'] ?? null,
                            'to_month' => $country['to_month'] ?? null,
                            'to_year' => $country['to_year'] ?? null,
                        ]);
                    }
                }
            }

            \Log::info('ForeignVisits after save:', ForeignVisit::where('user_id', auth()->id())->get()->toArray());

            // Mark foreign countries as completed
            $this->markSectionAsCompleted('foreign-countries');

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Foreign countries visited saved successfully']);
            }

            return redirect()->route('phs.credit-reputation.create')
                ->with('success', 'Foreign countries visited saved successfully. Please continue with your credit reputation.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your foreign countries visited. Please try again.');
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
