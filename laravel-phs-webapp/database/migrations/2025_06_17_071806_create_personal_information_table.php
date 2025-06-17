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
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('name_extension')->nullable();
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->enum('sex', ['male', 'female']);
            $table->enum('civil_status', ['single', 'married', 'widowed', 'separated']);
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->string('blood_type', 10);
            $table->string('gsis_id_no')->nullable();
            $table->string('pag_ibig_id_no')->nullable();
            $table->string('philhealth_no')->nullable();
            $table->string('sss_no')->nullable();
            $table->string('tin')->nullable();
            $table->string('agency_employee_no')->nullable();
            $table->string('citizenship');
            $table->boolean('dual_citizenship');
            $table->string('dual_citizenship_country')->nullable();
            $table->string('residential_address');
            $table->string('residential_zip_code', 10);
            $table->string('residential_tel_no', 20)->nullable();
            $table->string('permanent_address');
            $table->string('permanent_zip_code', 10);
            $table->string('permanent_tel_no', 20)->nullable();
            $table->string('email');
            $table->string('cellphone_no', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_information');
    }
};
