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
        Schema::table('family_backgrounds', function (Blueprint $table) {
            // Father details
            $table->date('father_birth_date')->nullable();
            $table->string('father_birth_place')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_employer')->nullable();
            $table->string('father_place_of_employment')->nullable();
            $table->string('father_citizenship')->nullable();
            $table->string('father_other_citizenship')->nullable();
            $table->string('father_naturalized_details')->nullable();

            // Mother details
            $table->date('mother_birth_date')->nullable();
            $table->string('mother_birth_place')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_employer')->nullable();
            $table->string('mother_place_of_employment')->nullable();
            $table->string('mother_citizenship')->nullable();
            $table->string('mother_other_citizenship')->nullable();
            $table->string('mother_naturalized_details')->nullable();

            // Spouse details (additional fields)
            $table->date('spouse_birth_date')->nullable();
            $table->string('spouse_birth_place')->nullable();
            $table->string('spouse_place_of_employment')->nullable();
            $table->string('spouse_citizenship')->nullable();
            $table->string('spouse_other_citizenship')->nullable();
            $table->string('spouse_naturalized_details')->nullable();
            $table->string('spouse_complete_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('family_backgrounds', function (Blueprint $table) {
            $table->dropColumn([
                'father_birth_date', 'father_birth_place', 'father_occupation', 'father_employer', 'father_place_of_employment', 'father_citizenship', 'father_other_citizenship', 'father_naturalized_details',
                'mother_birth_date', 'mother_birth_place', 'mother_occupation', 'mother_employer', 'mother_place_of_employment', 'mother_citizenship', 'mother_other_citizenship', 'mother_naturalized_details',
                'spouse_birth_date', 'spouse_birth_place', 'spouse_place_of_employment', 'spouse_citizenship', 'spouse_other_citizenship', 'spouse_naturalized_details', 'spouse_complete_address',
            ]);
        });
    }
};
