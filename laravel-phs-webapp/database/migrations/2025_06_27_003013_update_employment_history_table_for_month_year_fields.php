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
        Schema::table('employment_history', function (Blueprint $table) {
            // Add new month/year fields if they don't exist
            if (!Schema::hasColumn('employment_history', 'from_month')) {
                $table->string('from_month', 2)->nullable()->after('username');
            }
            if (!Schema::hasColumn('employment_history', 'from_year')) {
                $table->integer('from_year')->nullable()->after('from_month');
            }
            if (!Schema::hasColumn('employment_history', 'to_month')) {
                $table->string('to_month', 2)->nullable()->after('from_year');
            }
            if (!Schema::hasColumn('employment_history', 'to_year')) {
                $table->integer('to_year')->nullable()->after('to_month');
            }
            if (!Schema::hasColumn('employment_history', 'type')) {
                $table->string('type')->nullable()->after('to_year');
            }
            if (!Schema::hasColumn('employment_history', 'employer_address')) {
                $table->string('employer_address')->nullable()->after('type');
            }
            if (!Schema::hasColumn('employment_history', 'reason_leaving')) {
                $table->string('reason_leaving')->nullable()->after('employer_address');
            }
        });
        // Drop old fields that are no longer needed (only if they exist, one at a time)
        // if (Schema::hasColumn('employment_history', 'inclusive_dates')) {
        //     Schema::table('employment_history', function (Blueprint $table) {
        //         $table->dropColumn('inclusive_dates');
        //     });
        // }
        // if (Schema::hasColumn('employment_history', 'employment_type')) {
        //     Schema::table('employment_history', function (Blueprint $table) {
        //         $table->dropColumn('employment_type');
        //     });
        // }
        // if (Schema::hasColumn('employment_history', 'employment_address')) {
        //     Schema::table('employment_history', function (Blueprint $table) {
        //         $table->dropColumn('employment_address');
        //     });
        // }
        // if (Schema::hasColumn('employment_history', 'employment_reason_for_leaving')) {
        //     Schema::table('employment_history', function (Blueprint $table) {
        //         $table->dropColumn('employment_reason_for_leaving');
        //     });
        // }
        // if (Schema::hasColumn('employment_history', 'employer_addr')) {
        //     Schema::table('employment_history', function (Blueprint $table) {
        //         $table->dropColumn('employer_addr');
        //     });
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employment_history', function (Blueprint $table) {
            // Restore old fields
            $table->string('inclusive_dates', 100)->after('username');
            $table->string('employment_type')->after('inclusive_dates');
            $table->string('employment_address')->after('employment_type');
            $table->text('employment_reason_for_leaving')->after('employment_address');
            $table->string('employer_addr')->after('employment_reason_for_leaving');
            
            // Drop new fields
            $table->dropColumn([
                'from_month',
                'from_year',
                'to_month',
                'to_year',
                'type',
                'employer_address',
                'reason_leaving'
            ]);
        });
    }
};
