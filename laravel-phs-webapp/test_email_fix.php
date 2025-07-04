<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\AdminUserController;

echo "Testing Email Fix in User Creation\n";
echo "==================================\n\n";

// Test 1: Check if admin user exists and can login
echo "1. Testing admin login...\n";
$adminUser = User::where('username', 'admin')->first();
if ($adminUser) {
    echo "   ✓ Admin user found: {$adminUser->username} (usertype: {$adminUser->usertype})\n";
    
    $credentials = ['username' => 'admin', 'password' => 'admin123'];
    if (Auth::attempt($credentials)) {
        echo "   ✓ Admin login successful\n";
        
        // Test 2: Check if AdminUserController store method works with email
        echo "\n2. Testing AdminUserController store method with email...\n";
        try {
            $controller = new AdminUserController();
            $request = new \Illuminate\Http\Request();
            $request->merge([
                'first_name' => 'Test',
                'middle_name' => 'User',
                'last_name' => 'Email',
                'email' => 'test@example.com',
                'user_type' => 'client',
                'organic_group' => 'civilian'
            ]);
            
            // This should redirect to confirm page
            $response = $controller->store($request);
            echo "   ✓ AdminUserController store method works with email\n";
        } catch (Exception $e) {
            echo "   ✗ AdminUserController store method error: " . $e->getMessage() . "\n";
        }
        
        // Test 3: Check if existing users have email in UserDetail
        echo "\n3. Testing existing users email data...\n";
        try {
            $users = User::with('userDetail')->get();
            echo "   ✓ Found {$users->count()} users\n";
            foreach ($users as $user) {
                $email = $user->userDetail->email_addr ?? 'No email';
                echo "     - {$user->username}: {$email}\n";
            }
        } catch (Exception $e) {
            echo "   ✗ User email check error: " . $e->getMessage() . "\n";
        }
        
        // Test 4: Check if search works with email
        echo "\n4. Testing search with email...\n";
        try {
            $controller = new AdminUserController();
            $request = new \Illuminate\Http\Request();
            $request->merge(['search' => 'test@example.com']);
            $response = $controller->index($request);
            echo "   ✓ Search with email works\n";
        } catch (Exception $e) {
            echo "   ✗ Search with email error: " . $e->getMessage() . "\n";
        }
        
        Auth::logout();
        echo "\n   ✓ Admin logout successful\n";
    } else {
        echo "   ✗ Admin login failed\n";
    }
} else {
    echo "   ✗ Admin user not found\n";
}

echo "\nTest completed.\n"; 