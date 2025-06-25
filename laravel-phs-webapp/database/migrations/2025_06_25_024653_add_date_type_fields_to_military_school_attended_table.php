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
        Schema::table('military_school_attended', function (Blueprint $table) {
            $table->date('exact_date_attended')->nullable()->after('date_attended');
            $table->string('date_attended_type')->nullable()->after('exact_date_attended');
            $table->string('date_attended_month')->nullable()->after('date_attended_type');
            $table->integer('date_attended_year')->nullable()->after('date_attended_month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('military_school_attended', function (Blueprint $table) {
            $table->dropColumn([
                'exact_date_attended', 'date_attended_type', 
                'date_attended_month', 'date_attended_year'
            ]);
        });
    }
};
