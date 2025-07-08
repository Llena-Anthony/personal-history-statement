<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CitizenshipDetail;
use App\Models\LanguageDetail;
use App\Models\AddressDetail;
use App\Models\NameDetail;
use App\Models\SchoolDetail;
use App\Models\OrganizationDetail;
use App\Models\OccupationDetail;

class LookupDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Citizenship Details
        $citizenships = [
            ['cit_description' => 'Filipino'],
            ['cit_description' => 'American'],
            ['cit_description' => 'Chinese'],
            ['cit_description' => 'Japanese'],
            ['cit_description' => 'Korean'],
            ['cit_description' => 'British'],
            ['cit_description' => 'Canadian'],
            ['cit_description' => 'Australian'],
        ];

        foreach ($citizenships as $citizenship) {
            CitizenshipDetail::firstOrCreate($citizenship);
        }

        // Seed Language Details
        $languages = [
            ['lang_desc' => 'English'],
            ['lang_desc' => 'Filipino/Tagalog'],
            ['lang_desc' => 'Cebuano'],
            ['lang_desc' => 'Ilocano'],
            ['lang_desc' => 'Spanish'],
            ['lang_desc' => 'Chinese (Mandarin)'],
            ['lang_desc' => 'Chinese (Cantonese)'],
            ['lang_desc' => 'Japanese'],
            ['lang_desc' => 'Korean'],
        ];

        foreach ($languages as $language) {
            LanguageDetail::firstOrCreate($language);
        }

        // Seed Address Details for common locations
        $addresses = [
            [
                'country' => 'Philippines',
                'region' => 'National Capital Region',
                'province' => 'Metro Manila',
                'city' => 'Quezon City',
                'barangay' => 'Diliman',
                'street' => 'Commonwealth Avenue',
                'zip_code' => '1101',
            ],
            [
                'country' => 'Philippines',
                'region' => 'National Capital Region',
                'province' => 'Metro Manila',
                'city' => 'Manila',
                'barangay' => 'Intramuros',
                'street' => 'General Luna Street',
                'zip_code' => '1002',
            ],
            [
                'country' => 'Philippines',
                'region' => 'Cordillera Administrative Region',
                'province' => 'Benguet',
                'city' => 'Baguio City',
                'barangay' => 'Central Business District',
                'street' => 'Session Road',
                'zip_code' => '2600',
            ],
        ];

        foreach ($addresses as $address) {
            AddressDetail::firstOrCreate($address);
        }

        // Seed School Details
        $schools = [
            [
                'school_name' => 'Philippine Military Academy',
                'school_addr' => 3, // Reference to Baguio City address
            ],
            [
                'school_name' => 'University of the Philippines',
                'school_addr' => 1, // Reference to Quezon City address
            ],
            [
                'school_name' => 'Ateneo de Manila University',
                'school_addr' => 1, // Reference to Quezon City address
            ],
        ];

        foreach ($schools as $school) {
            SchoolDetail::firstOrCreate($school);
        }

        // Seed Organization Details
        $organizations = [
            [
                'org_name' => 'Philippine Army',
                'org_addr' => 1, // Reference to Quezon City address
            ],
            [
                'org_name' => 'Philippine Navy',
                'org_addr' => 2, // Reference to Manila address
            ],
            [
                'org_name' => 'Philippine Air Force',
                'org_addr' => 1, // Reference to Quezon City address
            ],
        ];

        foreach ($organizations as $organization) {
            OrganizationDetail::firstOrCreate($organization);
        }

        // Seed Occupation Details
        $occupations = [
            [
                'occupation_desc' => 'Military Officer',
                'employer' => 'Armed Forces of the Philippines',
                'occupation_addr' => 1, // Reference to Quezon City address
            ],
            [
                'occupation_desc' => 'Civil Engineer',
                'employer' => 'Department of Public Works and Highways',
                'occupation_addr' => 1, // Reference to Quezon City address
            ],
            [
                'occupation_desc' => 'Teacher',
                'employer' => 'Department of Education',
                'occupation_addr' => 1, // Reference to Quezon City address
            ],
        ];

        foreach ($occupations as $occupation) {
            OccupationDetail::firstOrCreate($occupation);
        }
    }
}
