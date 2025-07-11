<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Helper\DataRetrieval;

class PersonalDetailsController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        \Log::info('PersonalDetails create method called');
        $prefill = DataRetrieval::retrievePersonalDetails(auth()->user()->username);
        $data = $this->getCommonViewData('personal-details');
        $data = array_merge($data, $prefill);

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.personal-details', $data)->render();
        }
        return view('phs.personal-details', $data);
    }

    public function store(Request $request)
    {
        \Log::info('PersonalDetails store method called', [
            'user_id' => auth()->id(),
            'request_data' => $request->all(),
            'is_ajax' => $request->ajax(),
            'save_only' => $request->header('X-Save-Only')
        ]);

        $isSaveOnly = $request->header('X-Save-Only') === 'true';

        try {
            // For save-only mode, use minimal validation
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'first_name' => 'nullable|string|max:255',
                    'middle_name' => 'nullable|string|max:255',
                    'last_name' => 'nullable|string|max:255',
                    'suffix' => 'nullable|string|max:255',
                    'nickname' => 'nullable|string|max:255',
                    'date_of_birth' => 'nullable|date',
                    'birth_region' => 'nullable|string|max:255',
                    'birth_province' => 'nullable|string|max:255',
                    'birth_city' => 'nullable|string|max:255',
                    'birth_barangay' => 'nullable|string|max:255',
                    'birth_street' => 'nullable|string|max:255',
                    'nationality' => 'nullable|string|max:255',
                    'rank' => 'nullable|string|max:255',
                    'afpsn' => 'nullable|string|max:255',
                    'branch_of_service' => 'nullable|string|max:255',
                    'present_job' => 'nullable|string|max:255',
                    'home_region' => 'nullable|string|max:255',
                    'home_province' => 'nullable|string|max:255',
                    'home_city' => 'nullable|string|max:255',
                    'home_barangay' => 'nullable|string|max:255',
                    'home_street' => 'nullable|string|max:255',
                    'business_region' => 'nullable|string|max:255',
                    'business_province' => 'nullable|string|max:255',
                    'business_city' => 'nullable|string|max:255',
                    'business_barangay' => 'nullable|string|max:255',
                    'business_street' => 'nullable|string|max:255',
                    'email' => 'nullable|string|max:255',
                    'mobile' => 'nullable|string|max:255',
                    'religion' => 'nullable|string|max:255',
                    'tin' => 'nullable|string|max:255',
                    'passport_number' => 'nullable|string|max:255',
                    'passport_expiry' => 'nullable|string|max:255',
                    'name_change' => 'nullable|string|max:255',
                ]);
            } else {
                // Full validation for final submission
                $validated = $request->validate([
                    'first_name' => 'required|string|max:255',
                    'middle_name' => 'nullable|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'suffix' => 'nullable|string|max:255',
                    'nickname' => 'nullable|string|max:255',
                    'date_of_birth' => 'required|date',
                    'birth_region' => 'nullable|string|max:255',
                    'birth_province' => 'nullable|string|max:255',
                    'birth_city' => 'nullable|string|max:255',
                    'birth_barangay' => 'nullable|string|max:255',
                    'birth_street' => 'nullable|string|max:255',
                    'nationality' => 'required|string|max:255',
                    'rank' => 'nullable|string|max:255',
                    'afpsn' => 'nullable|string|max:255',
                    'branch_of_service' => 'nullable|string|max:255',
                    'present_job' => 'nullable|string|max:255',
                    'home_region' => 'nullable|string|max:255',
                    'home_province' => 'required|string|max:255',
                    'home_city' => 'required|string|max:255',
                    'home_barangay' => 'nullable|string|max:255',
                    'home_street' => 'nullable|string|max:255',
                    'business_region' => 'nullable|string|max:255',
                    'business_province' => 'nullable|string|max:255',
                    'business_city' => 'nullable|string|max:255',
                    'business_barangay' => 'nullable|string|max:255',
                    'business_street' => 'nullable|string|max:255',
                    'email' => 'nullable|string|max:255',
                    'mobile' => 'nullable|string|max:255',
                    'religion' => 'nullable|string|max:255',
                    'tin' => 'nullable|string|max:255',
                    'passport_number' => 'nullable|string|max:255',
                    'passport_expiry' => 'nullable|string|max:255',
                    'name_change' => 'nullable|string|max:255',
                ]);
            }

            \Log::info('Validation passed', ['validated_data' => $validated]);

            // Capitalize names
            foreach (['first_name', 'middle_name', 'last_name'] as $field) {
                if (isset($validated[$field]) && $validated[$field]) {
                    $validated[$field] = ucwords(strtolower($validated[$field]));
                }
            }

            $username = auth()->user()->username;
            $data = [
                'name' => [
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'middle_name' => $validated['middle_name'] ?? null,
                    'suffix' => $validated['suffix'] ?? null,
                    'nickname' => $validated['nickname'] ?? null,
                    'change_in_name' => $validated['name_change'] ?? null,
                ],
                'birth_address' => [
                    'region' => $validated['birth_region'] ?? null,
                    'province' => $validated['birth_province'] ?? null,
                    'city' => $validated['birth_city'] ?? null,
                    'barangay' => $validated['birth_barangay'] ?? null,
                    'street' => $validated['birth_street'] ?? null,
                ],
                'home_address' => [
                    'region' => $validated['home_region'] ?? null,
                    'province' => $validated['home_province'] ?? null,
                    'city' => $validated['home_city'] ?? null,
                    'barangay' => $validated['home_barangay'] ?? null,
                    'street' => $validated['home_street'] ?? null,
                ],
                'business_address' => [
                    'region' => $validated['business_region'] ?? null,
                    'province' => $validated['business_province'] ?? null,
                    'city' => $validated['business_city'] ?? null,
                    'barangay' => $validated['business_barangay'] ?? null,
                    'street' => $validated['business_street'] ?? null,
                ],
                'birth_date' => $validated['date_of_birth'],
                'nationality' => null, // will be mapped below
                'religion' => $validated['religion'] ?? null,
                'mobile' => $validated['mobile'] ?? null,
                'email' => $validated['email'] ?? null,
                'personal' => [
                    'nickname' => $validated['nickname'] ?? null,
                    'change_in_name' => $validated['name_change'] ?? null,
                ],
                'job' => [
                    'branch_of_service' => $validated['branch_of_service'] ?? null,
                    'rank' => $validated['rank'] ?? null,
                    'afpsn' => $validated['afpsn'] ?? null,
                    'job_desc' => $validated['present_job'] ?? null,
                ],
                'gov_id' => [
                    'tin_num' => $validated['tin'] ?? null,
                    'pass_num' => $validated['passport_number'] ?? null,
                    'pass_exp' => $validated['passport_expiry'] ?? null,
                ],
            ];

            // Map nationality string to citizenship ID
            if (!empty($validated['nationality'])) {
                $citizenship = \App\Models\CitizenshipDetail::where('cit_description', $validated['nationality'])->first();
                if ($citizenship) {
                    $data['nationality'] = $citizenship->cit_id;
                }
            }

            \App\Helper\DataUpdate::savePersonalDetails($data, $username);
            $this->markSectionAsCompleted('personal-details');
            session()->save();

            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Personal details saved successfully']);
            }

            if ($request->ajax()) {
                $nextRoute = auth()->user()->usertype === 'personnel'
                    ? route('personnel.phs.personal-characteristics.create')
                    : route('phs.personal-characteristics.create');
                return response()->json([
                    'success' => true,
                    'next_route' => $nextRoute
                ]);
            }

            return redirect()->route('phs.personal-characteristics.create')
                ->with('success', 'Personal details saved successfully. Please continue with your personal characteristics.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Exception in PersonalDetailsController@store', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your personal details. Please try again.');
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
