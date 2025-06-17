<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('p_h_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Personal Information
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood_type')->nullable();
            
            // Government IDs
            $table->string('gsis_id')->nullable();
            $table->string('philhealth_no')->nullable();
            $table->string('tin_no')->nullable();
            $table->string('pagibig_id')->nullable();
            $table->string('sss_no')->nullable();
            $table->string('agency_employee_no')->nullable();
            
            // Citizenship
            $table->string('citizenship');
            $table->boolean('dual_citizenship_by_birth')->default(false);
            $table->boolean('dual_citizenship_by_naturalization')->default(false);
            $table->string('dual_citizenship_country')->nullable();
            
            // Residential Address
            $table->string('residential_house_no')->nullable();
            $table->string('residential_street')->nullable();
            $table->string('residential_subdivision')->nullable();
            $table->string('residential_barangay')->nullable();
            $table->string('residential_city')->nullable();
            $table->string('residential_province')->nullable();
            $table->string('residential_zip')->nullable();
            
            // Permanent Address
            $table->string('permanent_house_no')->nullable();
            $table->string('permanent_street')->nullable();
            $table->string('permanent_subdivision')->nullable();
            $table->string('permanent_barangay')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_province')->nullable();
            $table->string('permanent_zip')->nullable();
            
            // Contact Information
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('p_h_s');
    }
}; 