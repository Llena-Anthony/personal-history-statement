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
            // Get all request data
            $data = $request->all();
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
            // Add default values for required fields if they're missing
            $defaults = [
                'marital_status' => 'Single',
            ];
            foreach ($defaults as $field => $defaultValue) {
                if (!isset($data[$field]) || empty($data[$field])) {
                    $data[$field] = $defaultValue;
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
        } catch (\Exception $e) {
            \Log::error('MaritalStatusController error: ' . $e->getMessage(), ['exception' => $e]);
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'An error occurred while saving your marital status information. Please try again.');
        }
    }
}
