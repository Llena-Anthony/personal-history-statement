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
        // Truncate related tables for a clean slate
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('description_details')->truncate();
        \DB::table('personal_details')->truncate();
        \DB::table('user_details')->truncate();
        \DB::table('users')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create Admin User only if not exists
        if (!User::where('username', 'admin')->exists()) {
            $adminName = NameDetail::firstOrCreate([
                'last_name' => 'Administrator',
                'first_name' => 'System',
                'middle_name' => 'Admin',
                'suffix' => null,
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

            $adminUser = User::create([
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'usertype' => 'admin',
                'organic_role' => 'System Administrator',
                'is_active' => true,
                'phs_status' => 'completed',
                'email' => 'admin@phs-system.com',
            ]);

            UserDetail::create([
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
        }

        // Create Client User only if not exists
        if (!User::where('username', 'client')->exists()) {
            $clientName = NameDetail::firstOrCreate([
                'last_name' => 'Santos',
                'first_name' => 'Juan',
                'middle_name' => 'Dela Cruz',
                'suffix' => null,
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

            $clientUser = User::create([
                'username' => 'client',
                'password' => Hash::make('client123'),
                'usertype' => 'client',
                'organic_role' => 'PMA Cadet',
                'is_active' => true,
                'phs_status' => 'in_progress',
                'email' => 'client@phs-system.com',
            ]);

            UserDetail::create([
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
        }

        $this->command->info('Users seeded successfully!');
        $this->command->info('Admin credentials: username=admin, password=admin123');
        $this->command->info('Client credentials: username=client, password=client123');

        // Generate 78 random users with realistic data
        $roles = ['client', 'admin', 'personnel'];
        $firstNames = ['Juan', 'Maria', 'Jose', 'Ana', 'Pedro', 'Liza', 'Carlos', 'Grace', 'Miguel', 'Sofia', 'Andres', 'Carmen', 'Rafael', 'Isabel', 'Enrique', 'Teresa', 'Manuel', 'Patricia', 'Roberto', 'Elena', 'Francisco', 'Lucia', 'Antonio', 'Bea', 'Jorge', 'Diana', 'Victor', 'Paula', 'Luis', 'Marta'];
        $lastNames = ['Santos', 'Reyes', 'Cruz', 'Bautista', 'Garcia', 'Torres', 'Ramos', 'Mendoza', 'Flores', 'Gonzales', 'Rivera', 'Gutierrez', 'Castro', 'Lopez', 'Martinez', 'Morales', 'Delos Reyes', 'Navarro', 'Aguilar', 'Domingo', 'Salazar', 'Pascual', 'Rosales', 'Silva', 'Valdez', 'Padilla', 'Santiago', 'Lim', 'Tan', 'Uy'];
        $regions = ['NCR', 'CAR', 'Region I', 'Region II', 'Region III', 'Region IV-A', 'Region IV-B', 'Region V', 'Region VI', 'Region VII', 'Region VIII', 'Region IX', 'Region X', 'Region XI', 'Region XII', 'Region XIII', 'BARMM'];
        $statuses = ['approved', 'reviewed', 'rejected', 'submitted', 'in_progress', 'pending'];
        $phsSections = ['Personal Info', 'Family Background', 'Educational Background', 'Employment History', 'Character & Reputation', 'Credit Reputation', 'Arrest Record', 'Foreign Countries', 'Marital Status', 'Military History'];
        $faker = \Faker\Factory::create();
        $now = now();
        $organicRoles = ['civilian', 'enlisted', 'officer'];
        $emailDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'protonmail.com'];
        for ($i = 0; $i < 75; $i++) {
            $role = $roles[array_rand($roles)];
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $region = $regions[array_rand($regions)];
            $status = $statuses[array_rand($statuses)];
            $isActive = $i % 5 !== 0; // 80% active
            $createdAt = $now->copy()->subDays(rand(0, 365));
            $lastAccessed = $createdAt->copy()->addDays(rand(0, 30));
            $phsSection = $phsSections[array_rand($phsSections)];
            $username = strtolower($firstName . $lastName . $i);
            $emailDomain = $emailDomains[array_rand($emailDomains)];
            $email = strtolower($firstName . '.' . $lastName . $i . '@' . $emailDomain);
            $organicRole = $organicRoles[array_rand($organicRoles)];

            // Create related NameDetail
            $nameDetail = NameDetail::firstOrCreate([
                'last_name' => $lastName,
                'first_name' => $firstName,
                'middle_name' => $faker->lastName,
                'suffix' => null,
            ]);

            // Create related AddressDetail for home address
            $homeAddress = AddressDetail::firstOrCreate([
                'country' => 'Philippines',
                'region' => $region,
                'province' => $faker->state,
                'city' => $faker->city,
                'barangay' => $faker->streetName,
                'street' => $faker->streetAddress,
                'zip_code' => $faker->postcode,
            ]);

            // Create related AddressDetail for birth place
            $birthAddress = AddressDetail::firstOrCreate([
                'country' => 'Philippines',
                'region' => $region,
                'province' => $faker->state,
                'city' => $faker->city,
                'barangay' => $faker->streetName,
                'street' => $faker->streetAddress,
                'zip_code' => $faker->postcode,
            ]);

            $user = User::create([
                'username' => $username,
                'usertype' => $role,
                'phs_status' => $status,
                'is_active' => $isActive,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
                'email' => $email,
                'last_login_at' => $lastAccessed,
                'password' => Hash::make('password'),
                'organic_role' => $organicRole,
            ]);

            UserDetail::create([
                'username' => $username,
                'full_name' => $nameDetail->name_id,
                'profile_path' => null,
                'home_addr' => $homeAddress->addr_id,
                'birth_date' => $faker->dateTimeBetween('-60 years', '-18 years'),
                'birth_place' => $birthAddress->addr_id,
                'nationality' => 1, // Filipino
                'religion' => 'Roman Catholic',
                'mobile_num' => $faker->numerify('09#########'),
                'email_addr' => $email,
            ]);
        }
        $this->command->info('75 random users seeded successfully!');
    }
}
