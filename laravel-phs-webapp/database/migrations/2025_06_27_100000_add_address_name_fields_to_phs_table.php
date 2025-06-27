<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('p_h_s', function (Blueprint $table) {
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