<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserDetail;
use App\Models\ActivityLogDetail;
use App\Models\NameDetail;
use App\Models\AddressDetail;
use App\Models\JobDetail;

Use App\Helper\DataRetrieval;

class PersonalDetailsController extends Controller
{
    public function create()
    {
        $viewData = array_merge(
            $this->getCommonViewData('personal-details'),
            $this->retrievePreFillValues()
        );

        // Check if it's an AJAX request
        if (request()->ajax()) {
            return view('phs.personal-details', $viewData)->render();
        }
        return view('phs.personal-details', $viewData);
    }

    public function store(Request $request)
    {
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

        $username = auth()->user()->username;
        $data = [
            'name' => [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'middle_name' => $validated['middle_name'] ?? null,
                'suffix' => $validated['suffix'] ?? null,
                'nickname' => $validated['nickname'] ?? null,
                'change_in_name' => $validated['name_change'] ?? null,
            ],
            'birth_address' => [
                'region' => $validated['birth_region'] ?? null,
                'province' => $validated['birth_province'] ?? null,
                'city' => $validated['birth_city'] ?? null,
                'barangay' => $validated['birth_barangay'] ?? null,
                'street' => $validated['birth_street'] ?? null,
            ],
            'home_address' => [
                'region' => $validated['home_region'] ?? null,
                'province' => $validated['home_province'] ?? null,
                'city' => $validated['home_city'] ?? null,
                'barangay' => $validated['home_barangay'] ?? null,
                'street' => $validated['home_street'] ?? null,
            ],
            'business_address' => [
                'region' => $validated['business_region'] ?? null,
                'province' => $validated['business_province'] ?? null,
                'city' => $validated['business_city'] ?? null,
                'barangay' => $validated['business_barangay'] ?? null,
                'street' => $validated['business_street'] ?? null,
            ],
            'birth_date' => $validated['date_of_birth'],
            'nationality' => null, // will be mapped below
            'religion' => $validated['religion'] ?? null,
            'mobile' => $validated['mobile'] ?? null,
            'email' => $validated['email'] ?? null,
            'personal' => [
                'nickname' => $validated['nickname'] ?? null,
                'change_in_name' => $validated['name_change'] ?? null,
            ],
            'job' => [
                'branch_of_service' => $validated['branch_of_service'] ?? null,
                'rank' => $validated['rank'] ?? null,
                'afpsn' => $validated['afpsn'] ?? null,
                'job_desc' => $validated['present_job'] ?? null,
            ],
            'gov_id' => [
                'tin_num' => $validated['tin'] ?? null,
                'pass_num' => $validated['passport_number'] ?? null,
                'pass_exp' => $validated['passport_expiry'] ?? null,
            ],
        ];
        // Map nationality string to citizenship ID
        if (!empty($validated['nationality'])) {
            $citizenship = \App\Models\CitizenshipDetail::where('cit_description', $validated['nationality'])->first();
            if ($citizenship) {
                $data['nationality'] = $citizenship->cit_id;
            }
        }
        \App\Helper\DataUpdate::savePersonalDetails($data, $username);
        return redirect()->route('phs.personal-characteristics.create');
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
    private function createJobDetails($jobData): void {
        JobDetail::firstOrCreate([
            'username' => auth() ->user()->username,
            'service_branch'=> $jobData['branch_of_service'],
            'rank'=> $jobData['rank'],
            'afpsn'=> $jobData['afpsn'],
            'job_addr'=> $jobData['job_addr'],
        ]);
    }

    private function createNewActivity($activityData): void {
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

    private function retrievePreFillValues(): ?array {
        $userDetail = DataRetrieval::retrieveUserDetail(auth()->user()->username) ?? null;
        $name = DataRetrieval::retrieveNameDetail($userDetail?->full_name ?? null) ?? null;
        $home = DataRetrieval::retrieveAddressDetail($userDetail?->home_addr ?? null) ?? null;
        $birthAddr = DataRetrieval::retrieveAddressDetail($userDetail?->birth_place ?? null) ?? null;
        $jobDetail = DataRetrieval::retrieveJobDetail(auth()->user()->username) ?? null;
        $busAddr = DataRetrieval::retrieveAddressDetail($jobDetail?->job_addr ?? null) ?? null;
        $govId = DataRetrieval::retrieveGovIdDetail(auth()->user()->username) ?? null;
        $nationality = DataRetrieval::retrieveCitizenshipDetail($userDetail->nationality ?? null) ?? null     ;

        return [
            "first_name" => $name?->first_name ?? '',
            "last_name" => $name?->last_name ?? '',
            "middle_name" => $name?->middle_name ?? '',
            "suffix" => $name?->suffix ?? '',
            "nickname"=> $name?->nickname ?? '',
            "date_of_birth" => $userDetail?->birth_date ?? '',
            "birth_region" => $birthAddr?->region ?? '',
            "birth_province" => $birthAddr?->province ?? '',
            "birth_city" => $birthAddr?->city ?? '',
            "birth_barangay" => $birthAddr?->barangay ?? '',
            "birth_street" => $birthAddr?->street ?? '',
            "nationality" => $nationality?->cit_description ?? '',
            "rank" => $jobDetail?->rank ?? '',
            "afpsn" => $jobDetail?->afpsn ?? '',
            "branch_of_service"=> $jobDetail?->service_branch ?? '',
            "present_job" => $jobDetail?->job_desc ?? '',
            "home_region" => $home?->region ?? '',
            "home_province" => $home?->province ?? '',
            "home_city" => $home?->city ?? '',
            "home_barangay" => $home?->barangay ?? '',
            "home_street" => $home?->street ?? '',
            "business_region" => $busAddr?->region ?? '',
            "business_province" => $busAddr?->province ?? '',
            "business_city" => $busAddr?->city ?? '',
            "business_barangay" => $busAddr?->barangay ?? '',
            "business_street" => $busAddr?->street ?? '',
            "email" => $userDetail?->email_addr ?? '',
            "mobile" => $userDetail?->mobile_num ?? '',
            "religion" => $userDetail?->religion ?? '',
            "tin" => $govId?->tin_num ?? '',
            "passport_number" => $govId?->pass_num ?? '',
            "passport_expiry" => $govId?->pass_exp ?? '',
            "name_change" => $name?->change_in_name ?? '',
        ];
    }
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
