<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create a test client user
        User::create([
            'username' => 'testclient',
            'password' => Hash::make('password123'),
            'usertype' => 'client',
            'organic_role' => 'client',
            'branch' => 'main',
            'created_by' => 'system',
            'is_active' => true
        ]);

        // Create a test admin user
        User::create([
            'username' => 'testadmin',
            'password' => Hash::make('password123'),
            'usertype' => 'admin',
            'organic_role' => 'admin',
            'branch' => 'main',
            'created_by' => 'system',
            'is_active' => true
        ]);
    }
} 