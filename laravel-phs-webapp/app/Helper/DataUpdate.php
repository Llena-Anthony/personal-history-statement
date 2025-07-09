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
                ReferenceDetail::create([
                    'username' => $username,
                    'ref_type' => 'character',
                    'ref_name' => $reference['name'] ?? '',
                    'ref_address' => $reference['address'] ?? '',
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
                ReferenceDetail::create([
                    'username' => $username,
                    'ref_type' => 'neighbor',
                    'ref_name' => $neighbor['name'] ?? '',
                    'ref_address' => $neighbor['address'] ?? '',
                ]);
            }
        }
    }

    /**
     * Update or create organization memberships for a user.
     */
    public static function updateOrganizations($username, $organizations) {
        foreach ($organizations as $organization) {
            if (!empty($organization['name'])) {
                // Create or update address details if address is provided
                $addressId = null;
                if (!empty($organization['address'])) {
                    $address = \App\Models\AddressDetails::updateOrCreate(
                        [
                            'street' => $organization['address'],
                            'country' => 'Philippines'
                        ],
                        [
                            'barangay' => '',
                            'municipality' => '',
                            'province' => '',
                            'city' => '',
                            'zip_code' => ''
                        ]
                    );
                    $addressId = $address->addr_id;
                }
                // Create or update organization
                $org = \App\Models\Organization::updateOrCreate(
                    [
                        'org_name' => $organization['name']
                    ],
                    [
                        'org_type' => 'membership',
                        'org_address' => $addressId
                    ]
                );
                // Create or update membership details
                $membershipData = [
                    'username' => $username,
                    'org_id' => $org->org_id,
                    'membership_type' => 'member',
                    'position_held' => $organization['position'] ?? null,
                ];
                if (!empty($organization['month']) && !empty($organization['year'])) {
                    $membershipData['date_joined'] = $organization['year'] . '-' . $organization['month'] . '-01';
                }
                \App\Models\MembershipDetail::updateOrCreate(
                    [
                        'username' => $username,
                        'org_id' => $org->org_id
                    ],
                    $membershipData
                );
            }
        }
    }

    /**
     * Update or create miscellaneous info for a user.
     */
    public static function updateMiscellaneous($username, $data) {
        $languagesData = '';
        if (isset($data['languages'])) {
            $languagesArray = [];
            foreach ($data['languages'] as $language) {
                if (!empty($language['language'])) {
                    $languagesArray[] = [
                        'language' => $language['language'],
                        'speak' => $language['speak'] ?? '',
                        'read' => $language['read'] ?? '',
                        'write' => $language['write'] ?? ''
                    ];
                }
            }
            $languagesData = json_encode($languagesArray);
        }
        \App\Models\Miscellaneous::updateOrCreate(
            ['user_id' => $username, 'misc_type' => 'general-miscellaneous'],
            [
                'hobbies_sports_pastimes' => $data['hobbies_sports_pastimes'] ?? '',
                'languages_dialects' => $languagesData,
                'lie_detection_test' => $data['lie_detection_test'] ?? null,
            ]
        );
    }

    /**
     * Save or update all family background data (family members and siblings) for a user.
     * Trims all string fields and normalizes data to correct tables.
     *
     * @param string $username
     * @param array $data (validated form data)
     */
    public static function saveOrUpdateFamilyBackground($username, $data)
    {
        // Helper to trim all strings in an array recursively
        $trim_recursive = function ($value) use (&$trim_recursive) {
            if (is_array($value)) {
                return array_map($trim_recursive, $value);
            } elseif (is_string($value)) {
                return trim($value);
            }
            return $value;
        };
        $data = $trim_recursive($data);

        // --- Family Members ---
        $roles = [
            'father', 'mother', 'guardian', 'father_in_law', 'mother_in_law'
        ];
        $famHistory = \App\Models\FamilyHistoryDetail::firstOrCreate(['username' => $username]);
        foreach ($roles as $role) {
            $prefix = $role;
            $first = $data[$prefix . '_first_name'] ?? null;
            $last = $data[$prefix . '_last_name'] ?? null;
            if ($first || $last) {
                // NameDetail
                $name = \App\Models\NameDetail::firstOrCreate([
                    'first_name' => $first ?? '',
                    'last_name' => $last ?? '',
                    'middle_name' => $data[$prefix . '_middle_name'] ?? '',
                    'suffix' => $data[$prefix . '_suffix'] ?? '',
                ]);
                // AddressDetail (birth_place)
                $birthPlaceId = null;
                if (!empty($data[$prefix . '_birth_place'])) {
                    $birthPlace = \App\Models\AddressDetail::firstOrCreate([
                        'street' => $data[$prefix . '_birth_place'],
                        'country' => 'Philippines',
                    ]);
                    $birthPlaceId = $birthPlace->addr_id;
                }
                // AddressDetail (complete_address)
                $addrId = null;
                if (!empty($data[$prefix . '_complete_address'])) {
                    $addr = \App\Models\AddressDetail::firstOrCreate([
                        'street' => $data[$prefix . '_complete_address'],
                        'country' => 'Philippines',
                    ]);
                    $addrId = $addr->addr_id;
                }
                // OccupationDetail
                $occupationId = null;
                if (!empty($data[$prefix . '_occupation'])) {
                    $occupation = \App\Models\OccupationDetail::firstOrCreate([
                        'occupation_desc' => $data[$prefix . '_occupation'],
                        'employer' => $data[$prefix . '_employer'] ?? '',
                    ]);
                    $occupationId = $occupation->occupation_id;
                }
                // CitizenshipDetail
                $citizenshipId = null;
                if (!empty($data[$prefix . '_citizenship'])) {
                    $cit = \App\Models\CitizenshipDetail::firstOrCreate([
                        'cit_description' => $data[$prefix . '_citizenship'],
                    ]);
                    $citizenshipId = $cit->cit_id;
                }
                // Dual CitizenshipDetail
                $dualId = null;
                if (!empty($data[$prefix . '_dual_citizenship'])) {
                    $dual = \App\Models\CitizenshipDetail::firstOrCreate([
                        'cit_description' => $data[$prefix . '_dual_citizenship'],
                    ]);
                    $dualId = $dual->cit_id;
                }
                // Place Naturalized
                $placeNaturalizedId = null;
                if (!empty($data[$prefix . '_place_naturalized'])) {
                    $placeNat = \App\Models\AddressDetail::firstOrCreate([
                        'street' => $data[$prefix . '_place_naturalized'],
                        'country' => 'Philippines',
                    ]);
                    $placeNaturalizedId = $placeNat->addr_id;
                }
                // FamilyDetail
                $familyDetail = \App\Models\FamilyDetail::updateOrCreate(
                    [
                        'fam_name' => $name->name_id,
                        'birth_date' => $data[$prefix . '_birth_date'] ?? null,
                    ],
                    [
                        'birth_place' => $birthPlaceId,
                        'fam_addr' => $addrId,
                        'occupation' => $occupationId,
                        'citizenship' => $citizenshipId,
                        'dual' => $dualId,
                        'date_naturalized' => $data[$prefix . '_date_naturalized'] ?? null,
                        'place_naturalized' => $placeNaturalizedId,
                    ]
                );
                // Update FamilyHistoryDetail
                $famHistory->{$role} = $familyDetail->fam_id;
            } else {
                // If no name, clear the role
                $famHistory->{$role} = null;
            }
        }
        $famHistory->save();

        // --- Siblings ---
        \App\Models\SiblingDetail::where('username', $username)->delete();
        if (!empty($data['siblings']) && is_array($data['siblings'])) {
            foreach ($data['siblings'] as $sibling) {
                $sibling = $trim_recursive($sibling);
                $name = null;
                if (!empty($sibling['first_name']) || !empty($sibling['last_name'])) {
                    $name = \App\Models\NameDetail::firstOrCreate([
                        'first_name' => $sibling['first_name'] ?? '',
                        'last_name' => $sibling['last_name'] ?? '',
                        'middle_name' => $sibling['middle_name'] ?? '',
                        'suffix' => $sibling['suffix'] ?? '',
                    ]);
                }
                $addressId = null;
                if (!empty($sibling['complete_address'])) {
                    $address = \App\Models\AddressDetail::firstOrCreate([
                        'street' => $sibling['complete_address'],
                        'country' => 'Philippines',
                    ]);
                    $addressId = $address->addr_id;
                }
                $occupationId = null;
                if (!empty($sibling['occupation'])) {
                    $occupation = \App\Models\OccupationDetail::firstOrCreate([
                        'occupation_desc' => $sibling['occupation'],
                        'employer' => $sibling['employer'] ?? '',
                    ]);
                    $occupationId = $occupation->occupation_id;
                }
                $citizenshipId = null;
                if (!empty($sibling['citizenship'])) {
                    $cit = \App\Models\CitizenshipDetail::firstOrCreate([
                        'cit_description' => $sibling['citizenship'],
                    ]);
                    $citizenshipId = $cit->cit_id;
                }
                $dualId = null;
                if (!empty($sibling['dual_citizenship'])) {
                    $dual = \App\Models\CitizenshipDetail::firstOrCreate([
                        'cit_description' => $sibling['dual_citizenship'],
                    ]);
                    $dualId = $dual->cit_id;
                }
                $familyDetail = \App\Models\FamilyDetail::create([
                    'fam_name' => $name ? $name->name_id : null,
                    'birth_date' => $sibling['date_of_birth'] ?? null,
                    'fam_addr' => $addressId,
                    'occupation' => $occupationId,
                    'citizenship' => $citizenshipId,
                    'dual' => $dualId,
                ]);
                \App\Models\SiblingDetail::create([
                    'sib_detail' => $familyDetail->fam_id,
                    'username' => $username,
                ]);
            }
        }
    }

    /**
     * Save or update all education details for a user, including special records for other_training and civil_service.
     * @param string $username
     * @param array $data (validated form data)
     */
    public static function saveOrUpdateEducationDetails($username, $data)
    {
        // Helper to trim all strings in an array recursively
        $trim_recursive = function ($value) use (&$trim_recursive) {
            if (is_array($value)) {
                return array_map($trim_recursive, $value);
            } elseif (is_string($value)) {
                return trim($value);
            }
            return $value;
        };
        $data = $trim_recursive($data);

        // Remove all previous education details for this user
        \App\Models\EducationDetail::where('username', $username)->delete();

        // Helper to create/find address
        $getAddressId = function($addressString) {
            if (!$addressString) return null;
            return \App\Models\AddressDetail::firstOrCreate([
                'street' => $addressString,
                'country' => 'Philippines',
            ])->addr_id;
        };

        // Helper to create/find school
        $getSchoolId = function($schoolName, $addressString) use ($getAddressId) {
            if (!$schoolName) return null;
            $addrId = $getAddressId($addressString);
            return \App\Models\SchoolDetail::firstOrCreate([
                'school_name' => $schoolName,
                'school_addr' => $addrId,
            ])->school_id;
        };

        // Save each entry for each level
        $levels = ['elementary', 'highschool', 'college', 'postgraduate'];
        foreach ($levels as $level) {
            if (!empty($data[$level]) && is_array($data[$level])) {
                foreach ($data[$level] as $entry) {
                    $entry = $trim_recursive($entry);
                    $schoolId = $getSchoolId($entry['school'] ?? null, $entry['address'] ?? null);
                    \App\Models\EducationDetail::create([
                        'school' => $schoolId,
                        'educ_level' => $level,
                        'attend_date' => $entry['start'] ?? null,
                        'year_grad' => $entry['graduate'] ?? null,
                        'username' => $username,
                    ]);
                }
            }
        }

        // Save special records
        if (!empty($data['other_schools_training'])) {
            \App\Models\EducationDetail::create([
                'educ_level' => 'other_training',
                'other_training' => $data['other_schools_training'],
                'username' => $username,
            ]);
        }
        if (!empty($data['civil_service_qualifications'])) {
            \App\Models\EducationDetail::create([
                'educ_level' => 'civil_service',
                'civil_service' => $data['civil_service_qualifications'],
                'username' => $username,
            ]);
        }
    }
}
