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
            // Add enlistment date fields (these don't exist yet, so no need to drop)
            $table->string('enlistment_month')->nullable();
            $table->integer('enlistment_year')->nullable();
            
            // Add commission date type fields
            $table->string('commission_date_from_type')->nullable();
            $table->string('commission_date_from_month')->nullable();
            $table->integer('commission_date_from_year')->nullable();
            $table->string('commission_date_to_type')->nullable();
            $table->string('commission_date_to_month')->nullable();
            $table->integer('commission_date_to_year')->nullable();
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
