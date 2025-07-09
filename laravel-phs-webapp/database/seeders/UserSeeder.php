<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\NameDetail;
use App\Models\AddressDetail;
use App\Models\CitizenshipDetail;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $adminName = NameDetail::firstOrCreate([
            'last_name' => 'Administrator',
            'first_name' => 'System',
            'middle_name' => 'Admin',
            'suffix' => null,
            'nickname' => 'Admin',
            'change_in_name' => null,
        ]);

        $adminHomeAddress = AddressDetail::firstOrCreate([
            'country' => 'Philippines',
            'region' => 'National Capital Region',
            'province' => 'Metro Manila',
            'city' => 'Quezon City',
            'barangay' => 'Diliman',
            'street' => 'Admin Street',
            'zip_code' => '1101',
        ]);

        $adminBirthAddress = AddressDetail::firstOrCreate([
            'country' => 'Philippines',
            'region' => 'National Capital Region',
            'province' => 'Metro Manila',
            'city' => 'Manila',
            'barangay' => 'Intramuros',
            'street' => 'Birth Street',
            'zip_code' => '1002',
        ]);

        $adminUser = User::firstOrCreate([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'usertype' => 'admin',
            'organic_role' => 'System Administrator',
            'is_active' => true,
            'phs_status' => 'completed',
        ]);

        UserDetail::firstOrCreate([
            'username' => 'admin',
            'full_name' => $adminName->name_id,
            'profile_path' => null,
            'home_addr' => $adminHomeAddress->addr_id,
            'birth_date' => '1990-01-01',
            'birth_place' => $adminBirthAddress->addr_id,
            'nationality' => 1, // Filipino
            'religion' => 'Roman Catholic',
            'mobile_num' => '09123456789',
            'email_addr' => 'admin@phs-system.com',
        ]);

        // Create Client User
        $clientName = NameDetail::firstOrCreate([
            'last_name' => 'Santos',
            'first_name' => 'Juan',
            'middle_name' => 'Dela Cruz',
            'suffix' => null,
            'nickname' => 'Juan',
            'change_in_name' => null,
        ]);

        $clientHomeAddress = AddressDetail::firstOrCreate([
            'country' => 'Philippines',
            'region' => 'Cordillera Administrative Region',
            'province' => 'Benguet',
            'city' => 'Baguio City',
            'barangay' => 'Central Business District',
            'street' => 'Client Street',
            'zip_code' => '2600',
        ]);

        $clientBirthAddress = AddressDetail::firstOrCreate([
            'country' => 'Philippines',
            'region' => 'Cordillera Administrative Region',
            'province' => 'Benguet',
            'city' => 'Baguio City',
            'barangay' => 'Central Business District',
            'street' => 'Birth Street',
            'zip_code' => '2600',
        ]);

        $clientUser = User::firstOrCreate([
            'username' => 'client',
            'password' => Hash::make('client123'),
            'usertype' => 'client',
            'organic_role' => 'PMA Cadet',
            'is_active' => true,
            'phs_status' => 'in_progress',
        ]);

        UserDetail::firstOrCreate([
            'username' => 'client',
            'full_name' => $clientName->name_id,
            'profile_path' => null,
            'home_addr' => $clientHomeAddress->addr_id,
            'birth_date' => '2000-05-15',
            'birth_place' => $clientBirthAddress->addr_id,
            'nationality' => 1, // Filipino
            'religion' => 'Roman Catholic',
            'mobile_num' => '09187654321',
            'email_addr' => 'client@phs-system.com',
        ]);

        $this->command->info('Users seeded successfully!');
        $this->command->info('Admin credentials: username=admin, password=admin123');
        $this->command->info('Client credentials: username=client, password=client123');
    }
}
