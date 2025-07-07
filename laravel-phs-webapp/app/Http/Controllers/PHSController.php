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
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        \Log::info('PHS Store Request:', $request->all());
        
        try {
            // For save-only mode, use minimal validation
            if ($isSaveOnly) {
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
            } else {
                // Full validation for final submission
                $validated = $request->validate([
                    'first_name' => 'required|string|max:255',
                    'middle_name' => 'nullable|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'suffix' => 'nullable|string|max:20',
                    'nickname' => 'nullable|string|max:100',
                    'date_of_birth' => 'required|date',
                    'place_of_birth' => 'required|string|max:255',
                    'gender' => 'required|string|max:20',
                    'civil_status' => 'required|string|max:20',
                    'citizenship' => 'required|string|max:100',
                    'nationality' => 'nullable|string|max:100',
                    'rank' => 'nullable|string|max:100',
                    'afpsn' => 'nullable|string|max:100',
                    'branch_of_service' => 'nullable|string|max:100',
                    'present_job' => 'nullable|string|max:255',
                    'religion' => 'nullable|string|max:100',
                    'email' => 'required|email|max:255',
                    'mobile' => 'required|string|max:50',
                    'tin_no' => 'nullable|string|max:50',
                    'passport_number' => 'nullable|string|max:50',
                    'passport_expiry' => 'nullable|date',
                    // Home address fields
                    'home_region' => 'required|string|max:100',
                    'home_province' => 'required|string|max:100',
                    'home_city' => 'required|string|max:100',
                    'home_barangay' => 'required|string|max:100',
                    'home_street' => 'required|string|max:255',
                    'home_complete_address' => 'required|string|max:255',
                    // Business address fields
                    'business_region' => 'required|string|max:100',
                    'business_province' => 'required|string|max:100',
                    'business_city' => 'required|string|max:100',
                    'business_barangay' => 'required|string|max:100',
                    'business_street' => 'required|string|max:255',
                    'business_complete_address' => 'required|string|max:255',
                ]);
            }

            // Map form 'tin' input to 'tin_no' for DB
            if ($request->has('tin')) {
                $validated['tin_no'] = $request->input('tin');
            }

            // Add name change fields from form 'name_change'
            $name_change = $request->input('name_change', $request->input('change_in_name'));
            $validated['change_in_name'] = $name_change;

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

            // Add combined address fields
            $validated['home_address'] = $home_address;
            $validated['business_address'] = $business_address;

            // Capitalize first letter of each word for names
            foreach (['first_name', 'middle_name', 'last_name'] as $field) {
                if (isset($validated[$field]) && $validated[$field]) {
                    $validated[$field] = ucwords(strtolower($validated[$field]));
                }
            }

            // Add address name fields to validated data
            $addressNameFields = [
                'home_region_name', 'home_province_name', 'home_city_name', 'home_barangay_name',
                'business_region_name', 'business_province_name', 'business_city_name', 'business_barangay_name'
            ];
            
            foreach ($addressNameFields as $field) {
                $validated[$field] = $request->input($field);
            }

            // For save-only mode, provide default values for required fields if they're missing
            if ($isSaveOnly) {
                $defaults = [
                    'first_name' => 'N/A',
                    'last_name' => 'N/A',
                    'date_of_birth' => '1900-01-01',
                    'place_of_birth' => 'N/A',
                    'gender' => 'N/A',
                    'civil_status' => 'N/A',
                    'citizenship' => 'N/A',
                    'email' => 'n/a@example.com',
                ];
                
                // Only add defaults for fields that are missing or empty
                foreach ($defaults as $field => $defaultValue) {
                    if (!isset($validated[$field]) || empty($validated[$field])) {
                        $validated[$field] = $defaultValue;
                    }
                }
            }

            // Filter out any fields that don't exist in the PHS model's fillable array
            $phsModel = new PHS();
            $fillableFields = $phsModel->getFillable();
            $validated = array_intersect_key($validated, array_flip($fillableFields));

            // Add user_id
            $validated['user_id'] = auth()->id();

            \Log::info('PHS Validated Data Before Save:', $validated);

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
                $phs = PHS::create($validated);
                \Log::info('PHS after create:', $phs->toArray());
            }

            // Mark personal details as completed
            $this->markSectionAsCompleted('personal-details');

            DB::commit();
            
            \Log::info('PHS saved successfully:', ['phs_id' => $phs->id]);

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Personal details saved successfully']);
            }

            $isPersonnel = auth()->check() && auth()->user()->role === 'personnel';
            \Log::info('Redirecting after personal details save', ['user_id' => auth()->id(), 'role' => auth()->user()->role ?? null, 'isPersonnel' => $isPersonnel]);
            $nextRoute = $isPersonnel ? route('personnel.phs.personal-characteristics.create') : route('phs.personal-characteristics.create');
            return redirect($nextRoute)
                ->with('success', 'Personal details saved successfully. Please continue with your personal characteristics.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('PHS validation error:', ['errors' => $e->errors()]);
            
            if ($isSaveOnly || $request->ajax()) {
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            
            \Log::error('PHS save error:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            
            if ($isSaveOnly || $request->ajax()) {
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

        $isPersonnel = auth()->check() && auth()->user()->role === 'personnel';
        $nextRoute = $isPersonnel ? route('personnel.phs.military-history.create') : route('phs.military-history.create');
        return redirect($nextRoute)->with('success', 'Educational background saved successfully!');
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