<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Helper\DataUpdate;
use App\Models\UserDetail;
use App\Models\NameDetail;
use App\Models\PersonalDetail;
use App\Models\JobDetail;
use App\Models\GovernmentIdDetail;

echo "Testing save functionality...\n\n";

try {
    // Test 1: Check if we can create a name detail
    echo "Test 1: Creating name detail\n";
    $nameData = [
        'first_name' => 'Test',
        'last_name' => 'User',
        'middle_name' => 'Middle',
        'suffix' => 'Jr.',
    ];
    
    $nameId = DataUpdate::updateNameDetail('admin', $nameData);
    echo "Name ID created: $nameId\n\n";
    
    // Test 2: Check if we can create address details
    echo "Test 2: Creating address details\n";
    $homeAddrData = [
        'street' => 'Test Street',
        'barangay' => 'Test Barangay',
        'city' => 'Test City',
        'province' => 'Test Province',
        'region' => 'Test Region',
        'country' => 'Philippines'
    ];
    
    $birthAddrData = [
        'street' => 'Test Birth Street',
        'barangay' => 'Test Birth Barangay',
        'city' => 'Test Birth City',
        'province' => 'Test Birth Province',
        'region' => 'Test Birth Region',
        'country' => 'Philippines'
    ];
    
    $homeAddrId = DataUpdate::updateAddressDetail($homeAddrData);
    $birthAddrId = DataUpdate::updateAddressDetail($birthAddrData);
    echo "Home address ID: $homeAddrId\n";
    echo "Birth address ID: $birthAddrId\n\n";
    
    // Test 3: Check if we can update user detail
    echo "Test 3: Updating user detail\n";
    $userDetailData = [
        'full_name' => $nameId,
        'birth_date' => '1990-01-01',
        'nationality' => 1,
        'religion' => 'Test Religion',
        'mobile_num' => '09123456789',
        'email_addr' => 'test@example.com',
        'home_addr' => $homeAddrId,
        'birth_place' => $birthAddrId,
    ];
    
    DataUpdate::updateUserDetail('admin', $userDetailData);
    echo "User detail updated successfully\n\n";
    
    // Test 4: Check if we can update personal detail
    echo "Test 4: Updating personal detail\n";
    $personalData = [
        'nickname' => 'Test Nickname',
        'change_in_name' => 'Test Change',
    ];
    
    DataUpdate::updatePersonalDetail('admin', $personalData);
    echo "Personal detail updated successfully\n\n";
    
    // Test 5: Check if we can update job detail
    echo "Test 5: Updating job detail\n";
    $jobData = [
        'username' => 'admin',
        'service_branch' => 'Test Branch',
        'rank' => 'Test Rank',
        'afpsn' => '123456789',
        'job_desc' => 'Test Job',
        'job_addr' => $homeAddrId, // Use same address for simplicity
    ];
    
    DataUpdate::updateJobDetail('admin', $jobData);
    echo "Job detail updated successfully\n\n";
    
    // Test 6: Check if we can update government ID
    echo "Test 6: Updating government ID\n";
    $govIdData = [
        'username' => 'admin',
        'tin_num' => '123-456-789-000',
        'pass_num' => 'P123456789',
        'pass_exp' => '2025-12-31',
    ];
    
    DataUpdate::updateGovIdDetail('admin', $govIdData);
    echo "Government ID updated successfully\n\n";
    
    echo "All tests passed! The save functionality is working.\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
} 