<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Helper\DataUpdate;
use App\Helper\DataRetrieval;
use App\Models\User;

echo "Testing address saving and retrieval...\n";

// Test data
$testData = [
    'name' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'middle_name' => 'Smith',
        'suffix' => null,
        'nickname' => 'Johnny',
        'change_in_name' => null,
    ],
    'birth_address' => [
        'region' => null,
        'province' => null,
        'city' => null,
        'barangay' => null,
        'street' => '123 Main Street',
        'region_name' => 'National Capital Region (NCR)',
        'province_name' => 'Metro Manila',
        'city_name' => 'Manila',
        'barangay_name' => 'Barangay 123',
    ],
    'home_address' => [
        'region' => null,
        'province' => null,
        'city' => null,
        'barangay' => null,
        'street' => '456 Home Avenue',
        'region_name' => 'CALABARZON (Region IV-A)',
        'province_name' => 'Laguna',
        'city_name' => 'San Pedro',
        'barangay_name' => 'Barangay 456',
    ],
    'business_address' => [
        'region' => null,
        'province' => null,
        'city' => null,
        'barangay' => null,
        'street' => '789 Business Blvd',
        'region_name' => 'Central Luzon (Region III)',
        'province_name' => 'Bulacan',
        'city_name' => 'Malolos',
        'barangay_name' => 'Barangay 789',
    ],
    'birth_date' => '1990-01-01',
    'nationality' => 1, // Assuming this is a valid citizenship ID
    'religion' => 'Catholic',
    'mobile' => '09123456789',
    'email' => 'john.doe@example.com',
    'personal' => [
        'nickname' => 'Johnny',
        'change_in_name' => null,
    ],
    'job' => [
        'branch_of_service' => 'Army',
        'rank' => 'Captain',
        'afpsn' => '12345678',
        'job_desc' => 'Infantry Officer',
    ],
    'gov_id' => [
        'tin_num' => '123-456-789-000',
        'pass_num' => 'P123456789',
        'pass_exp' => '2025-12-31',
    ],
];

$username = 'test_user_' . time();

echo "Creating test user: $username\n";

try {
    // Create a test user first
    $user = User::create([
        'username' => $username,
        'password' => bcrypt('password'),
        'usertype' => 'client',
        'email' => 'john.doe@example.com',
    ]);
    
    echo "✓ User created successfully\n";
    
    // Save the data
    DataUpdate::savePersonalDetails($testData, $username);
    echo "✓ Data saved successfully\n";
    
    // Retrieve the data
    $retrievedData = DataRetrieval::retrievePersonalDetails($username);
    echo "✓ Data retrieved successfully\n";
    
    // Check if addresses are saved as text
    echo "\nChecking address fields:\n";
    echo "Birth address: " . ($retrievedData['birth_street'] ?? 'N/A') . "\n";
    echo "Birth region name: " . ($retrievedData['birth_region_name'] ?? 'N/A') . "\n";
    echo "Birth province name: " . ($retrievedData['birth_province_name'] ?? 'N/A') . "\n";
    echo "Birth city name: " . ($retrievedData['birth_city_name'] ?? 'N/A') . "\n";
    echo "Birth barangay name: " . ($retrievedData['birth_barangay_name'] ?? 'N/A') . "\n";
    
    echo "\nHome address: " . ($retrievedData['home_street'] ?? 'N/A') . "\n";
    echo "Home region name: " . ($retrievedData['home_region_name'] ?? 'N/A') . "\n";
    echo "Home province name: " . ($retrievedData['home_province_name'] ?? 'N/A') . "\n";
    echo "Home city name: " . ($retrievedData['home_city_name'] ?? 'N/A') . "\n";
    echo "Home barangay name: " . ($retrievedData['home_barangay_name'] ?? 'N/A') . "\n";
    
    echo "\nBusiness address: " . ($retrievedData['business_street'] ?? 'N/A') . "\n";
    echo "Business region name: " . ($retrievedData['business_region_name'] ?? 'N/A') . "\n";
    echo "Business province name: " . ($retrievedData['business_province_name'] ?? 'N/A') . "\n";
    echo "Business city name: " . ($retrievedData['business_city_name'] ?? 'N/A') . "\n";
    echo "Business barangay name: " . ($retrievedData['business_barangay_name'] ?? 'N/A') . "\n";
    
    // Check if ID fields are empty (as expected for text-only approach)
    echo "\nChecking ID fields (should be empty):\n";
    echo "Birth region: " . ($retrievedData['birth_region'] ?? 'N/A') . "\n";
    echo "Birth province: " . ($retrievedData['birth_province'] ?? 'N/A') . "\n";
    echo "Birth city: " . ($retrievedData['birth_city'] ?? 'N/A') . "\n";
    echo "Birth barangay: " . ($retrievedData['birth_barangay'] ?? 'N/A') . "\n";
    
    echo "\nTest completed successfully!\n";
    
    // Clean up - delete the test user
    $user->delete();
    echo "✓ Test user cleaned up\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
} 