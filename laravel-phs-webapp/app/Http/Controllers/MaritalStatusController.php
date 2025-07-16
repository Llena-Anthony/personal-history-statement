<?php

namespace App\Http\Controllers;

use App\Models\MaritalDetail;
use App\Models\FamilyHistoryDetail;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\PHSSectionTracking;
use App\Services\NameService;
use App\Helper\DataRetrieval;

class MaritalStatusController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $prefill = DataRetrieval::retrieveMaritalStatus(auth()->user()->username);
        $data = $this->getCommonViewData('marital-status');
        $data = array_merge($data, $prefill);
        // Fix: set $marital_stat for blade prefill
        $data['marital_stat'] = $prefill['marital_status'] ?? '';
        return view('phs.marital-status', $data);
    }

    public function store(Request $request)
    {
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        \Log::info('MaritalStatusController store() called');
        try {
            // Ensure marital_stat is set to 'Single' if missing or empty
            $data = $request->all();
            if (!isset($data['marital_stat']) || empty($data['marital_stat'])) {
                $data['marital_stat'] = 'Single';
            }
            // Add validation for spouse fields
            $rules = [
                'marital_stat' => 'required|string',
                'spouse_first_name' => 'nullable|string|max:255',
                'spouse_middle_name' => 'nullable|string|max:255',
                'spouse_last_name' => 'nullable|string|max:255',
                'spouse_suffix' => 'nullable|string|max:10',
                'marriage_month' => 'nullable|string|max:2',
                'marriage_year' => 'nullable|string|max:4',
                'marriage_place' => 'nullable|string|max:255',
                'spouse_birth_date' => 'nullable|date',
                'spouse_birth_place' => 'nullable|string|max:255',
                'spouse_occupation' => 'nullable|string|max:255',
                'spouse_employer' => 'nullable|string|max:255',
                'spouse_employment_place' => 'nullable|string|max:255',
                'spouse_contact' => 'nullable|string|max:20',
                'spouse_citizenship' => 'nullable|string|max:100',
                'spouse_other_citizenship' => 'nullable|string|max:100',
            ];
            $validated = \Validator::make($data, $rules)->validate();
            $childrenData = $data['children'] ?? [];
            unset($data['_token']);
            // Capitalize spouse name fields
            foreach (['spouse_first_name', 'spouse_middle_name', 'spouse_last_name'] as $field) {
                if (isset($data[$field]) && $data[$field]) {
                    $data[$field] = ucwords(strtolower($data[$field]));
                }
            }
            // Process marriage date based on date type
            if (isset($data['marriage_date_type'])) {
                if ($data['marriage_date_type'] === 'month_year') {
                    $data['marriage_date'] = null;
                } else {
                    $data['marriage_month'] = null;
                    $data['marriage_year'] = null;
                }
            }
            // Remove empty/null values
            $data = array_filter($data, function($value) {
                return $value !== null && $value !== '';
            });
            $data['children'] = $childrenData;
            $username = auth()->user()->username;
            \App\Helper\DataUpdate::saveMaritalStatus($data, $username);
            $this->markSectionAsCompleted('marital-status');
            if ($request->ajax()) {
                $nextRoute = auth()->user()->usertype === 'personnel'
                    ? route('personnel.phs.family-background.create')
                    : route('phs.family-background.create');
                return response()->json([
                    'success' => true,
                    'message' => 'Marital status saved successfully',
                    'next_route' => $nextRoute
                ]);
            }
            return redirect()->route('phs.family-background.create')
                ->with('success', 'Marital status saved successfully. Please continue with your family background.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors to the view
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('MaritalStatusController error: ' . $e->getMessage(), ['exception' => $e]);
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'An error occurred while saving your marital status information. Please try again.');
        }
    }
}
