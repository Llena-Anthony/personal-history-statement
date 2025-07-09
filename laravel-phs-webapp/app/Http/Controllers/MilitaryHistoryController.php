<?php

namespace App\Http\Controllers;

use App\Models\MilitaryHistoryDetail;
use App\Models\MilitaryAssignment;
use App\Models\MilitarySchool;
use App\Models\MilitaryAward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\PHSSectionTracking;

class MilitaryHistoryController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $data = $this->getCommonViewData('military-history');

        // Load existing military history data
        $militaryHistory = MilitaryHistoryDetail::where('username', auth()->id())->first();
        if ($militaryHistory) {
            $data['militaryHistory'] = $militaryHistory;
            $data['assignments'] = MilitaryAssignment::where('assign_id', $militaryHistory->military_assign)->get();
            $data['schools'] = MilitarySchool::where('user_id', $militaryHistory->user_id)->get();
            $data['awards'] = MilitaryAward::whereIn('history_id', $data['schools']->pluck('history_id'))->get();
        }

        // Return partial for AJAX requests, full view for normal requests
        if (request()->ajax()) {
            return view('phs.sections.military-history-content', $data);
        }

        return view('phs.military-history', $data);
    }

    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';

        // Validation (keep as is)
        if ($isSaveOnly) {
            $validated = $request->validate([
                'enlistment_month' => 'required|string|max:2',
                'enlistment_year' => 'required|integer|min:1900|max:2030',
                'commission_source' => 'nullable|string|max:255',
                'commission_date_from_month' => 'nullable|string|max:2',
                'commission_date_from_year' => 'nullable|integer|min:1900|max:2030',
                'commission_date_to_month' => 'nullable|string|max:2',
                'commission_date_to_year' => 'nullable|integer|min:1900|max:2030',
                'assignments' => 'nullable|array',
                'assignments.*.from_month' => 'nullable|string|max:2',
                'assignments.*.from_year' => 'nullable|integer|min:1900|max:2030',
                'assignments.*.to_month' => 'nullable|string|max:2',
                'assignments.*.to_year' => 'nullable|integer|min:1900|max:2030',
                'assignments.*.unit_office' => 'nullable|string|max:255',
                'assignments.*.co_chief' => 'nullable|string|max:255',
                'schools' => 'nullable|array',
                'schools.*.school' => 'nullable|string|max:255',
                'schools.*.location' => 'nullable|string|max:255',
                'schools.*.date_attended_from_month' => 'nullable|string|max:2',
                'schools.*.date_attended_from_year' => 'nullable|integer|min:1900|max:2030',
                'schools.*.date_attended_to_month' => 'nullable|string|max:2',
                'schools.*.date_attended_to_year' => 'nullable|integer|min:1900|max:2030',
                'schools.*.nature_training' => 'nullable|string|max:255',
                'schools.*.rating' => 'nullable|string|max:255',
                'awards' => 'nullable|array',
                'awards.*.name' => 'nullable|string|max:255',
            ]);
        } else {
            $validated = $request->validate([
                'enlistment_month' => 'required|string|max:2',
                'enlistment_year' => 'required|integer|min:1900|max:2030',
                'commission_source' => 'nullable|string|max:255',
                'commission_date_from_month' => 'nullable|string|max:2',
                'commission_date_from_year' => 'nullable|integer|min:1900|max:2030',
                'commission_date_to_month' => 'nullable|string|max:2',
                'commission_date_to_year' => 'nullable|integer|min:1900|max:2030',
                'assignments' => 'nullable|array',
                'assignments.*.from_month' => 'nullable|string|max:2',
                'assignments.*.from_year' => 'nullable|integer|min:1900|max:2030',
                'assignments.*.to_month' => 'nullable|string|max:2',
                'assignments.*.to_year' => 'nullable|integer|min:1900|max:2030',
                'assignments.*.unit_office' => 'nullable|string|max:255',
                'assignments.*.co_chief' => 'nullable|string|max:255',
                'schools' => 'nullable|array',
                'schools.*.school' => 'nullable|string|max:255',
                'schools.*.location' => 'nullable|string|max:255',
                'schools.*.date_attended_from_month' => 'nullable|string|max:2',
                'schools.*.date_attended_from_year' => 'nullable|integer|min:1900|max:2030',
                'schools.*.date_attended_to_month' => 'nullable|string|max:2',
                'schools.*.date_attended_to_year' => 'nullable|integer|min:1900|max:2030',
                'schools.*.nature_training' => 'nullable|string|max:255',
                'schools.*.rating' => 'nullable|string|max:255',
                'awards' => 'nullable|array',
                'awards.*.name' => 'nullable|string|max:255',
            ]);
        }

        $this->processDateFields($validated);

        try {
            DB::beginTransaction();

            $username = auth()->user()->username;
            $data = [
                'military' => [
                    'enlistment_month' => $validated['enlistment_month'],
                    'enlistment_year' => $validated['enlistment_year'],
                    'commission_source' => $validated['commission_source'] ?? null,
                    'commission_date_from_month' => $validated['commission_date_from_month'] ?? null,
                    'commission_date_from_year' => $validated['commission_date_from_year'] ?? null,
                    'commission_date_to_month' => $validated['commission_date_to_month'] ?? null,
                    'commission_date_to_year' => $validated['commission_date_to_year'] ?? null,
                ],
                'assignments' => $validated['assignments'] ?? [],
                'schools' => $validated['schools'] ?? [],
                'awards' => $validated['awards'] ?? [],
            ];
            \App\Helper\DataUpdate::saveMilitaryHistory($data, $username);

            $this->markSectionAsCompleted('military-history');
            DB::commit();

            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Military history saved successfully']);
            }

            return redirect()->route('phs.places-of-residence.create')
                ->with('success', 'Military history saved successfully. Please continue with your places of residence.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            return back()->with('error', 'An error occurred while saving your military history information. Please try again.');
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

    private function processDateFields(&$validated)
    {
        // No enlistment_date_type or enlistment_date to process anymore
        // No commission date processing needed since we're using simple month/year fields

        // Process assignment dates
        if (isset($validated['assignments'])) {
            foreach ($validated['assignments'] as &$assignment) {
                if (isset($assignment['from_type'])) {
                    if ($assignment['from_type'] === 'month_year') {
                        $assignment['from'] = null;
                    } else {
                        $assignment['from_month'] = null;
                        $assignment['from_year'] = null;
                    }
                }
                if (isset($assignment['to_type'])) {
                    if ($assignment['to_type'] === 'month_year') {
                        $assignment['to'] = null;
                    } else {
                        $assignment['to_month'] = null;
                        $assignment['to_year'] = null;
                    }
                }
            }
        }

        // Process school dates
        if (isset($validated['schools'])) {
            foreach ($validated['schools'] as &$school) {
                if (isset($school['date_attended_type'])) {
                    if ($school['date_attended_type'] === 'month_year') {
                        $school['date_attended'] = null;
                    } else {
                        $school['date_attended_month'] = null;
                        $school['date_attended_year'] = null;
                    }
                }
            }
        }
    }
}
