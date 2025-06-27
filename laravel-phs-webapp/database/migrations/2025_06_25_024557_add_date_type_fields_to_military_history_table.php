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
        Schema::table('military_history', function (Blueprint $table) {
            if (Schema::hasColumn('military_history', 'date_enlisted_afp')) {
                $table->dropColumn('date_enlisted_afp');
            }
            if (Schema::hasColumn('military_history', 'enlistment_date_type')) {
                $table->dropColumn('enlistment_date_type');
            }
            $table->string('enlistment_month')->nullable()->after('date_enlisted_afp');
            $table->integer('enlistment_year')->nullable()->after('enlistment_month');
            $table->string('commission_date_from_type')->nullable()->after('start_date_of_commision');
            $table->string('commission_date_from_month')->nullable()->after('commission_date_from_type');
            $table->integer('commission_date_from_year')->nullable()->after('commission_date_from_month');
            $table->string('commission_date_to_type')->nullable()->after('end_date_of_commision');
            $table->string('commission_date_to_month')->nullable()->after('commission_date_to_type');
            $table->integer('commission_date_to_year')->nullable()->after('commission_date_to_month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('military_history', function (Blueprint $table) {
            $table->dropColumn([
                'enlistment_month', 'enlistment_year',
                'commission_date_from_type', 'commission_date_from_month', 'commission_date_from_year',
                'commission_date_to_type', 'commission_date_to_month', 'commission_date_to_year'
            ]);
        });
    }
};
