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
            $table->string('date_attended_from_month')->nullable();
            $table->integer('date_attended_from_year')->nullable();
            $table->string('date_attended_to_month')->nullable();
            $table->integer('date_attended_to_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('military_school_attended', function (Blueprint $table) {
            $table->dropColumn([
                'date_attended_from_month', 'date_attended_from_year',
                'date_attended_to_month', 'date_attended_to_year'
            ]);
        });
    }
};
