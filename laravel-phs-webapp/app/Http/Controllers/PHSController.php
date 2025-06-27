<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PHS;
use App\Models\NameDetails;
use App\Models\UserDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\PHSSectionTracking;

class PHSController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        // Load existing PHS data for autofill
        $phs = PHS::where('user_id', auth()->id())->first();
        
        // Get user details for name prefill from admin-created account
        $userDetails = UserDetails::where('username', auth()->user()->username)
            ->with('nameDetails')
            ->first();
        
        // Debug: Log the user details for name prefill
        \Log::info('User details for name prefill:', [
            'username' => auth()->user()->username,
            'user_id' => auth()->id(),
            'userDetails_exists' => $userDetails ? 'yes' : 'no',
            'nameDetails_exists' => $userDetails && $userDetails->nameDetails ? 'yes' : 'no',
            'nameDetails_data' => $userDetails && $userDetails->nameDetails ? $userDetails->nameDetails->toArray() : 'null',
            'userDetails_raw' => $userDetails ? $userDetails->toArray() : 'null'
        ]);
        
        $viewData = $this->getCommonViewData('personal-details');
        $viewData['phs'] = $phs;
        $viewData['userDetails'] = $userDetails;
        
        return view('phs.personal-details', $viewData);
    }

    public function store(Request $request)
    {
        // Debug: Log the request data
        \Log::info('PHS Store Request:', $request->all());
        
        // Log address, TIN, and change in name fields from the request
        \Log::info('Address/TIN/NameChange fields:', [
            'home_region' => $request->input('home_region'),
            'home_region_name' => $request->input('home_region_name'),
            'home_province' => $request->input('home_province'),
            'home_province_name' => $request->input('home_province_name'),
            'home_city' => $request->input('home_city'),
            'home_city_name' => $request->input('home_city_name'),
            'home_barangay' => $request->input('home_barangay'),
            'home_barangay_name' => $request->input('home_barangay_name'),
            'business_region' => $request->input('business_region'),
            'business_region_name' => $request->input('business_region_name'),
            'business_province' => $request->input('business_province'),
            'business_province_name' => $request->input('business_province_name'),
            'business_city' => $request->input('business_city'),
            'business_city_name' => $request->input('business_city_name'),
            'business_barangay' => $request->input('business_barangay'),
            'business_barangay_name' => $request->input('business_barangay_name'),
            'tin' => $request->input('tin'),
            'tin_no' => $request->input('tin_no'),
            'name_change' => $request->input('name_change'),
            'change_in_name' => $request->input('change_in_name'),
        ]);
        
        // Combine granular address fields into single address strings for DB (use names if available)
        $home_address = trim(implode(', ', array_filter([
            $request->input('home_street'),
            $request->input('home_barangay_name', $request->input('home_barangay')),
            $request->input('home_city_name', $request->input('home_city')),
            $request->input('home_province_name', $request->input('home_province')),
            $request->input('home_region_name', $request->input('home_region')),
        ])));
        $business_address = trim(implode(', ', array_filter([
            $request->input('business_street'),
            $request->input('business_barangay_name', $request->input('business_barangay')),
            $request->input('business_city_name', $request->input('business_city')),
            $request->input('business_province_name', $request->input('business_province')),
            $request->input('business_region_name', $request->input('business_region')),
        ])));

        // Validate all Section 1 fields
        $validated = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'suffix' => 'nullable|string|max:20',
            'nickname' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'place_of_birth' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:20',
            'civil_status' => 'nullable|string|max:20',
            'citizenship' => 'nullable|string|max:100',
            'nationality' => 'nullable|string|max:100',
            'rank' => 'nullable|string|max:100',
            'afpsn' => 'nullable|string|max:100',
            'branch_of_service' => 'nullable|string|max:100',
            'present_job' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'mobile' => 'nullable|string|max:50',
            'tin_no' => 'nullable|string|max:50',
            'passport_number' => 'nullable|string|max:50',
            'passport_expiry' => 'nullable|date',
            // Home address fields
            'home_region' => 'nullable|string|max:100',
            'home_province' => 'nullable|string|max:100',
            'home_city' => 'nullable|string|max:100',
            'home_barangay' => 'nullable|string|max:100',
            'home_street' => 'nullable|string|max:255',
            'home_complete_address' => 'nullable|string|max:255',
            // Business address fields
            'business_region' => 'nullable|string|max:100',
            'business_province' => 'nullable|string|max:100',
            'business_city' => 'nullable|string|max:100',
            'business_barangay' => 'nullable|string|max:100',
            'business_street' => 'nullable|string|max:255',
            'business_complete_address' => 'nullable|string|max:255',
        ]);

        // Map form 'tin' input to both 'tin_no' and 'tin' for DB
        if ($request->has('tin')) {
            $validated['tin_no'] = $request->input('tin');
        }

        // Add name change fields from form 'name_change'
        $name_change = $request->input('name_change', $request->input('change_in_name'));
        $validated['name_change'] = $name_change;
        $validated['change_in_name'] = $name_change;
        // Add combined address fields
        $validated['home_address'] = $home_address;
        $validated['business_address'] = $business_address;

        // Debug: Log the validated data before saving
        \Log::info('PHS Validated Data Before Save:', $validated);

        // Capitalize first letter of each word for names
        if (isset($validated['first_name']) && $validated['first_name']) {
            $validated['first_name'] = ucwords(strtolower($validated['first_name']));
        }
        if (isset($validated['middle_name']) && $validated['middle_name']) {
            $validated['middle_name'] = ucwords(strtolower($validated['middle_name']));
        }
        if (isset($validated['last_name']) && $validated['last_name']) {
            $validated['last_name'] = ucwords(strtolower($validated['last_name']));
        }

        // Assign address name fields to $validated
        $validated['home_region_name'] = $request->input('home_region_name');
        $validated['home_province_name'] = $request->input('home_province_name');
        $validated['home_city_name'] = $request->input('home_city_name');
        $validated['home_barangay_name'] = $request->input('home_barangay_name');
        $validated['business_region_name'] = $request->input('business_region_name');
        $validated['business_province_name'] = $request->input('business_province_name');
        $validated['business_city_name'] = $request->input('business_city_name');
        $validated['business_barangay_name'] = $request->input('business_barangay_name');

        // After validation and before saving ...
        $validated['home_region'] = $request->input('home_region_name');
        $validated['business_region'] = $request->input('business_region_name');

        try {
            DB::beginTransaction();

            // Check if PHS already exists for this user
            $phs = PHS::where('user_id', auth()->id())->first();
            
            if ($phs) {
                // Update existing PHS
                \Log::info('Updating existing PHS:', ['phs_id' => $phs->id, 'user_id' => auth()->id()]);
                $phs->update($validated);
                \Log::info('PHS after update:', $phs->fresh()->toArray());
            } else {
                // Create new PHS
                \Log::info('Creating new PHS for user:', ['user_id' => auth()->id()]);
                $phs = PHS::create([
                    'user_id' => auth()->id(),
                    ...$validated
                ]);
                \Log::info('PHS after create:', $phs->toArray());
            }

            // Mark personal details as completed
            $this->markSectionAsCompleted('personal-details');

            DB::commit();
            
            \Log::info('PHS saved successfully:', ['phs_id' => $phs->id]);

            // Return appropriate response based on mode
            if ($request->header('X-Save-Only') === 'true') {
                return response()->json(['success' => true, 'message' => 'Data saved successfully']);
            }

            return redirect()->route('phs.family-background.create')
                ->with('success', 'Personal information saved successfully. Please continue with your family background.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('PHS save error:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            
            if ($request->header('X-Save-Only') === 'true') {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving: ' . $e->getMessage()], 500);
            }
            
            return back()->with('error', 'An error occurred while saving your personal information. Please try again.');
        }
    }

    public function edit(PHS $phs)
    {
        return view('phs.edit', compact('phs'));
    }

    public function update(Request $request, PHS $phs)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'civil_status' => 'required|string|in:Single,Married,Widowed,Separated',
            'height' => 'nullable|string|max:10',
            'weight' => 'nullable|string|max:10',
            'blood_type' => 'nullable|string|max:5',
            'gsis_id' => 'nullable|string|max:50',
            'philhealth_no' => 'nullable|string|max:50',
            'tin_no' => 'nullable|string|max:50',
            'pagibig_id' => 'nullable|string|max:50',
            'sss_no' => 'nullable|string|max:50',
            'agency_employee_no' => 'nullable|string|max:50',
            'citizenship' => 'required|string|in:Filipino,Dual Citizenship',
            'dual_citizenship_by_birth' => 'nullable|boolean',
            'dual_citizenship_by_naturalization' => 'nullable|boolean',
            'dual_citizenship_country' => 'nullable|string|max:100',
            'residential_house_no' => 'nullable|string|max:50',
            'residential_street' => 'nullable|string|max:255',
            'residential_subdivision' => 'nullable|string|max:255',
            'residential_barangay' => 'nullable|string|max:255',
            'residential_city' => 'nullable|string|max:255',
            'residential_province' => 'nullable|string|max:255',
            'residential_zip' => 'nullable|string|max:10',
            'permanent_house_no' => 'nullable|string|max:50',
            'permanent_street' => 'nullable|string|max:255',
            'permanent_subdivision' => 'nullable|string|max:255',
            'permanent_barangay' => 'nullable|string|max:255',
            'permanent_city' => 'nullable|string|max:255',
            'permanent_province' => 'nullable|string|max:255',
            'permanent_zip' => 'nullable|string|max:10',
            'telephone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $phs->update($validated);

        return redirect()->route('phs.edit', $phs->id)
            ->with('success', 'Personal History Statement updated successfully.');
    }

    public function educationalBackground()
    {
        return view('phs.educational-background', $this->getCommonViewData('educational-background'));
    }

    public function storeEducationalBackground(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'elementary.*.name' => 'nullable|string|max:255',
                'highschool.*.name' => 'nullable|string|max:255',
                'college.*.name' => 'nullable|string|max:255',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'elementary.*.name' => 'nullable|string|max:255',
                'highschool.*.name' => 'nullable|string|max:255',
                'college.*.name' => 'nullable|string|max:255',
            ]);
        }

        // Mark educational background as completed
        $this->markSectionAsCompleted('educational-background');

        // Save logic — example:
        // DB::table('educational_backgrounds')->insert([...]);

        // Return appropriate response based on mode
        if ($isSaveOnly) {
            return response()->json(['success' => true, 'message' => 'Educational background saved successfully']);
        }

        return redirect()->route('phs.military-history.create')->with('success', 'Educational background saved successfully!');
    }

    /**
     * Helper method to get common data for all PHS views
     */
    private function getCommonViewData($currentSection)
    {
        // Mark current section as visited
        session(["phs_sections.{$currentSection}" => 'visited']);
        
        return [
            'currentSection' => $currentSection,
            'sectionStatus' => $this->getSectionStatus()
        ];
    }
} 