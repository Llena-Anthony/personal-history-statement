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
        Schema::table('military_assignments', function (Blueprint $table) {
            $table->date('date_from')->nullable()->after('assign_id');
            $table->date('date_to')->nullable()->after('date_from');
            $table->string('date_from_type')->nullable()->after('date_from');
            $table->string('date_from_month')->nullable()->after('date_from_type');
            $table->integer('date_from_year')->nullable()->after('date_from_month');
            $table->string('date_to_type')->nullable()->after('date_to');
            $table->string('date_to_month')->nullable()->after('date_to_type');
            $table->integer('date_to_year')->nullable()->after('date_to_month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('military_assignments', function (Blueprint $table) {
            $table->dropColumn([
                'date_from', 'date_to',
                'date_from_type', 'date_from_month', 'date_from_year',
                'date_to_type', 'date_to_month', 'date_to_year'
            ]);
        });
    }
};
