<?php

namespace App\Http\Controllers;

use App\Models\MaritalDetail;
use App\Models\FamilyBackground;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\PHSSectionTracking;
use App\Services\NameService;

class MaritalStatusController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        $data = $this->getCommonViewData('marital-status');

        // Load existing marital status data
        $maritalStatus = MaritalDetail::where('username', auth()->user()->username)->first();
        if ($maritalStatus) {
            $data['maritalStatus'] = $maritalStatus;

            // Load existing children data
            $children = Child::where('marital_status_id', $maritalStatus->id)
                           ->with('nameDetails')
                           ->get();
            $data['children'] = $children;
        }

        // For both AJAX and normal requests, return the full section view
        return view('phs.marital-status', $data);
    }

    public function store(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';

        \Log::info('MaritalStatusController store() called');

        try {
            DB::beginTransaction();

            // Get all request data without strict validation (like Section II)
            $data = $request->all();

            // Extract children data before processing marital status data
            $childrenData = $data['children'] ?? [];

            // Remove CSRF token and other non-database fields
            unset($data['_token'], $data['children']);

            // Filter out null and empty values to avoid NOT NULL constraint violations
            $data = array_filter($data, function($value) {
                return $value !== null && $value !== '';
            });

            // Add username to data
            $data['username'] = auth()->user()->username;

            // Capitalize spouse name fields
            foreach (['spouse_first_name', 'spouse_middle_name', 'spouse_last_name'] as $field) {
                if (isset($data[$field]) && $data[$field]) {
                    $data[$field] = ucwords(strtolower($data[$field]));
                }
            }

            // Process marriage date based on date type
            if (isset($data['marriage_date_type'])) {
                if ($data['marriage_date_type'] === 'month_year') {
                    // Clear exact date when using month/year
                    $data['marriage_date'] = null;
                } else {
                    // Clear month/year when using exact date
                    $data['marriage_month'] = null;
                    $data['marriage_year'] = null;
                }
            }

            // Add default values for required fields if they're missing (like Section II)
            $defaults = [
                'marital_status' => 'Single',
            ];

            // Only add defaults for fields that are missing
            foreach ($defaults as $field => $defaultValue) {
                if (!isset($data[$field]) || empty($data[$field])) {
                    $data[$field] = $defaultValue;
                }
            }

            \Log::info('MaritalStatus data with defaults:', $data);

            // Save or update marital status using updateOrCreate (like Section II)
            $maritalStatus = MaritalDetail::updateOrCreate(
                ['username' => auth()->user()->username],
                $data
            );

            \Log::info('MaritalStatus after save:', $maritalStatus->toArray());

            // Handle children data
            if (!empty($childrenData)) {
                // Delete existing children for this marital status
                Child::where('marital_status_id', $maritalStatus->id)->delete();

                foreach ($childrenData as $childData) {
                    // Skip if child name is empty
                    if (empty($childData['name'])) {
                        continue;
                    }

                    // Create name_details record for the child
                    $childNameId = DB::table('name_details')->insertGetId([
                        'first_name' => $childData['name'] ?? '',
                        'last_name' => '',
                        'middle_name' => null,
                        'nickname' => null,
                        'name_extension' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Create child record
                    Child::create([
                        'marital_status_id' => $maritalStatus->id,
                        'name_id' => $childNameId,
                        'birth_date' => $childData['birth_date'] ?? null,
                        'citizenship' => $childData['citizenship'] ?? null,
                        'address' => $childData['address'] ?? null,
                        'father_name' => $childData['father_name'] ?? null,
                        'mother_name' => $childData['mother_name'] ?? null,
                    ]);
                }

                \Log::info('Children saved:', ['count' => count($childrenData)]);
            }

            DB::commit();

            // Mark marital status as completed
            $this->markSectionAsCompleted('marital-status');

            // Return appropriate response based on mode
            if ($request->ajax()) {
                $nextRoute = auth()->user()->role === 'personnel'
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
            DB::rollBack();
            \Log::error('MaritalStatusController error: ' . $e->getMessage(), ['exception' => $e]);

            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving: ' . $e->getMessage()], 500);
            }

            return back()->with('error', 'An error occurred while saving your marital status information. Please try again.');
        }
    }
}
