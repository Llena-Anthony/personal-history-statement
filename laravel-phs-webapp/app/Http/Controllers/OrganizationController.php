<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Models\OrganizationDetail;
use App\Models\MembershipDetail;
use App\Models\AddressDetails;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    use PHSSectionTracking;

    /**
     * Show the form for creating/editing organization information.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Load existing organization data for autofill
        $organizations = MembershipDetail::where('username', auth()->user()->username)->get();

        $viewData = $this->getCommonViewData('organization');
        $viewData['organizations'] = $organizations;

        // Return partial for AJAX requests, full view for normal requests
        if (request()->ajax()) {
            return view('phs.sections.organization-content', $viewData);
        }

        return view('phs.organization', $viewData);
    }

    /**
     * Store organization information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';

        try {
            // Check if this is a save-only request (for dynamic navigation)
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'organizations.*.name' => 'nullable|string|max:255',
                    'organizations.*.address' => 'nullable|string|max:500',
                    'organizations.*.month' => 'nullable|string|max:2',
                    'organizations.*.year' => 'nullable|integer|min:1900|max:2030',
                    'organizations.*.position' => 'nullable|string|max:255',
                ]);
            } else {
                // Full validation for final submission
                $validated = $request->validate([
                    'organizations.*.name' => 'required|string|max:255',
                    'organizations.*.address' => 'required|string|max:500',
                    'organizations.*.month' => 'nullable|string|max:2',
                    'organizations.*.year' => 'nullable|integer|min:1900|max:2030',
                    'organizations.*.position' => 'required|string|max:255',
                ]);
            }

            \Log::info('Organization validated data:', $validated);

            // Additional validation for date fields based on month/year
            if (isset($validated['organizations'])) {
                foreach ($validated['organizations'] as $index => $organization) {
                    if (!empty($organization['month']) && empty($organization['year'])) {
                        if (!$isSaveOnly) {
                            return back()->withErrors(["organizations.{$index}.year" => 'Year is required when month is provided.']);
                        }
                    } elseif (empty($organization['month']) && !empty($organization['year'])) {
                        if (!$isSaveOnly) {
                            return back()->withErrors(["organizations.{$index}.month" => 'Month is required when year is provided.']);
                        }
                    }
                }
            }

            // Use centralized helper to save organization memberships
            $username = auth()->user()->username;
            $organizations = $validated['organizations'] ?? [];
            \App\Helper\DataUpdate::saveOrganizationMemberships($organizations, $username);

            \Log::info('Organization after save:', [
                'organizations' => \App\Models\OrganizationDetail::all()->toArray(),
                'membership_details' => \App\Models\MembershipDetail::where('username', $username)->get()->toArray(),
            ]);

            // Mark organization section as completed
            $this->markSectionAsCompleted('organization');

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Organization information saved successfully']);
            }

            return redirect()->route('phs.miscellaneous.create')->with('success', 'Organization information saved successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your organization information. Please try again.');
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
