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
        Schema::table('family_members', function (Blueprint $table) {
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('complete_address')->nullable();
            $table->string('citizenship_type')->nullable();
            $table->string('citizenship_dual_1')->nullable();
            $table->string('citizenship_dual_2')->nullable();
            $table->string('citizenship_naturalized')->nullable();
            $table->string('naturalized_month')->nullable();
            $table->integer('naturalized_year')->nullable();
            $table->string('naturalized_place')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('family_members', function (Blueprint $table) {
            $table->dropColumn([
                'birth_date',
                'birth_place',
                'complete_address',
                'citizenship_type',
                'citizenship_dual_1',
                'citizenship_dual_2',
                'citizenship_naturalized',
                'naturalized_month',
                'naturalized_year',
                'naturalized_place',
            ]);
        });
    }
};
