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
            // Step-parent or Guardian
            $table->string('step_parent_guardian_first_name')->nullable();
            $table->string('step_parent_guardian_middle_name')->nullable();
            $table->string('step_parent_guardian_last_name')->nullable();
            $table->string('step_parent_guardian_suffix')->nullable();
            $table->date('step_parent_guardian_birth_date')->nullable();
            $table->string('step_parent_guardian_birth_place')->nullable();
            $table->string('step_parent_guardian_occupation')->nullable();
            $table->string('step_parent_guardian_employer')->nullable();
            $table->string('step_parent_guardian_place_of_employment')->nullable();
            $table->string('step_parent_guardian_citizenship')->nullable();
            $table->string('step_parent_guardian_other_citizenship')->nullable();
            $table->string('step_parent_guardian_naturalized_details')->nullable();
            $table->string('step_parent_guardian_complete_address')->nullable();

            // Father-in-law
            $table->string('father_in_law_first_name')->nullable();
            $table->string('father_in_law_middle_name')->nullable();
            $table->string('father_in_law_last_name')->nullable();
            $table->string('father_in_law_suffix')->nullable();
            $table->date('father_in_law_birth_date')->nullable();
            $table->string('father_in_law_birth_place')->nullable();
            $table->string('father_in_law_occupation')->nullable();
            $table->string('father_in_law_employer')->nullable();
            $table->string('father_in_law_place_of_employment')->nullable();
            $table->string('father_in_law_citizenship')->nullable();
            $table->string('father_in_law_other_citizenship')->nullable();
            $table->string('father_in_law_naturalized_details')->nullable();
            $table->string('father_in_law_complete_address')->nullable();

            // Mother-in-law
            $table->string('mother_in_law_first_name')->nullable();
            $table->string('mother_in_law_middle_name')->nullable();
            $table->string('mother_in_law_last_name')->nullable();
            $table->string('mother_in_law_suffix')->nullable();
            $table->date('mother_in_law_birth_date')->nullable();
            $table->string('mother_in_law_birth_place')->nullable();
            $table->string('mother_in_law_occupation')->nullable();
            $table->string('mother_in_law_employer')->nullable();
            $table->string('mother_in_law_place_of_employment')->nullable();
            $table->string('mother_in_law_citizenship')->nullable();
            $table->string('mother_in_law_other_citizenship')->nullable();
            $table->string('mother_in_law_naturalized_details')->nullable();
            $table->string('mother_in_law_complete_address')->nullable();

            // Father
            $table->string('father_complete_address')->nullable();

            // Mother
            $table->string('mother_complete_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('family_backgrounds', function (Blueprint $table) {
            $table->dropColumn([
                'step_parent_guardian_first_name', 'step_parent_guardian_middle_name', 'step_parent_guardian_last_name', 'step_parent_guardian_suffix', 'step_parent_guardian_birth_date', 'step_parent_guardian_birth_place', 'step_parent_guardian_occupation', 'step_parent_guardian_employer', 'step_parent_guardian_place_of_employment', 'step_parent_guardian_citizenship', 'step_parent_guardian_other_citizenship', 'step_parent_guardian_naturalized_details', 'step_parent_guardian_complete_address',
                'father_in_law_first_name', 'father_in_law_middle_name', 'father_in_law_last_name', 'father_in_law_suffix', 'father_in_law_birth_date', 'father_in_law_birth_place', 'father_in_law_occupation', 'father_in_law_employer', 'father_in_law_place_of_employment', 'father_in_law_citizenship', 'father_in_law_other_citizenship', 'father_in_law_naturalized_details', 'father_in_law_complete_address',
                'mother_in_law_first_name', 'mother_in_law_middle_name', 'mother_in_law_last_name', 'mother_in_law_suffix', 'mother_in_law_birth_date', 'mother_in_law_birth_place', 'mother_in_law_occupation', 'mother_in_law_employer', 'mother_in_law_place_of_employment', 'mother_in_law_citizenship', 'mother_in_law_other_citizenship', 'mother_in_law_naturalized_details', 'mother_in_law_complete_address',
                'father_complete_address',
                'mother_complete_address',
            ]);
        });
    }
};
