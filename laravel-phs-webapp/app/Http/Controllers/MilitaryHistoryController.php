<?php

namespace App\Http\Controllers;

use App\Models\MilitaryHistory;
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
        $militaryHistory = MilitaryHistory::where('username', auth()->user()->username)->first();
        if ($militaryHistory) {
            $data['militaryHistory'] = $militaryHistory;
            $data['assignments'] = MilitaryAssignment::where('assign_id', $militaryHistory->military_assign)->get();
            $data['schools'] = MilitarySchool::where('username', $militaryHistory->username)->get();
            $data['awards'] = MilitaryAward::whereIn('history_id', $data['schools']->pluck('history_id'))->get();
        }

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.military-history', $data)->render();
        }

        return view('phs.military-history', $data);
    }

    public function store(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'enlistment_date' => 'nullable|date',
                'enlistment_date_type' => 'nullable|in:exact,month_year',
                'enlistment_month' => 'nullable|string|max:2',
                'enlistment_year' => 'nullable|integer|min:1900|max:2030',
                'commission_source' => 'nullable|string|max:255',
                'commission_date_from' => 'nullable|date',
                'commission_date_from_type' => 'nullable|in:exact,month_year',
                'commission_date_from_month' => 'nullable|string|max:2',
                'commission_date_from_year' => 'nullable|integer|min:1900|max:2030',
                'commission_date_to' => 'nullable|date',
                'commission_date_to_type' => 'nullable|in:exact,month_year',
                'commission_date_to_month' => 'nullable|string|max:2',
                'commission_date_to_year' => 'nullable|integer|min:1900|max:2030',
                'assignments' => 'nullable|array',
                'assignments.*.from' => 'nullable|date',
                'assignments.*.from_type' => 'nullable|in:exact,month_year',
                'assignments.*.from_month' => 'nullable|string|max:2',
                'assignments.*.from_year' => 'nullable|integer|min:1900|max:2030',
                'assignments.*.to' => 'nullable|date',
                'assignments.*.to_type' => 'nullable|in:exact,month_year',
                'assignments.*.to_month' => 'nullable|string|max:2',
                'assignments.*.to_year' => 'nullable|integer|min:1900|max:2030',
                'assignments.*.unit_office' => 'nullable|string|max:255',
                'assignments.*.co_chief' => 'nullable|string|max:255',
                'schools' => 'nullable|array',
                'schools.*.school' => 'nullable|string|max:255',
                'schools.*.location' => 'nullable|string|max:255',
                'schools.*.date_attended' => 'nullable|date',
                'schools.*.date_attended_type' => 'nullable|in:exact,month_year',
                'schools.*.date_attended_month' => 'nullable|string|max:2',
                'schools.*.date_attended_year' => 'nullable|integer|min:1900|max:2030',
                'schools.*.nature_training' => 'nullable|string|max:255',
                'schools.*.rating' => 'nullable|string|max:255',
                'awards' => 'nullable|array',
                'awards.*.name' => 'nullable|string|max:255',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'enlistment_date' => 'nullable|date',
                'enlistment_date_type' => 'nullable|in:exact,month_year',
                'enlistment_month' => 'nullable|string|max:2',
                'enlistment_year' => 'nullable|integer|min:1900|max:2030',
                'commission_source' => 'nullable|string|max:255',
                'commission_date_from' => 'nullable|date',
                'commission_date_from_type' => 'nullable|in:exact,month_year',
                'commission_date_from_month' => 'nullable|string|max:2',
                'commission_date_from_year' => 'nullable|integer|min:1900|max:2030',
                'commission_date_to' => 'nullable|date',
                'commission_date_to_type' => 'nullable|in:exact,month_year',
                'commission_date_to_month' => 'nullable|string|max:2',
                'commission_date_to_year' => 'nullable|integer|min:1900|max:2030',
                'assignments' => 'nullable|array',
                'assignments.*.from' => 'nullable|date',
                'assignments.*.from_type' => 'nullable|in:exact,month_year',
                'assignments.*.from_month' => 'nullable|string|max:2',
                'assignments.*.from_year' => 'nullable|integer|min:1900|max:2030',
                'assignments.*.to' => 'nullable|date',
                'assignments.*.to_type' => 'nullable|in:exact,month_year',
                'assignments.*.to_month' => 'nullable|string|max:2',
                'assignments.*.to_year' => 'nullable|integer|min:1900|max:2030',
                'assignments.*.unit_office' => 'nullable|string|max:255',
                'assignments.*.co_chief' => 'nullable|string|max:255',
                'schools' => 'nullable|array',
                'schools.*.school' => 'nullable|string|max:255',
                'schools.*.location' => 'nullable|string|max:255',
                'schools.*.date_attended' => 'nullable|date',
                'schools.*.date_attended_type' => 'nullable|in:exact,month_year',
                'schools.*.date_attended_month' => 'nullable|string|max:2',
                'schools.*.date_attended_year' => 'nullable|integer|min:1900|max:2030',
                'schools.*.nature_training' => 'nullable|string|max:255',
                'schools.*.rating' => 'nullable|string|max:255',
                'awards' => 'nullable|array',
                'awards.*.name' => 'nullable|string|max:255',
            ]);
        }

        // Process date fields based on date type
        $this->processDateFields($validated);

        try {
            DB::beginTransaction();

            $username = auth()->user()->username;

            // Create or update military history
            $militaryHistory = MilitaryHistory::updateOrCreate(
                ['username' => $username],
                [
                    'username' => $username,
                    'date_enlisted_afp' => $validated['enlistment_date'] ?? null,
                    'enlistment_date_type' => $validated['enlistment_date_type'] ?? null,
                    'enlistment_month' => $validated['enlistment_month'] ?? null,
                    'enlistment_year' => $validated['enlistment_year'] ?? null,
                    'start_date_of_commision' => $validated['commission_date_from'] ?? null,
                    'commission_date_from_type' => $validated['commission_date_from_type'] ?? null,
                    'commission_date_from_month' => $validated['commission_date_from_month'] ?? null,
                    'commission_date_from_year' => $validated['commission_date_from_year'] ?? null,
                    'end_date_of_commision' => $validated['commission_date_to'] ?? null,
                    'commission_date_to_type' => $validated['commission_date_to_type'] ?? null,
                    'commission_date_to_month' => $validated['commission_date_to_month'] ?? null,
                    'commission_date_to_year' => $validated['commission_date_to_year'] ?? null,
                    'source_of_commision' => $validated['commission_source'] ?? null,
                ]
            );

            // Handle assignments
            if (isset($validated['assignments'])) {
                // Clear existing assignments
                MilitaryAssignment::where('assign_id', $militaryHistory->military_assign)->delete();
                
                foreach ($validated['assignments'] as $assignmentData) {
                    if (!empty($assignmentData['unit_office'])) {
                        $assignment = MilitaryAssignment::create([
                            'assign_id' => $militaryHistory->military_assign,
                            'date_from' => $assignmentData['from'] ?? null,
                            'date_to' => $assignmentData['to'] ?? null,
                            'date_from_type' => $assignmentData['from_type'] ?? null,
                            'date_from_month' => $assignmentData['from_month'] ?? null,
                            'date_from_year' => $assignmentData['from_year'] ?? null,
                            'date_to_type' => $assignmentData['to_type'] ?? null,
                            'date_to_month' => $assignmentData['to_month'] ?? null,
                            'date_to_year' => $assignmentData['to_year'] ?? null,
                            'unit_office' => $assignmentData['unit_office'],
                            'co_or_chief_of_office' => $assignmentData['co_chief'] ?? null,
                        ]);
                    }
                }
            }

            // Handle schools
            if (isset($validated['schools'])) {
                // Clear existing schools
                MilitarySchool::where('username', $username)->delete();
                
                foreach ($validated['schools'] as $schoolData) {
                    if (!empty($schoolData['school'])) {
                        $school = MilitarySchool::create([
                            'username' => $username,
                            'date_attended' => $schoolData['date_attended'] ?? null,
                            'exact_date_attended' => $schoolData['date_attended'] ?? null,
                            'date_attended_type' => $schoolData['date_attended_type'] ?? null,
                            'date_attended_month' => $schoolData['date_attended_month'] ?? null,
                            'date_attended_year' => $schoolData['date_attended_year'] ?? null,
                            'nature_of_training' => $schoolData['nature_training'] ?? null,
                            'rating' => $schoolData['rating'] ?? null,
                        ]);
                    }
                }
            }

            // Handle awards
            if (isset($validated['awards'])) {
                // Clear existing awards
                MilitaryAward::whereIn('history_id', MilitarySchool::where('username', $username)->pluck('history_id'))->delete();
                
                foreach ($validated['awards'] as $awardData) {
                    if (!empty($awardData['name'])) {
                        // For simplicity, associate awards with the first school or create a dummy school
                        $school = MilitarySchool::where('username', $username)->first();
                        if (!$school) {
                            $school = MilitarySchool::create([
                                'username' => $username,
                                'date_attended' => null,
                            ]);
                        }
                        
                        MilitaryAward::create([
                            'history_id' => $school->history_id,
                            'decoration_award_or_commendation' => $awardData['name'],
                        ]);
                    }
                }
            }

            // Mark military history as completed
            $this->markSectionAsCompleted('military-history');

            DB::commit();

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Military history saved successfully']);
            }

            return redirect()->route('phs.places-of-residence.create')
                ->with('success', 'Military history saved successfully. Please continue with your places of residence.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($isSaveOnly) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
            }
            
            return back()->with('error', 'An error occurred while saving your military history information. Please try again.');
        }
    }

    private function processDateFields(&$validated)
    {
        // Process enlistment date
        if (isset($validated['enlistment_date_type'])) {
            if ($validated['enlistment_date_type'] === 'month_year') {
                $validated['enlistment_date'] = null;
            } else {
                $validated['enlistment_month'] = null;
                $validated['enlistment_year'] = null;
            }
        }

        // Process commission date from
        if (isset($validated['commission_date_from_type'])) {
            if ($validated['commission_date_from_type'] === 'month_year') {
                $validated['commission_date_from'] = null;
            } else {
                $validated['commission_date_from_month'] = null;
                $validated['commission_date_from_year'] = null;
            }
        }

        // Process commission date to
        if (isset($validated['commission_date_to_type'])) {
            if ($validated['commission_date_to_type'] === 'month_year') {
                $validated['commission_date_to'] = null;
            } else {
                $validated['commission_date_to_month'] = null;
                $validated['commission_date_to_year'] = null;
            }
        }

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