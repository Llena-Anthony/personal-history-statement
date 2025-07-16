<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PHSSectionTracking;
use App\Helper\DataRetrieval;

class OrganizationController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $prefill = DataRetrieval::retrieveOrganizationMemberships(auth()->user()->username);
        $data = $this->getCommonViewData('organization');
        $data = array_merge($data, $prefill);

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.sections.organization-content', $data)->render();
        }
        return view('phs.organization', $data);
    }

    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        try {
            // Validation (minimal for save-only, full for final submission)
            if ($isSaveOnly) {
                $validated = $request->validate([
                    'organizations' => 'nullable|array',
                    'organizations.*.name' => 'nullable|string|max:255',
                    'organizations.*.address' => 'nullable|string|max:500',
                    'organizations.*.month' => 'nullable|string|max:2',
                    'organizations.*.year' => 'nullable|integer|min:1900|max:2030',
                    'organizations.*.position' => 'nullable|string|max:255',
                ]);
            } else {
                $validated = $request->validate([
                    'organizations' => 'nullable|array',
                    'organizations.*.name' => 'nullable|string|max:255',
                    'organizations.*.address' => 'nullable|string|max:500',
                    'organizations.*.month' => 'nullable|string|max:2',
                    'organizations.*.year' => 'nullable|integer|min:1900|max:2030',
                    'organizations.*.position' => 'nullable|string|max:255',
                ]);
            }

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

            $username = auth()->user()->username;
            $organizations = $validated['organizations'] ?? [];

            \App\Helper\DataUpdate::saveOrganizationMemberships($organizations, $username);
            $this->markSectionAsCompleted('organization');
            session()->save();

            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Organization memberships saved successfully']);
            }

            if ($request->ajax()) {
                $nextRoute = route('phs.miscellaneous.create');
                return response()->json([
                    'success' => true,
                    'next_route' => $nextRoute
                ]);
            }

            return redirect()->route('phs.miscellaneous.create')
                ->with('success', 'Organization memberships saved successfully. Please continue with your miscellaneous information.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Exception in OrganizationController@store', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your organization memberships. Please try again.');
        }
    }

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
            'credit-reputation',
            'arrest-record',
            'character-and-reputation',
            'organization',
            'miscellaneous'
        ];
    }
}
