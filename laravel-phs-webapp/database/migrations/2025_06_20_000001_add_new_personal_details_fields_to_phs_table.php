<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('p_h_s', function (Blueprint $table) {
            $table->string('rank')->nullable()->after('suffix');
            $table->string('afpsn')->nullable()->after('rank');
            $table->string('branch_of_service')->nullable()->after('afpsn');
            $table->string('present_job')->nullable()->after('branch_of_service');
            $table->string('religion')->nullable()->after('present_job');
            $table->string('home_address')->nullable()->after('religion');
            $table->string('business_address')->nullable()->after('home_address');
            $table->string('change_in_name')->nullable()->after('business_address');
            $table->string('nickname')->nullable()->after('change_in_name');
            $table->string('passport_number')->nullable()->after('nickname');
            $table->date('passport_expiry')->nullable()->after('passport_number');

            // Add human-readable address name fields
            $table->string('home_region_name')->nullable()->after('home_address');
            $table->string('home_province_name')->nullable()->after('home_region_name');
            $table->string('home_city_name')->nullable()->after('home_province_name');
            $table->string('home_barangay_name')->nullable()->after('home_city_name');
            $table->string('business_region_name')->nullable()->after('business_address');
            $table->string('business_province_name')->nullable()->after('business_region_name');
            $table->string('business_city_name')->nullable()->after('business_province_name');
            $table->string('business_barangay_name')->nullable()->after('business_city_name');
        });
    }

    public function down()
    {
        Schema::table('p_h_s', function (Blueprint $table) {
            $table->dropColumn([
                'rank',
                'afpsn',
                'branch_of_service',
                'present_job',
                'religion',
                'home_address',
                'business_address',
                'change_in_name',
                'nickname',
                'passport_number',
                'passport_expiry',
                // Drop the new address name fields
                'home_region_name',
                'home_province_name',
                'home_city_name',
                'home_barangay_name',
                'business_region_name',
                'business_province_name',
                'business_city_name',
                'business_barangay_name',
            ]);
        });
    }
}; 