<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Remove old name fields from family_backgrounds table
        $familyColumns = [
            'spouse_first_name', 'spouse_middle_name', 'spouse_last_name',
            'father_first_name', 'father_middle_name', 'father_last_name',
            'mother_first_name', 'mother_middle_name', 'mother_last_name',
            'step_parent_guardian_first_name', 'step_parent_guardian_middle_name', 'step_parent_guardian_last_name',
            'father_in_law_first_name', 'father_in_law_middle_name', 'father_in_law_last_name',
            'mother_in_law_first_name', 'mother_in_law_middle_name', 'mother_in_law_last_name',
        ];
        Schema::table('family_backgrounds', function (Blueprint $table) use ($familyColumns) {
            foreach ($familyColumns as $col) {
                if (Schema::hasColumn('family_backgrounds', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        // Remove old name fields from marital_statuses table
        $maritalColumns = ['spouse_first_name', 'spouse_middle_name', 'spouse_last_name'];
        Schema::table('marital_statuses', function (Blueprint $table) use ($maritalColumns) {
            foreach ($maritalColumns as $col) {
                if (Schema::hasColumn('marital_statuses', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        // Remove old name fields from siblings table
        $siblingColumns = ['first_name', 'middle_name', 'last_name'];
        Schema::table('siblings', function (Blueprint $table) use ($siblingColumns) {
            foreach ($siblingColumns as $col) {
                if (Schema::hasColumn('siblings', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        // Remove old name field from character_references table
        if (Schema::hasColumn('character_references', 'ref_name')) {
            Schema::table('character_references', function (Blueprint $table) {
                $table->dropColumn('ref_name');
            });
        }

        // Remove old name fields from p_h_s table
        $phsColumns = ['first_name', 'middle_name', 'last_name'];
        Schema::table('p_h_s', function (Blueprint $table) use ($phsColumns) {
            foreach ($phsColumns as $col) {
                if (Schema::hasColumn('p_h_s', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        // Remove old name field from children table
        if (Schema::hasColumn('children', 'name')) {
            Schema::table('children', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }
    }

    public function down()
    {
        // Add back the old name fields (for rollback purposes)
        Schema::table('family_backgrounds', function (Blueprint $table) {
            $table->string('spouse_first_name')->nullable();
            $table->string('spouse_middle_name')->nullable();
            $table->string('spouse_last_name')->nullable();
            $table->string('father_first_name')->nullable();
            $table->string('father_middle_name')->nullable();
            $table->string('father_last_name')->nullable();
            $table->string('mother_first_name')->nullable();
            $table->string('mother_middle_name')->nullable();
            $table->string('mother_last_name')->nullable();
            $table->string('step_parent_guardian_first_name')->nullable();
            $table->string('step_parent_guardian_middle_name')->nullable();
            $table->string('step_parent_guardian_last_name')->nullable();
            $table->string('father_in_law_first_name')->nullable();
            $table->string('father_in_law_middle_name')->nullable();
            $table->string('father_in_law_last_name')->nullable();
            $table->string('mother_in_law_first_name')->nullable();
            $table->string('mother_in_law_middle_name')->nullable();
            $table->string('mother_in_law_last_name')->nullable();
        });

        Schema::table('marital_statuses', function (Blueprint $table) {
            $table->string('spouse_first_name')->nullable();
            $table->string('spouse_middle_name')->nullable();
            $table->string('spouse_last_name')->nullable();
        });

        Schema::table('siblings', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
        });

        Schema::table('character_references', function (Blueprint $table) {
            $table->string('ref_name')->nullable();
        });

        Schema::table('p_h_s', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
        });

        Schema::table('children', function (Blueprint $table) {
            $table->string('name')->nullable();
        });
    }
}; 