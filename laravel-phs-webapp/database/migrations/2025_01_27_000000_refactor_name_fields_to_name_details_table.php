<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Add name_details foreign keys to family_backgrounds table
        Schema::table('family_backgrounds', function (Blueprint $table) {
            if (!Schema::hasColumn('family_backgrounds', 'spouse_name_id')) {
                $table->foreignId('spouse_name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
            if (!Schema::hasColumn('family_backgrounds', 'father_name_id')) {
                $table->foreignId('father_name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
            if (!Schema::hasColumn('family_backgrounds', 'mother_name_id')) {
                $table->foreignId('mother_name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
            if (!Schema::hasColumn('family_backgrounds', 'step_parent_guardian_name_id')) {
                $table->foreignId('step_parent_guardian_name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
            if (!Schema::hasColumn('family_backgrounds', 'father_in_law_name_id')) {
                $table->foreignId('father_in_law_name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
            if (!Schema::hasColumn('family_backgrounds', 'mother_in_law_name_id')) {
                $table->foreignId('mother_in_law_name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
        });

        // 2. Add name_details foreign key to marital_statuses table
        Schema::table('marital_statuses', function (Blueprint $table) {
            if (!Schema::hasColumn('marital_statuses', 'spouse_name_id')) {
                $table->foreignId('spouse_name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
        });

        // 3. Add name_details foreign key to siblings table
        Schema::table('siblings', function (Blueprint $table) {
            if (!Schema::hasColumn('siblings', 'name_id')) {
                $table->foreignId('name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
        });

        // 4. Add name_details foreign key to character_references table
        Schema::table('character_references', function (Blueprint $table) {
            if (!Schema::hasColumn('character_references', 'ref_name_id')) {
                $table->foreignId('ref_name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
        });

        // 5. Add name_details foreign key to PHS table
        Schema::table('p_h_s', function (Blueprint $table) {
            if (!Schema::hasColumn('p_h_s', 'name_id')) {
                $table->foreignId('name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
        });

        // 6. Add name_details foreign key to children table
        Schema::table('children', function (Blueprint $table) {
            if (!Schema::hasColumn('children', 'name_id')) {
                $table->foreignId('name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        // Remove foreign key constraints
        Schema::table('family_backgrounds', function (Blueprint $table) {
            if (Schema::hasColumn('family_backgrounds', 'spouse_name_id')) {
                $table->dropForeign(['spouse_name_id']);
                $table->dropColumn('spouse_name_id');
            }
            if (Schema::hasColumn('family_backgrounds', 'father_name_id')) {
                $table->dropForeign(['father_name_id']);
                $table->dropColumn('father_name_id');
            }
            if (Schema::hasColumn('family_backgrounds', 'mother_name_id')) {
                $table->dropForeign(['mother_name_id']);
                $table->dropColumn('mother_name_id');
            }
            if (Schema::hasColumn('family_backgrounds', 'step_parent_guardian_name_id')) {
                $table->dropForeign(['step_parent_guardian_name_id']);
                $table->dropColumn('step_parent_guardian_name_id');
            }
            if (Schema::hasColumn('family_backgrounds', 'father_in_law_name_id')) {
                $table->dropForeign(['father_in_law_name_id']);
                $table->dropColumn('father_in_law_name_id');
            }
            if (Schema::hasColumn('family_backgrounds', 'mother_in_law_name_id')) {
                $table->dropForeign(['mother_in_law_name_id']);
                $table->dropColumn('mother_in_law_name_id');
            }
        });

        Schema::table('marital_statuses', function (Blueprint $table) {
            if (Schema::hasColumn('marital_statuses', 'spouse_name_id')) {
                $table->dropForeign(['spouse_name_id']);
                $table->dropColumn('spouse_name_id');
            }
        });

        Schema::table('siblings', function (Blueprint $table) {
            if (Schema::hasColumn('siblings', 'name_id')) {
                $table->dropForeign(['name_id']);
                $table->dropColumn('name_id');
            }
        });

        Schema::table('character_references', function (Blueprint $table) {
            if (Schema::hasColumn('character_references', 'ref_name_id')) {
                $table->dropForeign(['ref_name_id']);
                $table->dropColumn('ref_name_id');
            }
        });

        Schema::table('p_h_s', function (Blueprint $table) {
            if (Schema::hasColumn('p_h_s', 'name_id')) {
                $table->dropForeign(['name_id']);
                $table->dropColumn('name_id');
            }
        });

        Schema::table('children', function (Blueprint $table) {
            if (Schema::hasColumn('children', 'name_id')) {
                $table->dropForeign(['name_id']);
                $table->dropColumn('name_id');
            }
        });
    }
}; 