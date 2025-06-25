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
        Schema::table('marital_statuses', function (Blueprint $table) {
            $table->string('marriage_date_type')->nullable()->after('marriage_date');
            $table->string('marriage_month')->nullable()->after('marriage_date_type');
            $table->integer('marriage_year')->nullable()->after('marriage_month');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marital_statuses', function (Blueprint $table) {
            $table->dropColumn(['marriage_date_type', 'marriage_month', 'marriage_year']);
        });
    }
};
