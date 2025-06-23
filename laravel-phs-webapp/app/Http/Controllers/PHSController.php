<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PHS;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\PHSSectionTracking;

class PHSController extends Controller
{
    use PHSSectionTracking;

    public function create()
    {
        return view('phs.personal-details', $this->getCommonViewData('personal-details'));
    }

    public function store(Request $request)
    {
        // Check if this is a save-only request (for dynamic navigation)
        $isSaveOnly = $request->header('X-Save-Only') === 'true';
        
        // For save-only mode, use minimal validation
        if ($isSaveOnly) {
            $validated = $request->validate([
                'first_name' => 'nullable|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'suffix' => 'nullable|string|max:20',
                'rank' => 'nullable|string|max:100',
                'afpsn' => 'nullable|string|max:100',
                'branch_of_service' => 'nullable|string|max:100',
                'present_job' => 'nullable|string|max:255',
                'religion' => 'nullable|string|max:100',
                'home_address' => 'nullable|string|max:255',
                'business_address' => 'nullable|string|max:255',
                'date_of_birth' => 'nullable|date',
                'place_of_birth' => 'nullable|string|max:255',
                'nationality' => 'nullable|string|max:100',
                'change_in_name' => 'nullable|string|max:255',
                'nickname' => 'nullable|string|max:100',
                'email' => 'nullable|email|max:255',
                'tin' => 'nullable|string|max:50',
                'passport_number' => 'nullable|string|max:50',
                'passport_expiry' => 'nullable|date',
                'mobile' => 'nullable|string|max:50',
            ]);
        } else {
            // Full validation for final submission
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'suffix' => 'nullable|string|max:20',
                'rank' => 'nullable|string|max:100',
                'afpsn' => 'nullable|string|max:100',
                'branch_of_service' => 'nullable|string|max:100',
                'present_job' => 'nullable|string|max:255',
                'religion' => 'nullable|string|max:100',
                'home_address' => 'nullable|string|max:255',
                'business_address' => 'nullable|string|max:255',
                'date_of_birth' => 'required|date',
                'place_of_birth' => 'required|string|max:255',
                'nationality' => 'nullable|string|max:100',
                'change_in_name' => 'nullable|string|max:255',
                'nickname' => 'nullable|string|max:100',
                'email' => 'nullable|email|max:255',
                'tin' => 'nullable|string|max:50',
                'passport_number' => 'nullable|string|max:50',
                'passport_expiry' => 'nullable|date',
                'mobile' => 'nullable|string|max:50',
            ]);
        }

        // Capitalize first letter of each word for names
        if ($validated['first_name']) {
            $validated['first_name'] = ucwords(strtolower($validated['first_name']));
        }
        if ($validated['middle_name']) {
            $validated['middle_name'] = ucwords(strtolower($validated['middle_name']));
        }
        if ($validated['last_name']) {
            $validated['last_name'] = ucwords(strtolower($validated['last_name']));
        }

        try {
            DB::beginTransaction();

            // Check if PHS already exists for this user
            $phs = PHS::where('user_id', auth()->id())->first();
            
            if ($phs) {
                // Update existing PHS
                $phs->update($validated);
            } else {
                // Create new PHS
                $phs = PHS::create([
                    'user_id' => auth()->id(),
                    ...$validated
                ]);
            }

            // Mark personal details as completed
            $this->markSectionAsCompleted('personal-details');

            DB::commit();

            // Return appropriate response based on mode
            if ($isSaveOnly) {
                return response()->json(['success' => true, 'message' => 'Data saved successfully']);
            }

            return redirect()->route('phs.family-background.create')
                ->with('success', 'Personal information saved successfully. Please continue with your family background.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($isSaveOnly) {
                return response()->json(['success' => false, 'message' => 'An error occurred while saving'], 500);
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