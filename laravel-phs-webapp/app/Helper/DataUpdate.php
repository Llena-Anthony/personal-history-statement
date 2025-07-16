<?php

namespace App\Helper;

use App\Models\ReferenceDetail;
use App\Models\Miscellaneous;

class DataUpdate {
    /**
     * Update or create character references for a user.
     */
    public static function updateCharacterReferences($username, $references) {
        ReferenceDetail::where('username', $username)
            ->where('ref_type', 'character')
            ->delete();
        foreach ($references as $reference) {
            if (!empty($reference['name']) || !empty($reference['address'])) {
                // Create or find the name in name_details
                $name = \App\Models\NameDetail::firstOrCreate([
                    'first_name' => $reference['name'],
                ]);
                ReferenceDetail::create([
                    'username' => $username,
                    'ref_type' => 'character',
                    'ref_name' => $name->name_id,
                    'ref_addr' => $reference['address'] ?? '',
                ]);
            }
        }
    }

    /**
     * Update or create neighbor references for a user.
     */
    public static function updateNeighbors($username, $neighbors) {
        ReferenceDetail::where('username', $username)
            ->where('ref_type', 'neighbor')
            ->delete();
        foreach ($neighbors as $neighbor) {
            if (!empty($neighbor['name']) || !empty($neighbor['address'])) {
                // Create or find the name in name_details
                $name = \App\Models\NameDetail::firstOrCreate([
                    'first_name' => $neighbor['name'],
                ]);
                ReferenceDetail::create([
                    'username' => $username,
                    'ref_type' => 'neighbor',
                    'ref_name' => $name->name_id,
                    'ref_addr' => $neighbor['address'] ?? '',
                ]);
            }
        }
    }

    /**
     * Update or create name detail for a user.
     */
    public static function updateNameDetail($username, $nameData) {
        // Only use columns that exist in the table
        $name = \App\Models\NameDetail::firstOrCreate([
            'last_name' => $nameData['last_name'] ?? null,
            'first_name' => $nameData['first_name'] ?? null,
            'middle_name' => $nameData['middle_name'] ?? null,
            'suffix' => $nameData['suffix'] ?? null,
        ]);
        return $name->name_id;
    }

    /**
     * Update or create address detail.
     */
    public static function updateAddressDetail($addressData) {
        $address = \App\Models\AddressDetail::firstOrCreate([
            'country' => $addressData['country'] ?? null,
            'region' => $addressData['region'] ?? null,
            'province' => $addressData['province'] ?? null,
            'city' => $addressData['city'] ?? null,
            'barangay' => $addressData['barangay'] ?? null,
            'street' => $addressData['street'] ?? null,
            'zip_code' => $addressData['zip_code'] ?? null,
        ]);
        return $address->addr_id;
    }

    /**
     * Update or create user detail for a user.
     */
    public static function updateUserDetail($username, $userDetailData) {
        // Ensure full_name is set to the correct name_id
        if (isset($userDetailData['full_name']) && is_array($userDetailData['full_name'])) {
            $userDetailData['full_name'] = self::updateNameDetail($username, $userDetailData['full_name']);
        }
        $userDetail = \App\Models\UserDetail::updateOrCreate(
            ['username' => $username],
            $userDetailData
        );
        return $userDetail->username;
    }

    /**
     * Update or create personal detail for a user.
     */
    public static function updatePersonalDetail($username, $personalDetailData) {
        $personalDetail = \App\Models\PersonalDetail::updateOrCreate(
            ['username' => $username],
            $personalDetailData
        );
        return $personalDetail->id;
    }

    /**
     * Update or create job detail for a user.
     */
    public static function updateJobDetail($username, $jobDetailData) {
        // Map input keys to actual DB columns
        $mapped = [
            'username' => $username,
            'service_branch' => $jobDetailData['branch_of_service'] ?? null,
            'rank' => $jobDetailData['rank'] ?? null,
            'afpsn' => $jobDetailData['afpsn'] ?? null,
            'job_desc' => $jobDetailData['job_desc'] ?? null,
        ];
        // If job_addr is present in $jobDetailData, add it
        if (!empty($jobDetailData['job_addr'])) {
            $mapped['job_addr'] = $jobDetailData['job_addr'];
        }
        $jobDetail = \App\Models\JobDetail::updateOrCreate(
            ['username' => $username],
            $mapped
        );
        return $jobDetail->username;
    }

    /**
     * Update or create government ID detail for a user.
     */
    public static function updateGovIdDetail($username, $govIdData) {
        $govId = \App\Models\GovernmentIdDetail::updateOrCreate(
            ['username' => $username],
            $govIdData
        );
        return $govId->id;
    }

    /**
     * Update or create personal characteristics (DescriptionDetail) for a user.
     */
    public static function updatePersonalCharacteristics($username, $characteristicsData) {
        $characteristics = \App\Models\DescriptionDetail::updateOrCreate(
            ['username' => $username],
            $characteristicsData
        );
        return $characteristics->id;
    }

    /**
     * Update or create marital status (MaritalDetail) for a user, and handle children.
     */
    public static function updateMaritalStatus($username, $maritalData, $childrenData = []) {
        $maritalStatus = \App\Models\MaritalDetail::updateOrCreate(
            ['username' => $username],
            $maritalData
        );
        // Handle children
        if (!empty($childrenData)) {
            \App\Models\ChildrenDetail::where('username', $username)->delete();
            foreach ($childrenData as $childData) {
                if (empty($childData['name'])) continue;
                // Create name_details record for the child
                $childNameId = \App\Models\NameDetail::create([
                    'first_name' => $childData['name'] ?? '',
                    'last_name' => $childData['last_name'] ?? '',
                    'middle_name' => $childData['middle_name'] ?? null,
                    'nickname' => $childData['nickname'] ?? null,
                    'suffix' => $childData['suffix'] ?? null,
                ])->id;
                // Create child record
                \App\Models\ChildrenDetail::create([
                    'username' => $username,
                    'name_id' => $childNameId,
                    'birth_date' => $childData['birth_date'] ?? null,
                    'citizenship' => $childData['citizenship'] ?? null,
                    'address' => $childData['address'] ?? null,
                    'father_name' => $childData['father_name'] ?? null,
                    'mother_name' => $childData['mother_name'] ?? null,
                ]);
            }
        }
        return $maritalStatus->id;
    }

    /**
     * Update or create family background for a user, including family members and siblings.
     */
    public static function updateFamilyBackground($userId, $fbData, $familyMembers = [], $siblings = []) {
        // Get or create FamilyHistoryDetail for this user
        $user = \App\Models\User::find($userId);
        if (!$user) {
            throw new \Exception("User not found with ID: $userId");
        }
        
        $familyHistory = \App\Models\FamilyHistoryDetail::updateOrCreate(
            ['username' => $user->username],
            []
        );
        
        // Handle family members
        if (!empty($familyMembers)) {
            foreach ($familyMembers as $member) {
                if (empty($member['role']) || empty($member['name'])) continue;
                
                // Create name detail
                $nameId = \App\Models\NameDetail::create([
                    'first_name' => $member['name']['first_name'] ?? '',
                    'last_name' => $member['name']['last_name'] ?? '',
                    'middle_name' => $member['name']['middle_name'] ?? null,
                    'nickname' => $member['name']['nickname'] ?? null,
                    'name_extension' => $member['name']['suffix'] ?? null,
                ])->name_id;
                
                // Create address for birth place if provided
                $birthPlaceId = null;
                if (!empty($member['birth_place'])) {
                    $birthPlaceId = \App\Models\AddressDetail::create([
                        'street' => $member['birth_place'],
                        'country' => 'Philippines'
                    ])->addr_id;
                }
                
                // Create address for family address if provided
                $familyAddrId = null;
                if (!empty($member['complete_address'])) {
                    $familyAddrId = \App\Models\AddressDetail::create([
                        'street' => $member['complete_address'],
                        'country' => 'Philippines'
                    ])->addr_id;
                }
                
                // Create occupation if provided
                $occupationId = null;
                if (!empty($member['occupation'])) {
                    $occupationId = \App\Models\OccupationDetail::create([
                        'occupation_desc' => $member['occupation'],
                        'employer' => $member['employer'] ?? null,
                    ])->occupation_id;
                }
                
                // Create citizenship if provided
                $citizenshipId = null;
                if (!empty($member['citizenship'])) {
                    $citizenshipId = \App\Models\CitizenshipDetail::create([
                        'cit_description' => $member['citizenship']
                    ])->cit_id;
                }
                
                // Create dual citizenship if provided
                $dualCitizenshipId = null;
                if (!empty($member['dual_citizenship'])) {
                    $dualCitizenshipId = \App\Models\CitizenshipDetail::create([
                        'cit_description' => $member['dual_citizenship']
                    ])->cit_id;
                }
                
                // Create place naturalized if provided
                $placeNaturalizedId = null;
                if (!empty($member['place_naturalized'])) {
                    $placeNaturalizedId = \App\Models\AddressDetail::create([
                        'street' => $member['place_naturalized'],
                        'country' => 'Philippines'
                    ])->addr_id;
                }
                
                // Create family detail
                $familyDetail = \App\Models\FamilyDetail::create([
                    'fam_name' => $nameId,
                    'birth_date' => $member['birth_date'] ?? null,
                    'birth_place' => $birthPlaceId,
                    'fam_addr' => $familyAddrId,
                    'occupation' => $occupationId,
                    'citizenship' => $citizenshipId,
                    'dual' => $dualCitizenshipId,
                    'date_naturalized' => $member['date_naturalized'] ?? null,
                    'place_naturalized' => $placeNaturalizedId,
                ]);
                
                // Update FamilyHistoryDetail with the family member reference
                $roleField = $member['role'];
                if (in_array($roleField, ['father', 'mother', 'guardian', 'father_in_law', 'mother_in_law'])) {
                    $familyHistory->update([$roleField => $familyDetail->fam_id]);
                }
            }
        }
        
        // Handle siblings
        if (!empty($siblings)) {
            foreach ($siblings as $sibling) {
                if (!empty($sibling['first_name']) || !empty($sibling['last_name'])) {
                    \App\Models\SiblingDetail::create([
                        'username' => $user->username,
                        'first_name' => $sibling['first_name'] ?? null,
                        'middle_name' => $sibling['middle_name'] ?? null,
                        'last_name' => $sibling['last_name'] ?? null,
                        'date_of_birth' => $sibling['date_of_birth'] ?? null,
                        'citizenship' => $sibling['citizenship'] ?? null,
                        'dual_citizenship' => $sibling['dual_citizenship'] ?? null,
                        'complete_address' => $sibling['complete_address'] ?? null,
                        'occupation' => $sibling['occupation'] ?? null,
                        'employer' => $sibling['employer'] ?? null,
                        'employer_address' => $sibling['employer_address'] ?? null,
                    ]);
                }
            }
        }
        
        return $familyHistory->id;
    }

    /**
     * Update or create educational background for a user (elementary, highschool, college, postgrad).
     */
    public static function updateEducationalBackground($username, $educationData) {
        // Each level is an array of entries
        foreach (['elementary', 'highschool', 'college', 'postgrad'] as $level) {
            if (!empty($educationData[$level]) && is_array($educationData[$level])) {
                foreach ($educationData[$level] as $entry) {
                    if (!empty($entry['school'])) {
                        \App\Models\EducationDetail::updateOrCreate(
                            [
                                'username' => $username,
                                'educ_level' => $level,
                                'school_name' => $entry['school'],
                            ],
                            [
                                'school_addr' => $entry['address'] ?? null,
                                'period_from' => $entry['start'] ?? null,
                                'period_to' => $entry['end'] ?? null,
                                'degree' => $entry['course'] ?? null,
                                'year_graduated' => $entry['year_graduated'] ?? null,
                                'scholarship' => $entry['scholarship'] ?? null,
                                'highest_level' => $entry['year_level'] ?? null,
                            ]
                        );
                    }
                }
            }
        }
        // Optionally handle other_schools_training and civil_service_qualifications as free text fields
        if (!empty($educationData['other_schools_training'])) {
            \App\Models\EducationDetail::updateOrCreate(
                [
                    'username' => $username,
                    'educ_level' => 'other',
                    'school_name' => 'Other Schools/Training',
                ],
                [
                    'degree' => $educationData['other_schools_training'],
                ]
            );
        }
        if (!empty($educationData['civil_service_qualifications'])) {
            \App\Models\EducationDetail::updateOrCreate(
                [
                    'username' => $username,
                    'educ_level' => 'civil_service',
                    'school_name' => 'Civil Service/Qualifications',
                ],
                [
                    'degree' => $educationData['civil_service_qualifications'],
                ]
            );
        }
    }

    /**
     * Update or create military history for a user, including assignments, schools, and awards.
     */
    public static function updateMilitaryHistory($username, $militaryData, $assignments = [], $schools = [], $awards = []) {
        $militaryHistory = \App\Models\MilitaryHistoryDetail::updateOrCreate(
            ['username' => $username],
            $militaryData
        );
        $userId = $militaryHistory->user_id ?? null;
        // Handle assignments
        if (!empty($assignments)) {
            \App\Models\AssignmentDetail::where('assign_id', $militaryHistory->military_assign)->delete();
            foreach ($assignments as $assignment) {
                if (!empty($assignment['unit_office'])) {
                    \App\Models\AssignmentDetail::create(array_merge($assignment, [
                        'assign_id' => $militaryHistory->military_assign,
                    ]));
                }
            }
        }
        // Handle schools
        if (!empty($schools)) {
            \App\Models\MilitarySchoolDetail::where('username', $username)->delete();
            foreach ($schools as $school) {
                if (!empty($school['school'])) {
                    \App\Models\MilitarySchoolDetail::create(array_merge($school, [
                        'username' => $username,
                    ]));
                }
            }
        }
        // Handle awards
        if (!empty($awards)) {
            $schoolIds = \App\Models\MilitarySchoolDetail::where('username', $username)->pluck('history_id');
            \App\Models\AwardDetail::whereIn('history_id', $schoolIds)->delete();
            foreach ($awards as $award) {
                if (!empty($award['name'])) {
                    $school = \App\Models\MilitarySchoolDetail::where('username', $username)->first();
                    if (!$school) {
                        $school = \App\Models\MilitarySchoolDetail::create([
                            'username' => $username,
                            'date_attended' => null,
                        ]);
                    }
                    \App\Models\AwardDetail::create([
                        'history_id' => $school->history_id,
                        'decoration_award_or_commendation' => $award['name'],
                    ]);
                }
            }
        }
        return $militaryHistory->id;
    }

    /**
     * Update or create places of residence for a user using ResidenceHistoryDetail and AddressDetail.
     */
    public static function updatePlacesOfResidence($username, $residences = []) {
        // Remove all old residence history for this user
        \App\Models\ResidenceHistoryDetail::where('username', $username)->delete();
        foreach ($residences as $residence) {
            // Only save if at least one address field is present
            if (!empty($residence['region']) || !empty($residence['province']) || !empty($residence['city']) || !empty($residence['barangay']) || !empty($residence['street'])) {
                $address = \App\Models\AddressDetail::create([
                    'country' => $residence['country'] ?? 'Philippines',
                    'region' => $residence['region'] ?? null,
                    'province' => $residence['province'] ?? null,
                    'city' => $residence['city'] ?? null,
                    'barangay' => $residence['barangay'] ?? null,
                    'street' => $residence['street'] ?? null,
                    'zip_code' => $residence['zip_code'] ?? null,
                ]);
                // Create residence history detail
                \App\Models\ResidenceHistoryDetail::create([
                    'username' => $username,
                    'addr' => $address->addr_id,
                ]);
            }
        }
        return true;
    }

    /**
     * Update or create employment history for a user using EmploymentDetail and AddressDetail.
     */
    public static function updateEmploymentHistory($username, $employments = [], $dismissal = null) {
        // Remove all old employment details for this user
        \App\Models\EmploymentDetail::where('username', $username)->delete();
        foreach ($employments as $employment) {
            if (!empty($employment['employer_name'])) {
                // Create address detail for employer address
                $address = null;
                if (!empty($employment['employer_address'])) {
                    $address = \App\Models\AddressDetail::create([
                        'country' => null,
                        'region' => null,
                        'province' => null,
                        'city' => null,
                        'barangay' => null,
                        'street' => $employment['employer_address'],
                        'zip_code' => null,
                    ]);
                }
                // Build start and end date from month/year
                $start_date = null;
                if (!empty($employment['from_year'])) {
                    $start_date = $employment['from_year'] . '-' . (empty($employment['from_month']) ? '01' : $employment['from_month']) . '-01';
                }
                $end_date = null;
                if (!empty($employment['to_year'])) {
                    $end_date = $employment['to_year'] . '-' . (empty($employment['to_month']) ? '01' : $employment['to_month']) . '-01';
                }
                \App\Models\EmploymentDetail::create([
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'employ_type' => $employment['type'] ?? null,
                    'employer' => $employment['employer_name'],
                    'employ_addr' => $address ? $address->addr_id : null,
                    'reason_for_leaving' => $employment['reason_leaving'] ?? null,
                    'dismissal_desc' => $dismissal['dismissed_explanation'] ?? null,
                    'username' => $username,
                ]);
            }
        }
        return true;
    }

    /**
     * Update or create foreign countries visited for a user using ForeignVisitDetail and AddressDetail.
     */
    public static function updateForeignCountriesVisited($username, $countries = []) {
        // Remove all old foreign visit details for this user
        \App\Models\ForeignVisitDetail::where('username', $username)->delete();
        foreach ($countries as $country) {
            if (!empty($country['name'])) {
                // Create address detail for address abroad
                $address = null;
                if (!empty($country['address_abroad'])) {
                    $address = \App\Models\AddressDetail::create([
                        'country' => $country['name'],
                        'region' => null,
                        'province' => null,
                        'city' => null,
                        'barangay' => null,
                        'street' => $country['address_abroad'],
                        'zip_code' => null,
                    ]);
                }
                // Build visit_date from from_year/from_month (use first day of month)
                $visit_date = null;
                if (!empty($country['from_year'])) {
                    $visit_date = $country['from_year'] . '-' . (empty($country['from_month']) ? '01' : $country['from_month']) . '-01';
                }
                \App\Models\ForeignVisitDetail::create([
                    'visit_date' => $visit_date,
                    'visit_purpose' => $country['purpose'] ?? null,
                    'visit_addr' => $address ? $address->addr_id : null,
                    'username' => $username,
                ]);
            }
        }
        return true;
    }

    /**
     * Update or create credit reputation for a user using CreditDetail and CreditReferenceDetail.
     */
    public static function updateCreditReputation($username, $creditData = [], $references = []) {
        // Yes/No logic: if field has value, it's yes; if null, it's no
        $other_income_src = null;
        if (!empty($creditData['other_incomes'])) {
            $other_income_src = json_encode(array_filter(array_column($creditData['other_incomes'], 'source')));
        }
        $saln_detail = null;
        if (!empty($creditData['assets_liabilities_agency']) || !empty($creditData['assets_liabilities_month']) || !empty($creditData['assets_liabilities_year'])) {
            $saln_detail = json_encode([
                'agency' => $creditData['assets_liabilities_agency'] ?? null,
                'month' => $creditData['assets_liabilities_month'] ?? null,
                'year' => $creditData['assets_liabilities_year'] ?? null,
            ]);
        }
        $amount_paid = null;
        if (!empty($creditData['itr_amount'])) {
            $amount_paid = $creditData['itr_amount'];
        }
        // Save/update CreditDetail
        \App\Models\CreditDetail::updateOrCreate(
            ['username' => $username],
            [
                'other_income_src' => $other_income_src,
                'saln_detail' => $saln_detail,
                'amount_paid' => $amount_paid,
            ]
        );
        // Save/update CreditReferenceDetail (clear old, add new)
        \App\Models\CreditReferenceDetail::where('username', $username)->delete();
        foreach ($references as $ref) {
            if (!empty($ref['bank_name'])) {
                // Find or create address for the bank
                $address = null;
                if (!empty($ref['bank_address'])) {
                    $address = \App\Models\AddressDetail::firstOrCreate([
                        'street' => $ref['bank_address'],
                    ]);
                }
                // Find or create the bank by name and address
                $bank = \App\Models\BankDetail::firstOrCreate([
                    'bank' => $ref['bank_name'],
                    'bank_addr' => $address ? $address->addr_id : null,
                ]);
                \App\Models\CreditReferenceDetail::create([
                    'bank' => $bank->bank_id,
                    'username' => $username,
                ]);
            }
        }
        return true;
    }

    /**
     * Update or create arrest record and conduct for a user using ArrestRecordDetail and ArrestDetail.
     */
    public static function updateArrestRecord($username, $arrestData = []) {
        // Helper to create ArrestDetail if details are provided
        $createArrestDetail = function($details) {
            if (!empty($details)) {
                // Parse details into fields if needed, else store all in disposition_of_case
                return \App\Models\ArrestDetail::create([
                    'court_name' => null,
                    'nature_of_offense' => null,
                    'disposition_of_case' => $details,
                ])->arrest_detail_id;
            }
            return null;
        };
        $arr_desc = ($arrestData['investigated_arrested'] === 'yes') ? $createArrestDetail($arrestData['investigated_arrested_details'] ?? null) : null;
        $fam_arr_desc = ($arrestData['family_investigated_arrested'] === 'yes') ? $createArrestDetail($arrestData['family_investigated_arrested_details'] ?? null) : null;
        $admin_case_desc = ($arrestData['administrative_case'] === 'yes') ? ($arrestData['administrative_case_details'] ?? null) : null;
        $violation_desc = ($arrestData['pd1081_arrested'] === 'yes') ? $createArrestDetail($arrestData['pd1081_arrested_details'] ?? null) : null;
        $extent_of_intoxication = ($arrestData['intoxicating_liquor_narcotics'] === 'yes') ? ($arrestData['intoxicating_liquor_narcotics_details'] ?? null) : null;
        // Save/update ArrestRecordDetail
        \App\Models\ArrestRecordDetail::updateOrCreate(
            ['username' => $username],
            [
                'arr_desc' => $arr_desc,
                'fam_arr_desc' => $fam_arr_desc,
                'admin_case_desc' => $admin_case_desc,
                'violation_desc' => $violation_desc,
                'extent_of_intoxication' => $extent_of_intoxication,
            ]
        );
        return true;
    }

    /**
     * Save all arrest record and conduct for a user using the above helper.
     */
    public static function saveArrestRecord($data, $username) {
        $arrestData = $data['arrest'] ?? [];
        return self::updateArrestRecord($username, $arrestData);
    }

    /**
     * Save all personal details for a user using the above helpers.
     */
    public static function savePersonalDetails($data, $username) {
        // Name
        $nameId = self::updateNameDetail($username, $data['name'] ?? []);
        // Addresses
        $birthAddrId = self::updateAddressDetail($data['birth_address'] ?? []);
        $homeAddrId = self::updateAddressDetail($data['home_address'] ?? []);
        $businessAddrId = self::updateAddressDetail($data['business_address'] ?? []);
        // UserDetail
        $userDetailData = [
            'full_name' => $nameId,
            'profile_path' => $data['profile_path'] ?? null,
            'home_addr' => $homeAddrId,
            'birth_date' => $data['birth_date'] ?? null,
            'birth_place' => $birthAddrId,
            'nationality' => $data['nationality'] ?? null,
            'religion' => $data['religion'] ?? null,
            'mobile_num' => $data['mobile'] ?? null,
            'email_addr' => $data['email'] ?? null,
        ];
        self::updateUserDetail($username, $userDetailData);
        // PersonalDetail
        self::updatePersonalDetail($username, $data['personal'] ?? []);
        // JobDetail
        if (!empty($data['job'])) {
            self::updateJobDetail($username, $data['job']);
        }
        // Government ID
        if (!empty($data['gov_id'])) {
            self::updateGovIdDetail($username, $data['gov_id']);
        }
        // Character References
        if (!empty($data['character_references'])) {
            self::updateCharacterReferences($username, $data['character_references']);
        }
        // Neighbor References
        if (!empty($data['neighbor_references'])) {
            self::updateNeighbors($username, $data['neighbor_references']);
        }
        // Add more as needed for other sections
    }

    /**
     * Save all personal characteristics for a user using the above helper.
     */
    public static function savePersonalCharacteristics($data, $username) {
        self::updatePersonalCharacteristics($username, $data);
    }

    /**
     * Save all marital status data for a user using the above helper.
     */
    public static function saveMaritalStatus($data, $username) {
        $children = $data['children'] ?? [];
        unset($data['children']);
        self::updateMaritalStatus($username, $data, $children);
    }

    /**
     * Save all family background data for a user using the above helper.
     */
    public static function saveFamilyBackground($data, $userId) {
        $familyMembers = $data['family_members'] ?? [];
        $siblings = $data['siblings'] ?? [];
        unset($data['family_members'], $data['siblings']);
        self::updateFamilyBackground($userId, $data, $familyMembers, $siblings);
    }

    /**
     * Save all educational background data for a user using the above helper.
     */
    public static function saveEducationalBackground($data, $username) {
        self::updateEducationalBackground($username, $data);
    }

    /**
     * Save all military history for a user using the above helper.
     */
    public static function saveMilitaryHistory($data, $username) {
        $militaryData = $data['military'] ?? [];
        $assignments = $data['assignments'] ?? [];
        $schools = $data['schools'] ?? [];
        $awards = $data['awards'] ?? [];
        return self::updateMilitaryHistory($username, $militaryData, $assignments, $schools, $awards);
    }

    /**
     * Save all places of residence for a user using the above helper.
     */
    public static function savePlacesOfResidence($data, $username) {
        $residences = $data['residences'] ?? [];
        return self::updatePlacesOfResidence($username, $residences);
    }

    /**
     * Save all employment history for a user using the above helper.
     */
    public static function saveEmploymentHistory($data, $username) {
        $employments = $data['employment'] ?? [];
        $dismissal = [
            'dismissed' => $data['dismissed'] ?? null,
            'dismissed_explanation' => $data['dismissed_explanation'] ?? null,
        ];
        return self::updateEmploymentHistory($username, $employments, $dismissal);
    }

    /**
     * Save all foreign countries visited for a user using the above helper.
     */
    public static function saveForeignCountriesVisited($data, $username) {
        $countries = $data['countries'] ?? [];
        return self::updateForeignCountriesVisited($username, $countries);
    }

    /**
     * Save all credit reputation for a user using the above helper.
     */
    public static function saveCreditReputation($data, $username) {
        $creditData = $data['credit'] ?? [];
        $references = $data['references'] ?? [];
        return self::updateCreditReputation($username, $creditData, $references);
    }

    /**
     * Save all character and reputation data for a user using the above helpers.
     */
    public static function saveCharacterReputation($data, $username) {
        $characterReferences = $data['character_references'] ?? [];
        $neighbors = $data['neighbors'] ?? [];
        self::updateCharacterReferences($username, $characterReferences);
        self::updateNeighbors($username, $neighbors);
    }

    /**
     * Save miscellaneous (hobbies, lie detection, languages) for a user.
     * @param array $data
     * @param string $username
     */
    public static function saveMiscellaneous($data, $username) {
        // Save hobbies and lie detection to personal_details
        $personalFields = [];
        if (isset($data['hobbies_sports_pastimes'])) {
            $personalFields['hobbies'] = $data['hobbies_sports_pastimes'];
        }
        if (isset($data['lie_detection_test'])) {
            $personalFields['undergo_lie_detection'] = $data['lie_detection_test'];
        }
        if (!empty($personalFields)) {
            \App\Models\PersonalDetail::updateOrCreate(
                ['username' => $username],
                $personalFields
            );
        }
        // Save languages/dialects to fluency_details
        if (!empty($data['languages']) && is_array($data['languages'])) {
            foreach ($data['languages'] as $lang) {
                if (!empty($lang['language'])) {
                    // Check if language exists, else create
                    $language = \App\Models\LanguageDetail::where('lang_desc', $lang['language'])->first();
                    if (!$language) {
                        $language = \App\Models\LanguageDetail::create([
                            'lang_desc' => $lang['language']
                        ]);
                    }
                    // Use lang_id for fluency detail
                    \App\Models\FluencyDetail::updateOrCreate(
                        [
                            'username' => $username,
                            'lang' => $language->lang_id
                        ],
                        [
                            'speak_fluency' => $lang['speak'] ?? null,
                            'read_fluency' => $lang['read'] ?? null,
                            'write_fluency' => $lang['write'] ?? null
                        ]
                    );
                }
            }
        }
    }

    /**
     * Save all organization memberships for a user.
     * @param array $organizations
     * @param string $username
     */
    public static function saveOrganizationMemberships($organizations, $username) {
        foreach ($organizations as $organization) {
            if (!empty($organization['name'])) {
                // Save address in the region field only
                $addressId = null;
                if (!empty($organization['address'])) {
                    $address = \App\Models\AddressDetail::firstOrCreate([
                        'country' => 'Philippines',
                        'region' => $organization['address'],
                        'province' => null,
                        'city' => null,
                        'barangay' => null,
                        'street' => null,
                        'zip_code' => null,
                    ]);
                    $addressId = $address->addr_id;
                }

                // Create or update organization
                $org = \App\Models\OrganizationDetail::firstOrCreate(
                    [
                        'org_name' => $organization['name']
                    ],
                    [
                        'org_addr' => $addressId
                    ]
                );

                // Prepare membership data
                $membershipData = [
                    'org' => $org->org_id,
                    'position' => $organization['position'] ?? null,
                ];
                // Handle date of membership using month/year
                if (!empty($organization['month']) && !empty($organization['year'])) {
                    $membershipData['mem_date'] = $organization['year'] . '-' . $organization['month'] . '-01';
                }

                // Create or update membership details
                \App\Models\MembershipDetail::updateOrCreate(
                    [
                        'username' => $username,
                        'org' => $org->org_id
                    ],
                    $membershipData
                );
            }
        }
    }

    /**
     * Save all military history for a user using normalized data (dates as month/year, etc.).
     */
    public static function saveMilitaryHistoryNormalized($data, $username) {
        // Save main military history
        $militaryData = [
            'username' => $username,
            'enlist_date' => self::parseMonthYear($data['enlistment_month'] ?? null, $data['enlistment_year'] ?? null),
            'comm_src' => $data['commission_source'] ?? null,
            'start_comm' => self::parseMonthYear($data['commission_date_from_month'] ?? null, $data['commission_date_from_year'] ?? null),
            'end_comm' => self::parseMonthYear($data['commission_date_to_month'] ?? null, $data['commission_date_to_year'] ?? null),
        ];
        $militaryHistory = \App\Models\MilitaryHistoryDetail::updateOrCreate(
            ['username' => $username],
            $militaryData
        );
        // Save assignments
        \App\Models\AssignmentDetail::where('username', $username)->delete();
        if (!empty($data['assignments']) && is_array($data['assignments'])) {
            foreach ($data['assignments'] as $assignment) {
                if (!empty($assignment['unit_office'])) {
                    \App\Models\AssignmentDetail::create([
                        'username' => $username,
                        'start_date' => self::parseMonthYear($assignment['from_month'] ?? null, $assignment['from_year'] ?? null),
                        'end_date' => self::parseMonthYear($assignment['to_month'] ?? null, $assignment['to_year'] ?? null),
                        'assign_unit' => $assignment['unit_office'],
                        'assign_chief' => $assignment['co_chief'] ?? null,
                    ]);
                }
            }
        }
        // Save schools
        \App\Models\MilitarySchoolDetail::where('username', $username)->delete();
        if (!empty($data['schools']) && is_array($data['schools'])) {
            foreach ($data['schools'] as $school) {
                if (!empty($school['school'])) {
                    \App\Models\MilitarySchoolDetail::create([
                        'username' => $username,
                        'school' => $school['school'],
                        'attend_date' => self::parseMonthYear($school['date_attended_from_month'] ?? null, $school['date_attended_from_year'] ?? null),
                        'train_nature' => $school['nature_training'] ?? null,
                        'rating' => $school['rating'] ?? null,
                    ]);
                }
            }
        }
        return true;
    }

    /**
     * Helper to parse month/year to Y-m-d (first day of month), or null if missing.
     */
    public static function parseMonthYear($month, $year) {
        if ($year && $month) {
            return sprintf('%04d-%02d-01', $year, $month);
        } elseif ($year) {
            return sprintf('%04d-01-01', $year);
        }
        return null;
    }
}
