<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Check if testclient user already exists
        $existingClient = User::where('username', 'testclient')->first();
        
        if (!$existingClient) {
            // Create a test client user
            User::create([
                'username' => 'testclient',
                'name' => 'Test Client',
                'password' => Hash::make('password123'),
                'usertype' => 'client',
                'organic_role' => 'client',
                'branch' => 'main',
                'created_by' => 'system',
                'is_active' => true
            ]);
        }

        // Check if testadmin user already exists
        $existingAdmin = User::where('username', 'testadmin')->first();
        
        if (!$existingAdmin) {
            // Create a test admin user
            User::create([
                'username' => 'testadmin',
                'name' => 'Test Admin',
                'password' => Hash::make('password123'),
                'usertype' => 'admin',
                'organic_role' => 'admin',
                'branch' => 'main',
                'created_by' => 'system',
                'is_active' => true
            ]);
        }
    }
} 