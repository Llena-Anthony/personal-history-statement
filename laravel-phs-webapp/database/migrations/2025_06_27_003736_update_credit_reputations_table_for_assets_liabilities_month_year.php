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
        Schema::table('credit_reputations', function (Blueprint $table) {
            // Add new month/year fields
            $table->string('assets_liabilities_month', 2)->nullable()->after('assets_liabilities_agency');
            $table->integer('assets_liabilities_year')->nullable()->after('assets_liabilities_month');
            
            // Drop the old date field
            $table->dropColumn('assets_liabilities_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('credit_reputations', function (Blueprint $table) {
            // Restore the old date field
            $table->date('assets_liabilities_date')->nullable()->after('assets_liabilities_agency');
            
            // Drop the new month/year fields
            $table->dropColumn(['assets_liabilities_month', 'assets_liabilities_year']);
        });
    }
};
