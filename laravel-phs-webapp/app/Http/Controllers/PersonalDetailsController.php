<?php

namespace App\Http\Controllers;

use App\Models\AddressDetail;
use Illuminate\Http\Request;

Use App\Models\User;
use App\Models\UserDetail;
use App\Models\ActivityLogDetail;
use App\Models\NameDetail;
use App\Models\AddressDetail;
use App\Models\JobDetail;
use App\Models\GovernmentIdDetail;

Use App\Traits\PHSSectionTracking;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonalDetailsController extends Controller
{
    public function create()
    {
        $user = User::find(auth()->id());

        $data = UserDetail::with('nameDetail')
        ->where('username',auth()->user()->username)
        ->first();

        $viewData = $this->getCommonViewData('personal-details');
        $viewData['personalDetails'] = $user;
        $viewData['userDetails'] = $data;

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.personal-details', $viewData)->render();
        }

        return view('phs.personal-details', $viewData);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date',
            'birth_region' => 'nullable|string|max:255',
            'birth_province' => 'nullable|string|max:255',
            'birth_city' => 'nullable|string|max:255',
            'birth_barangay' => 'nullable|string|max:255',
            'birth_street' => 'nullable|string|max:255',
            'nationality' => 'required|string|max:255',
            'rank' => 'nullable|string|max:255',
            'afpsn' => 'nullable|string|max:255',
            'branch_of_service' => 'nullable|string|max:255',
            'present_job' => 'nullable|string|max:255',
            'home_region' => 'nullable|string|max:255',
            'home_province' => 'required|string|max:255',
            'home_city' => 'required|string|max:255',
            'home_barangay' => 'nullable|string|max:255',
            'home_street' => 'nullable|string|max:255',
            'business_region' => 'nullable|string|max:255',
            'business_province' => 'nullable|string|max:255',
            'business_city' => 'nullable|string|max:255',
            'business_barangay' => 'nullable|string|max:255',
            'business_street' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'tin' => 'nullable|string|max:255',
            'passport_number' => 'nullable|string|max:255',
            'passport_expiry' => 'nullable|string|max:255',
            'name_change' => 'nullable|string|max:255',
        ]);

        $nameData = $validated->only([
                    'last_name', 'first_name', 'middle_name', 'suffix'
                ]);
        $birthAddr = $validated->only([
            'birth_region','birth_province','birth_city','birth_barangay','birth_street',
        ]);

        // Validate and store the personal details
        $existingUserDetail = UserDetail::where('username', auth()->user()->username)->first();
        $recordedName = $this->nameExists($nameData);

        if (!$existingUserDetail) {
            $newUserDetail = UserDetail::create([
                            'username' => auth() ->user()->username,
                        ]);
            $existingUserDetail = $newUserDetail;
        }

        $birthAddr = $this->createNewAddress([
            'region' => $request->birth_region,
            'province'=> $request->birth_province,
            'city'=> $request->birth_city,
            'barangay'=> $request->birth_barangay,
            'street'=> $request->birth_street,
        ]);

        $homeAddr = $this->createNewAddress([
            'region' => $request->home_region,
            'province'=> $request->home_province,
            'city'=> $request->home_city,
            'barangay'=> $request->home_barangay,
            'street'=> $request->home_street,
        ]);

        $businessAddr = $this->createNewAddress([
            'region' => $request->business_region,
            'province'=> $request->business_province,
            'city'=> $request->business_city,
            'barangay'=> $request->business_barangay,
            'street'=> $request->business_street,
        ]);

        //saving after mapping what needs to be mapped
        if ($recordedName) {
            $existingUserDetail->update([
                'full_name' => $recordedName->id
            ]);
        } else {
            $existingUserDetail->update([
                'full_name' => $this->createNewName($nameData),
            ]);
        }


        return redirect()->route('phs.personal-characteristics.create');
            // ->with('success', 'Personal details saved successfully.');
    }
    private function nameExists($nameData):?NameDetail {
        return NameDetail::where('last_name',$nameData['last_name'])
        ->where('first_name',$nameData['first_name'])
        ->where('middle_name',$nameData['middle_name'])
        ->where('name_extension',$nameData['suffix'])
        ->first();
    }
    private function addressExists($addressData):?AddressDetail {
        return AddressDetail::where('country', $addressData['country'])
        ->where('region', $addressData['region'])
        ->where('province', $addressData['province'])
        ->where('city', $addressData['city'])
        ->where('barangay', $addressData['barangay'])
        ->where('street', $addressData['street'])
        ->where('zip_code', $addressData['zip_code'])
        ->first();
    }
    private function createNewName($nameData):int {
        return NameDetail::firstOrCreate([
                        'last_name' => $nameData['last_name'],
                        'first_name'=> $nameData['first_name'],
                        'middle_name' => $nameData['middle_name'],
                        'name_extension'=> $nameData['suffix'],
                    ])->id;
    }
    private function createNewAddress($addressData):AddressDetail {
        return AddressDetail::firstOrCreate([
            'country' => $addressData['country'] ?? null,
            'region' => $addressData['region'] ?? null,
            'province' => $addressData['province'] ?? null,
            'city'=> $addressData['city'] ?? null,
            'barangay'=> $addressData['barangay'] ?? null,
            'street' => $addressData['street'] ?? null,
            'zip_code'=> $addressData['zip_code'] ?? null,
        ]);
    }
    private function createJobDetails($jobData): {
        JobDetail::firstOrCreate([
            'username' => auth() ->user()->username,
            'service_branch'=> $jobData['branch_of_service'],
            'rank'=> $jobData['rank'],
            'afpsn'=> $jobData['afpsn'],
            'job_addr'=> $jobData['job_addr'],
        ]);
    }

    private function createNewActivity($activityData) {
        ActivityLogDetail::create([
            'changes_made_by'=>auth()->user()->username,
            'action'=>$activityData('action'),
            'act_desc'=> $activityData('act_desc'),
            'act_stat'=> $activityData('act_stat'),
            'ip_addr'=> $activityData('ip_addr'),
            'user_agent'=> $activityData('user_agent'),
            'act_date_time'=> $activityData(''),
            'old_value'=> $activityData('old_value'),
            'new_value'=> $activityData('new_value'),
        ]);
    }

    private function retrieveRecordedName($nameId):NameDetail {
        return NameDetail::where('name_id', $nameId)->first();
    }
    private function retrieveUserDetail(): UserDetail {
        return UserDetail::where('username', auth()->user()->username)->first();
    }
    private function retrieveHomeDetail($addr_id): AddressDetail {
        return AddressDetail::where('addr_id', $addr_id)->first();
    }
    private

    private function getCommonViewData($currentSection)
    {
        // Mark current section as visited
        session(["phs_sections.{$currentSection}" => 'visited']);

        return [
            'currentSection' => $currentSection,
            // 'sectionStatus' => $this->getSectionStatus()
        ];
    }

}
