<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Check if dummy user already exists
        $existingUser = DB::table('users')->where('username', 'dummyuser')->first();
        
        if (!$existingUser) {
            // Create a dummy user
            $userId = DB::table('users')->insertGetId([
                'username' => 'dummyuser',
                'name' => 'John Smith Doe Jr.',
                'password' => Hash::make('dummy123'),
                'usertype' => 'client',
                'organic_role' => 'applicant',
                'branch' => 'main',
                'created_by' => 'system',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $userId = $existingUser->id;
        }

        // ===== SECTION I: PERSONAL DETAILS =====
        
        // Check if PHS record already exists for this user
        $existingPHS = DB::table('p_h_s')->where('user_id', $userId)->first();
        
        if (!$existingPHS) {
            // Create name_details record for the user
            $nameId = DB::table('name_details')->insertGetId([
                'first_name' => 'John',
                'last_name' => 'Doe',
                'middle_name' => 'Smith',
                'nickname' => 'Johnny',
                'name_extension' => 'Jr.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create PHS record (Section I: Personal Details)
            DB::table('p_h_s')->insert([
                'user_id' => $userId,
                'name_id' => $nameId,
                'suffix' => 'Jr.',
                'date_of_birth' => '1990-05-15',
                'place_of_birth' => 'Manila, Philippines',
                'gender' => 'Male',
                'civil_status' => 'Married',
                'height' => 1.75,
                'weight' => 70,
                'blood_type' => 'O+',
                'gsis_id' => '1234567890',
                'philhealth_no' => '1234-5678-9012',
                'tin_no' => '123-456-789-000',
                'pagibig_id' => '1234-5678-9012',
                'sss_no' => '34-5678901-2',
                'agency_employee_no' => 'EMP-2024-001',
                'citizenship' => 'Filipino',
                'dual_citizenship_by_birth' => false,
                'dual_citizenship_by_naturalization' => false,
                'dual_citizenship_country' => null,
                'residential_house_no' => '123',
                'residential_street' => 'Main Street',
                'residential_subdivision' => 'Green Meadows',
                'residential_barangay' => 'Barangay 1',
                'residential_city' => 'Quezon City',
                'residential_province' => 'Metro Manila',
                'residential_zip' => '1100',
                'permanent_house_no' => '456',
                'permanent_street' => 'Oak Avenue',
                'permanent_subdivision' => 'Sunset Hills',
                'permanent_barangay' => 'Barangay 2',
                'permanent_city' => 'Makati',
                'permanent_province' => 'Metro Manila',
                'permanent_zip' => '1200',
                'telephone' => '02-1234-5678',
                'mobile' => '09171234567',
                'email' => 'john.doe@example.com',
                'rank' => 'Lieutenant',
                'afpsn' => 'AFPSN-2024-001',
                'branch_of_service' => 'Army',
                'present_job' => 'Infantry Officer',
                'religion' => 'Roman Catholic',
                'home_address' => '123 Main Street, Green Meadows, Barangay 1, Quezon City, Metro Manila 1100',
                'business_address' => '456 Oak Avenue, Sunset Hills, Barangay 2, Makati, Metro Manila 1200',
                'change_in_name' => null,
                'nickname' => 'Johnny',
                'passport_number' => 'P1234567',
                'passport_expiry' => '2030-05-15',
                'nationality' => 'Filipino',
                'home_region' => 'NCR',
                'home_province' => 'Metro Manila',
                'home_city' => 'Quezon City',
                'home_barangay' => 'Barangay 1',
                'home_street' => 'Main Street',
                'home_complete_address' => '123 Main Street, Green Meadows, Barangay 1, Quezon City, Metro Manila 1100',
                'business_region' => 'NCR',
                'business_province' => 'Metro Manila',
                'business_city' => 'Makati',
                'business_barangay' => 'Barangay 2',
                'business_street' => 'Oak Avenue',
                'business_complete_address' => '456 Oak Avenue, Sunset Hills, Barangay 2, Makati, Metro Manila 1200',
                'home_region_name' => 'National Capital Region',
                'home_province_name' => 'Metro Manila',
                'home_city_name' => 'Quezon City',
                'home_barangay_name' => 'Barangay 1',
                'business_region_name' => 'National Capital Region',
                'business_province_name' => 'Metro Manila',
                'business_city_name' => 'Makati',
                'business_barangay_name' => 'Barangay 2',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ===== SECTION II: PERSONAL CHARACTERISTICS =====
        
        // Check if personal characteristics already exist for this user
        $existingCharacteristics = DB::table('personal_characteristics')->where('user_id', $userId)->first();
        
        if (!$existingCharacteristics) {
            // Create personal characteristics record (Section II: Personal Characteristics)
            DB::table('personal_characteristics')->insert([
                'user_id' => $userId,
                'sex' => 'male',
                'age' => 34,
                'height' => 1.75,
                'weight' => 70,
                'body_build' => 'Medium',
                'complexion' => 'Fair',
                'blood_type' => 'O+',
                'hair_color' => 'Black',
                'eye_color' => 'Brown',
                'distinguishing_features' => 'Small scar on left eyebrow',
                'health_status' => 'Excellent',
                'recent_illness' => 'None',
                'shoe_size' => 9.5,
                'cap_size' => 'M',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ===== SECTION III: MARITAL STATUS =====
        
        // Check if marital status already exists for this user
        $existingMaritalStatus = DB::table('marital_statuses')->where('user_id', $userId)->first();
        
        if (!$existingMaritalStatus) {
            // Create a dummy marital status
            $maritalStatusId = DB::table('marital_statuses')->insertGetId([
                'user_id' => $userId,
                'marital_status' => 'Married',
                'spouse_first_name' => 'Jane',
                'spouse_middle_name' => 'Q',
                'spouse_last_name' => 'Doe',
                'spouse_suffix' => null,
                'marriage_date' => '2010-05-15',
                'marriage_date_type' => 'exact',
                'marriage_month' => null,
                'marriage_year' => null,
                'marriage_place' => 'Manila',
                'spouse_birth_date' => '1988-07-20',
                'spouse_birth_place' => 'Cebu',
                'spouse_occupation' => 'Engineer',
                'spouse_employer' => 'Tech Corp',
                'spouse_employment_place' => 'Makati',
                'spouse_contact' => '09171234567',
                'spouse_citizenship' => 'Filipino',
                'spouse_other_citizenship' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $maritalStatusId = $existingMaritalStatus->id;
        }

        // Check if children already exist for this marital status
        $existingChildren = DB::table('children')->where('marital_status_id', $maritalStatusId)->count();
        
        if ($existingChildren == 0) {
            // Create dummy children for this marital status
            foreach ([
                ['first_name' => 'Anna', 'last_name' => 'Doe', 'birth_date' => '2012-03-10', 'citizenship' => 'Filipino', 'address' => 'Quezon City', 'father_name' => 'John Doe', 'mother_name' => 'Jane Q Doe'],
                ['first_name' => 'Ben', 'last_name' => 'Doe', 'birth_date' => '2015-08-22', 'citizenship' => 'Filipino', 'address' => 'Quezon City', 'father_name' => 'John Doe', 'mother_name' => 'Jane Q Doe'],
            ] as $child) {
                // Create name_details record for the child
                $childNameId = DB::table('name_details')->insertGetId([
                    'first_name' => $child['first_name'],
                    'last_name' => $child['last_name'],
                    'middle_name' => null,
                    'nickname' => null,
                    'name_extension' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('children')->insert([
                    'marital_status_id' => $maritalStatusId,
                    'name_id' => $childNameId,
                    'birth_date' => $child['birth_date'],
                    'citizenship' => $child['citizenship'],
                    'address' => $child['address'],
                    'father_name' => $child['father_name'],
                    'mother_name' => $child['mother_name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Dummy data for PHS Sections I, II, and III created successfully!');
        $this->command->info('Username: dummyuser, Password: dummy123');
    }
} 