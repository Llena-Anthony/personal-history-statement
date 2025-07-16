<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Checking database structure...\n\n";

try {
    // Check user_details table structure
    echo "User Details Table Structure:\n";
    $columns = DB::select('DESCRIBE user_details');
    foreach($columns as $col) {
        echo $col->Field . ' - ' . $col->Type . "\n";
    }
    
    echo "\nJob Details Table Structure:\n";
    $columns = DB::select('DESCRIBE job_details');
    foreach($columns as $col) {
        echo $col->Field . ' - ' . $col->Type . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 