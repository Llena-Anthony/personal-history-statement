<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Models\OrganizationDetail;
use App\Models\MembershipDetail;
use App\Models\AddressDetails;
use Illuminate\Support\Facades\Auth;
use App\Helper\DataRetrieval;
use App\Helper\DataUpdate;

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
        $organizations = DataRetrieval::retrieveOrganizations(auth()->user()->username);
        $viewData = $this->getCommonViewData('organization');
        $viewData['organizations'] = $organizations;
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
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'organizations.*.name' => 'nullable|string|max:255',
                    'organizations.*.address' => 'nullable|string|max:500',
                    'organizations.*.month' => 'nullable|string|max:2',
                    'organizations.*.year' => 'nullable|integer|min:1900|max:2030',
                    'organizations.*.position' => 'nullable|string|max:255',
                ]);
            } else {
                $validated = $request->validate([
                    'organizations.*.name' => 'required|string|max:255',
                    'organizations.*.address' => 'required|string|max:500',
                    'organizations.*.month' => 'nullable|string|max:2',
                    'organizations.*.year' => 'nullable|integer|min:1900|max:2030',
                    'organizations.*.position' => 'required|string|max:255',
                ]);
            }
            \Log::info('Organization validated data:', $validated);
            if (isset($validated['organizations'])) {
                DataUpdate::updateOrganizations(auth()->user()->username, $validated['organizations']);
            }
            $this->markSectionAsCompleted('organization');
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
