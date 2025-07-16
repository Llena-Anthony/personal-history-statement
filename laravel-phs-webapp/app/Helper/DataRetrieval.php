<?php

namespace App\Helper;

use App\Models\ActivityLogDetail;
use App\Models\AddressDetail;
use App\Models\ArrestDetail;
use App\Models\ArrestRecordDetail;
use App\Models\AssignmentDetail;
use App\Models\AwardDetail;
use App\Models\BankAccountDetail;
use App\Models\BankDetail;
use App\Models\ChildrenDetail;
use App\Models\CitizenshipDetail;
use App\Models\CreditDetail;
use App\Models\CreditReferenceDetail;
use App\Models\DescriptionDetail;
use App\Models\EducationDetail;
use App\Models\EmploymentDetail;
use App\Models\FamilyDetail;
use App\Models\FamilyHistoryDetail;
use App\Models\FluencyDetail;
use App\Models\ForeignVisitDetail;
use App\Models\GovernmentIdDetail;
use App\Models\JobDetail;
use App\Models\LanguageDetail;
use App\Models\MaritalDetail;
use App\Models\MembershipDetail;
use App\Models\MilitaryHistoryDetail;
use App\Models\MilitarySchoolDetail;
use App\Models\NameDetail;
use App\Models\OccupationDetail;
use App\Models\OrganizationDetail;
use App\Models\PersonalDetail;
use App\Models\ReferenceDetail;
use App\Models\SchoolDetail;
use App\Models\SiblingDetail;
use App\Models\SpouseDetail;
use App\Models\User;
use App\Models\UserDetail;

class DataRetrieval {
    public static function retrieveActivities() {
        return ActivityLogDetail::all();
    }
    public static function retrieveAddressDetail($addr_id): ?AddressDetail {
        return AddressDetail::where('addr_id', $addr_id)->first() ?? null;
    }
    public static function retrieveArrestDetail($arrestId): ?ArrestDetail {
        return ArrestDetail::where('arrest_detail_id', $arrestId)->first() ?? null;
    }
    public static function retrieveArrestRecord($username): ?ArrestRecordDetail {
        return ArrestRecordDetail::where('username', $username)->first() ?? null;
    }
    public static function retrieveAssignments($assign_id) {
        return AssignmentDetail::where('assign_id', $assign_id)->get();
    }
    public static function retrieveAwards($username) {
        return AwardDetail::where('username', $username)->get();
    }
    public static function retrieveBankAccounts($username) {
        return BankAccountDetail::where('username', $username)->get();
    }
    public static function retrieveBank($bankId): ?BankDetail {
        return BankDetail::where('bank_id', $bankId)->first() ?? null;
    }
    public static function retrieveCitizenshipDetail($citId): ?CitizenshipDetail {
        return CitizenshipDetail::where('cit_id', $citId)->first() ?? null;
    }
    public static function retrieveChildren($username){
        return ChildrenDetail::where('username', $username)->get();
    }
    public static function retrieveCreditDetail($username): ?CreditDetail {
        return CreditDetail::where('username', $username)->first() ?? null;
    }
    public static function retrieveCreditReferences($username) {
        return CreditReferenceDetail::where('username', $username)->get();
    }
    public static function retrieveDescription($username) : ?DescriptionDetail {
        return DescriptionDetail::where('username', $username)->first() ?? null;
    }
    public static function retrieveElementary($username) {
        return EducationDetail::where('username', $username)->where('educ_level', 'elementary')->get();
    }
    public static function retrieveHighSchool($username) {
        return EducationDetail::where('username', $username)->where('educ_level', 'highschool')->get();
    }
    public static function retrieveCollege($username) {
        return EducationDetail::where('username', $username)->where('educ_level', 'college')->get();
    }
    public static function retrievePostGrad($username) {
        return EducationDetail::where('username', $username)->where('educ_level', 'postgrad')->get();
    }
    public static function retrieveEmployment($username) {
        return EmploymentDetail::where('username',$username)->get();
    }
    public static function retrieveEmploymentDetail(int $employId): ?EmploymentDetail {
        return EmploymentDetail::where('employ_id',$employId)->first() ?? null;
    }
    public static function retrieveFamily($famId) {
        return FamilyDetail::where('fam_id',$famId)->first() ?? null;
    }
    public static function retrieveFamHistory($username): ?FamilyHistoryDetail {
        return FamilyHistoryDetail::where('username',$username)->first() ?? null;
    }
    public static function retrieveFluency($username) {
        return FluencyDetail::where('username',$username)->get();
    }
    public static function retrieveForeignVisits($username) {
        return ForeignVisitDetail::where('username',$username)->get();
    }
    public static function retrieveGovIdDetail($username): ?GovernmentIdDetail {
        return GovernmentIdDetail::where('username',$username)->first() ?? null;
    }
    public static function retrieveJobDetail($username): ?JobDetail {
        return JobDetail::where('username', $username)->first() ?? null;
    }
    public static function retrieveLanguage($langId): ?LanguageDetail {
        return LanguageDetail::where('lang_id',$langId)->first() ?? null;
    }
    public static function retrieveMaritalDetail($username): ?MaritalDetail {
        return MaritalDetail::where('username',$username)->first() ?? null;
    }
    public static function retrieveMemberships($username) {
        return MembershipDetail::where('username',$username)->get();
    }
    public static function retrieveMilitaryHist($username): ?MilitaryHistoryDetail {
        return MilitaryHistoryDetail::where('username',$username)->first() ?? null;
    }
    public static function retrieveMilitarySchool($username) {
        return MilitaryHistoryDetail::where('username',$username)->get();
    }
    public static function retrieveNameDetail($nameId): ?NameDetail {
        return NameDetail::where('name_id', $nameId)->first() ?? null;
    }
    public static function retrieveOrg($ordId): ?OrganizationDetail {
        return OrganizationDetail::where('org_id',$ordId)->first() ?? null;
    }
    public static function retrieveOccupation($occupationId): ?OccupationDetail {
        return OccupationDetail::where('occupation_id',$occupationId)->first() ?? null;
    }
    public static function retrievePersonalDetail($username): ?PersonalDetail {
        return PersonalDetail::where('username',$username)->first() ?? null;
    }
    public static function retrieveCharRef($username) {
        return ReferenceDetail::where('username',$username)->where('ref_type','character')->get();
    }
    public static function retrieveNeighbor($username) {
        return ReferenceDetail::where('username',$username)->where('ref_type','neighbor')->get();
    }
    public static function retrieveSiblings($username) {
        return SiblingDetail::where('username',$username)->get();
    }
    public static function retrieveSchool($schoolId): ?SchoolDetail {
        return SchoolDetail::where('school_id',$schoolId)->first() ?? null;
    }
    public static function retrieveSpouse($username): ?SpouseDetail {
        return SpouseDetail::where('username',$username)->first() ?? null;
    }
    public static function retrieveUser($username): ?User {
        return User::where('username',$username)->first() ?? null;
    }
    public static function retrieveUserDetail($username): ?UserDetail {
        return UserDetail::where('username', $username)->first() ?? null;
    }

    /**
     * Retrieve all personal characteristics fields for a user, merging DescriptionDetail and PersonalDetail.
     */
    public static function retrievePersonalCharacteristics($username) {
        $desc = DescriptionDetail::where('username', $username)->first();
        $personal = PersonalDetail::where('username', $username)->first();

        return [
            // DescriptionDetail fields
            'sex' => $desc?->sex ?? '',
            'age' => $desc?->age ?? '',
            'height' => $desc?->height ?? '',
            'weight' => $desc?->weight ?? '',
            'body_build' => $desc?->body_build ?? '',
            'complexion' => $desc?->complexion ?? '',
            'eye_color' => $desc?->eye_color ?? '',
            'hair_color' => $desc?->hair_color ?? '',
            'distinguishing_features' => $desc?->other_marks ?? '',

            // PersonalDetail fields
            'health_status' => $personal?->health_state ?? '',
            'recent_illness' => $personal?->illness ?? '',
            'blood_type' => $personal?->blood_type ?? '',
            'cap_size' => $personal?->cap_size ?? '',
            'shoe_size' => $personal?->shoe_size ?? '',
            'hobbies' => $personal?->hobbies ?? '',
            'undergo_lie_detection' => $personal?->undergo_lie_detection ?? '',
        ];
    }

    /**
     * Retrieve all marital status fields for a user, using existing helpers and relationships.
     */
    public static function retrieveMaritalStatus($username) {
        $marital = self::retrieveMaritalDetail($username);
        $spouse = $marital?->spouseDetail;
        $spouseName = $spouse?->nameDetail;
        $occupation = $spouse?->occupationDetail;
        $marriagePlace = $spouse?->marriagePlace;
        $birthPlace = $spouse?->birthPlace;
        $citizenship = $spouse?->citizenshipDetail;
        $dualCitizenship = $spouse?->dualCitizenship;
        $children = self::retrieveChildren($username);

        return [
            // Marital status
            'marital_status' => $marital?->marital_stat ?? '',

            // Spouse info
            'spouse_first_name' => $spouseName?->first_name ?? '',
            'spouse_middle_name' => $spouseName?->middle_name ?? '',
            'spouse_last_name' => $spouseName?->last_name ?? '',
            'spouse_suffix' => $spouseName?->name_extension ?? '',
            'marriage_month' => $spouse?->marr_date ? date('m', strtotime($spouse->marr_date)) : '',
            'marriage_year' => $spouse?->marr_date ? date('Y', strtotime($spouse->marr_date)) : '',
            'marriage_place' => $marriagePlace ? implode(', ', array_filter([
                $marriagePlace->street,
                $marriagePlace->barangay,
                $marriagePlace->city,
                $marriagePlace->province,
                $marriagePlace->region,
                $marriagePlace->country
            ])) : '',
            'spouse_birth_date' => $spouse?->birth_date ?? '',
            'spouse_birth_place' => $birthPlace ? implode(', ', array_filter([
                $birthPlace->street,
                $birthPlace->barangay,
                $birthPlace->city,
                $birthPlace->province,
                $birthPlace->region,
                $birthPlace->country
            ])) : '',
            'spouse_occupation' => $occupation?->occupation_desc ?? '',
            'spouse_employer' => $occupation?->employer ?? '',
            'spouse_employment_place' => $occupation && $occupation->addressDetail
                ? implode(', ', array_filter([
                    $occupation->addressDetail->street,
                    $occupation->addressDetail->barangay,
                    $occupation->addressDetail->city,
                    $occupation->addressDetail->province,
                    $occupation->addressDetail->region,
                    $occupation->addressDetail->country
                ])) : '',
            'spouse_contact' => $spouse?->mobile_num ?? '',
            'spouse_citizenship' => $citizenship?->cit_description ?? '',
            'spouse_other_citizenship' => $dualCitizenship?->cit_description ?? '',

            // Children
            'children' => $children,
        ];
    }

    /**
     * Retrieve all family background fields for a user, using FamilyHistoryDetail for mapping and existing helpers for details.
     */
    public static function retrieveFamilyBackground($username) {
        $famHistory = self::retrieveFamHistory($username);
        $family_members = collect();
        $roles = [
            'father' => $famHistory?->father,
            'mother' => $famHistory?->mother,
            'guardian' => $famHistory?->guardian,
            'father_in_law' => $famHistory?->father_in_law,
            'mother_in_law' => $famHistory?->mother_in_law,
        ];
        foreach ($roles as $role => $famId) {
            if ($famId) {
                $fam = self::retrieveFamily($famId);
                $name = $fam?->familyName;
                $birthPlace = $fam?->birthPlace;
                $address = $fam?->familyAddr;
                $occupation = $fam?->occupationDetail;
                $citizenship = $fam?->citizenshipDetail;
                $dualCitizenship = $fam?->dualCitizenship;
                $placeNaturalized = $fam?->placeNaturalized;
                $family_members->put($role, (object) [
                    'first_name' => $name?->first_name ?? '',
                    'middle_name' => $name?->middle_name ?? '',
                    'last_name' => $name?->last_name ?? '',
                    'suffix' => $name?->name_extension ?? '',
                    'birth_date' => $fam?->birth_date ?? '',
                    'birth_place' => $birthPlace ? implode(', ', array_filter([
                        $birthPlace->street,
                        $birthPlace->barangay,
                        $birthPlace->city,
                        $birthPlace->province,
                        $birthPlace->region,
                        $birthPlace->country
                    ])) : '',
                    'complete_address' => $address ? implode(', ', array_filter([
                        $address->street,
                        $address->barangay,
                        $address->city,
                        $address->province,
                        $address->region,
                        $address->country
                    ])) : '',
                    'occupation' => $occupation?->occupation_desc ?? '',
                    'employer' => $occupation?->employer ?? '',
                    'place_of_employment' => $occupation && $occupation->addressDetail
                        ? implode(', ', array_filter([
                            $occupation->addressDetail->street,
                            $occupation->addressDetail->barangay,
                            $occupation->addressDetail->city,
                            $occupation->addressDetail->province,
                            $occupation->addressDetail->region,
                            $occupation->addressDetail->country
                        ])) : '',
                    'citizenship' => $citizenship?->cit_description ?? '',
                    'dual_citizenship' => $dualCitizenship?->cit_description ?? '',
                    'citizenship_type' => $fam?->dual ? 'Dual' : ($fam?->date_naturalized ? 'Naturalized' : 'Single'),
                    'date_naturalized' => $fam?->date_naturalized ?? '',
                    'place_naturalized' => $placeNaturalized ? implode(', ', array_filter([
                        $placeNaturalized->street,
                        $placeNaturalized->barangay,
                        $placeNaturalized->city,
                        $placeNaturalized->province,
                        $placeNaturalized->region,
                        $placeNaturalized->country
                    ])) : '',
                ]);
            }
        }
        // Always return siblings as a collection
        $siblings = self::retrieveSiblings($username);
        return [
            'family_members' => $family_members,
            'siblings' => $siblings,
        ];
    }

    /**
     * Retrieve all educational background fields for a user, using existing helpers for each level.
     */
    public static function retrieveEducationalBackground($username) {
        return [
            'elementary' => self::retrieveElementary($username),
            'highschool' => self::retrieveHighSchool($username),
            'college' => self::retrieveCollege($username),
            'postgrad' => self::retrievePostGrad($username),
        ];
    }

    /**
     * Retrieve all personal details fields for a user, using existing helpers and relationships.
     */
    public static function retrievePersonalDetails($username) {
        $userDetail = self::retrieveUserDetail($username);
        $name = $userDetail ? self::retrieveNameDetail($userDetail->full_name) : null;
        $jobDetail = self::retrieveJobDetail($username);
        $govId = self::retrieveGovIdDetail($username);
        $nationality = $userDetail ? self::retrieveCitizenshipDetail($userDetail->nationality) : null;
        $personalDetail = self::retrievePersonalDetail($username);

        // Parse address text from user_details table
        $homeAddress = $userDetail ? self::parseAddressText($userDetail->home_addr) : [];
        $birthAddress = $userDetail ? self::parseAddressText($userDetail->birth_place) : [];
        $businessAddress = $jobDetail ? self::parseAddressText($jobDetail->job_addr) : [];

        return [
            "first_name" => $name?->first_name ?? '',
            "last_name" => $name?->last_name ?? '',
            "middle_name" => $name?->middle_name ?? '',
            "suffix" => $name?->suffix ?? '',
            "nickname" => $personalDetail?->nickname ?? '',
            "date_of_birth" => $userDetail?->birth_date ?? '',
            "birth_region" => '', // Empty for dropdown functionality
            "birth_province" => '', // Empty for dropdown functionality
            "birth_city" => '', // Empty for dropdown functionality
            "birth_barangay" => '', // Empty for dropdown functionality
            "birth_street" => $birthAddress['street'] ?? '',
            "birth_region_name" => $birthAddress['region'] ?? '',
            "birth_province_name" => $birthAddress['province'] ?? '',
            "birth_city_name" => $birthAddress['city'] ?? '',
            "birth_barangay_name" => $birthAddress['barangay'] ?? '',
            "nationality" => $nationality?->cit_description ?? '',
            "rank" => $jobDetail?->rank ?? '',
            "afpsn" => $jobDetail?->afpsn ?? '',
            "branch_of_service" => $jobDetail?->service_branch ?? '',
            "present_job" => $jobDetail?->job_desc ?? '',
            "home_region" => '', // Empty for dropdown functionality
            "home_province" => '', // Empty for dropdown functionality
            "home_city" => '', // Empty for dropdown functionality
            "home_barangay" => '', // Empty for dropdown functionality
            "home_street" => $homeAddress['street'] ?? '',
            "home_region_name" => $homeAddress['region'] ?? '',
            "home_province_name" => $homeAddress['province'] ?? '',
            "home_city_name" => $homeAddress['city'] ?? '',
            "home_barangay_name" => $homeAddress['barangay'] ?? '',
            "business_region" => '', // Empty for dropdown functionality
            "business_province" => '', // Empty for dropdown functionality
            "business_city" => '', // Empty for dropdown functionality
            "business_barangay" => '', // Empty for dropdown functionality
            "business_street" => $businessAddress['street'] ?? '',
            "business_region_name" => $businessAddress['region'] ?? '',
            "business_province_name" => $businessAddress['province'] ?? '',
            "business_city_name" => $businessAddress['city'] ?? '',
            "business_barangay_name" => $businessAddress['barangay'] ?? '',
            "email" => $userDetail?->email_addr ?? '',
            "mobile" => $userDetail?->mobile_num ?? '',
            "religion" => $userDetail?->religion ?? '',
            "tin" => $govId?->tin_num ?? '',
            "passport_number" => $govId?->pass_num ?? '',
            "passport_expiry" => $govId?->pass_exp ?? '',
            "name_change" => $personalDetail?->change_in_name ?? '',
        ];
    }

    // Helper to parse address text into components
    private static function parseAddressText($addressText) {
        if (empty($addressText)) {
            return [];
        }
        $parts = array_map('trim', explode(',', $addressText));
        $result = [];
        if (count($parts) > 0) $result['street'] = $parts[0];
        if (count($parts) > 1) $result['barangay'] = $parts[1];
        if (count($parts) > 2) $result['city'] = $parts[2];
        if (count($parts) > 3) $result['province'] = $parts[3];
        if (count($parts) > 4) $result['region'] = $parts[4];
        return $result;
    }

    /**
     * Retrieve all character and reputation fields for a user.
     */
    public static function retrieveCharacterReputation($username) {
        $characterReferences = self::retrieveCharRef($username)->map(function($ref) {
            $name = $ref->nameDetail ? $ref->nameDetail->first_name : '';
            return [
                'name' => $name,
                'address' => $ref->ref_addr ?? '',
            ];
        })->toArray();

        $neighbors = self::retrieveNeighbor($username)->map(function($ref) {
            $name = $ref->nameDetail ? $ref->nameDetail->first_name : '';
            return [
                'name' => $name,
                'address' => $ref->ref_addr ?? '',
            ];
        })->toArray();

        return [
            'character_references' => $characterReferences,
            'neighbors' => $neighbors,
        ];
    }

    /**
     * Retrieve all organization memberships for a user.
     */
    public static function retrieveOrganizationMemberships($username) {
        $memberships = self::retrieveMemberships($username);
        $orgIds = $memberships->pluck('org')->unique()->toArray();
        $organizations = OrganizationDetail::with(['addressDetail', 'membershipDetails' => function($q) use ($username) {
            $q->where('username', $username);
        }])->whereIn('org_id', $orgIds)->get();
        return [
            'organizations' => $organizations,
        ];
    }

    /**
     * Retrieve all miscellaneous information for a user.
     */
    public static function retrieveMiscellaneous($username) {
        $personalDetail = self::retrievePersonalDetail($username);
        $fluencyDetails = self::retrieveFluency($username);

        return [
            'hobbies_sports_pastimes' => $personalDetail?->hobbies ?? '',
            'lie_detection_test' => $personalDetail?->undergo_lie_detection ?? '',
            'languages' => $fluencyDetails,
        ];
    }
}
