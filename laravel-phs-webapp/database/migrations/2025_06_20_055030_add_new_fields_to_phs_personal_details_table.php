<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('p_h_s', function (Blueprint $table) {
            // Enhanced Home Address
            $table->string('home_region')->nullable();
            $table->string('home_province')->nullable();
            $table->string('home_city')->nullable();
            $table->string('home_barangay')->nullable();
            $table->string('home_street')->nullable();
            $table->text('home_complete_address')->nullable();
            
            // Business Address
            $table->string('business_region')->nullable();
            $table->string('business_province')->nullable();
            $table->string('business_city')->nullable();
            $table->string('business_barangay')->nullable();
            $table->string('business_street')->nullable();
            $table->text('business_complete_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('p_h_s', function (Blueprint $table) {
            // Enhanced Home Address
            $table->dropColumn([
                'home_region',
                'home_province',
                'home_city',
                'home_barangay',
                'home_street',
                'home_complete_address'
            ]);
            
            // Business Address
            $table->dropColumn([
                'business_region',
                'business_province',
                'business_city',
                'business_barangay',
                'business_street',
                'business_complete_address'
            ]);
        });
    }
};
