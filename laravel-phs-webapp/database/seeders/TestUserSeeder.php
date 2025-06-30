<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run()
    {
        // Check if test user already exists
        $existingUser = DB::table('users')->where('username', 'test')->first();
        
        if (!$existingUser) {
            // Create test address
            $addressId = DB::table('address_details')->insertGetId([
                'street' => 'Test Street',
                'barangay' => 'Test Barangay',
                'municipality' => 'Test Municipality',
                'province' => 'Test Province',
                'city' => 'Test City',
                'country' => 'Philippines',
                'zip_code' => '1234',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create test name
            $nameId = DB::table('name_details')->insertGetId([
                'last_name' => 'Test',
                'first_name' => 'User',
                'middle_name' => 'Middle',
                'nickname' => 'Testy',
                'name_extension' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create test birth details
            $birthId = DB::table('birth_details')->insertGetId([
                'b_date' => 1,
                'b_month' => 1,
                'b_year' => 2000,
                'b_place' => $addressId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create test user
            DB::table('users')->insert([
                'username' => 'test',
                'name' => 'Test User',
                'password' => Hash::make('test'),
                'usertype' => 'admin',
                'organic_role' => 'admin',
                'branch' => 'PMA',
                'created_by' => 'system',
                'is_active' => true,
                'phs_stat' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create test user details
            DB::table('user_details')->insert([
                'username' => 'test',
                'name' => $nameId,
                'profile_pic' => null,
                'home_addr' => $addressId,
                'birth' => $birthId,
                'nationality' => 'Filipino',
                'tin' => null,
                'religion' => null,
                'mobile_num' => null,
                'email_addr' => 'test@example.com',
                'passport_num' => null,
                'passport_exp' => null,
                'change_in_name' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 