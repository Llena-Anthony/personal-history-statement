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
            // Mother citizenship fields
            $table->string('mother_citizenship_type')->nullable();
            $table->text('mother_citizenship_dual_1')->nullable();
            $table->text('mother_citizenship_dual_2')->nullable();
            $table->text('mother_citizenship_naturalized')->nullable();
            $table->string('mother_naturalized_month')->nullable();
            $table->integer('mother_naturalized_year')->nullable();
            $table->text('mother_naturalized_place')->nullable();
            
            // Step-parent/Guardian citizenship fields
            $table->string('step_parent_guardian_citizenship_type')->nullable();
            $table->text('step_parent_guardian_citizenship_dual_1')->nullable();
            $table->text('step_parent_guardian_citizenship_dual_2')->nullable();
            $table->text('step_parent_guardian_citizenship_naturalized')->nullable();
            $table->string('step_parent_guardian_naturalized_month')->nullable();
            $table->integer('step_parent_guardian_naturalized_year')->nullable();
            $table->text('step_parent_guardian_naturalized_place')->nullable();
            
            // Father-in-law citizenship fields
            $table->string('father_in_law_citizenship_type')->nullable();
            $table->text('father_in_law_citizenship_dual_1')->nullable();
            $table->text('father_in_law_citizenship_dual_2')->nullable();
            $table->text('father_in_law_citizenship_naturalized')->nullable();
            $table->string('father_in_law_naturalized_month')->nullable();
            $table->integer('father_in_law_naturalized_year')->nullable();
            $table->text('father_in_law_naturalized_place')->nullable();
            
            // Mother-in-law citizenship fields
            $table->string('mother_in_law_citizenship_type')->nullable();
            $table->text('mother_in_law_citizenship_dual_1')->nullable();
            $table->text('mother_in_law_citizenship_dual_2')->nullable();
            $table->text('mother_in_law_citizenship_naturalized')->nullable();
            $table->string('mother_in_law_naturalized_month')->nullable();
            $table->integer('mother_in_law_naturalized_year')->nullable();
            $table->text('mother_in_law_naturalized_place')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('family_backgrounds', function (Blueprint $table) {
            // Mother citizenship fields
            $table->dropColumn([
                'mother_citizenship_type',
                'mother_citizenship_dual_1',
                'mother_citizenship_dual_2',
                'mother_citizenship_naturalized',
                'mother_naturalized_month',
                'mother_naturalized_year',
                'mother_naturalized_place'
            ]);
            
            // Step-parent/Guardian citizenship fields
            $table->dropColumn([
                'step_parent_guardian_citizenship_type',
                'step_parent_guardian_citizenship_dual_1',
                'step_parent_guardian_citizenship_dual_2',
                'step_parent_guardian_citizenship_naturalized',
                'step_parent_guardian_naturalized_month',
                'step_parent_guardian_naturalized_year',
                'step_parent_guardian_naturalized_place'
            ]);
            
            // Father-in-law citizenship fields
            $table->dropColumn([
                'father_in_law_citizenship_type',
                'father_in_law_citizenship_dual_1',
                'father_in_law_citizenship_dual_2',
                'father_in_law_citizenship_naturalized',
                'father_in_law_naturalized_month',
                'father_in_law_naturalized_year',
                'father_in_law_naturalized_place'
            ]);
            
            // Mother-in-law citizenship fields
            $table->dropColumn([
                'mother_in_law_citizenship_type',
                'mother_in_law_citizenship_dual_1',
                'mother_in_law_citizenship_dual_2',
                'mother_in_law_citizenship_naturalized',
                'mother_in_law_naturalized_month',
                'mother_in_law_naturalized_year',
                'mother_in_law_naturalized_place'
            ]);
        });
    }
};
