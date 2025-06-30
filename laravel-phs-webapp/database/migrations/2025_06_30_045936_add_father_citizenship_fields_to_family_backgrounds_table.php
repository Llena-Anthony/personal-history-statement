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
            // Father citizenship fields to match mother's structure
            $table->string('father_citizenship_type')->nullable();
            $table->string('father_citizenship_dual_1')->nullable();
            $table->string('father_citizenship_dual_2')->nullable();
            $table->string('father_citizenship_naturalized')->nullable();
            $table->string('father_naturalized_month')->nullable();
            $table->integer('father_naturalized_year')->nullable();
            $table->string('father_naturalized_place')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('family_backgrounds', function (Blueprint $table) {
            $table->dropColumn([
                'father_citizenship_type',
                'father_citizenship_dual_1',
                'father_citizenship_dual_2',
                'father_citizenship_naturalized',
                'father_naturalized_month',
                'father_naturalized_year',
                'father_naturalized_place'
            ]);
        });
    }
};
