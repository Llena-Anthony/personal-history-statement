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
            // Drop the old spouse_name_id column if it exists
            if (Schema::hasColumn('marital_statuses', 'spouse_name_id')) {
                $table->dropForeign(['spouse_name_id']);
                $table->dropColumn('spouse_name_id');
            }
            
            // Add the new spouse name columns
            $table->string('spouse_first_name')->nullable()->after('marital_status');
            $table->string('spouse_middle_name')->nullable()->after('spouse_first_name');
            $table->string('spouse_last_name')->nullable()->after('spouse_middle_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marital_statuses', function (Blueprint $table) {
            // Drop the new spouse name columns
            $table->dropColumn(['spouse_first_name', 'spouse_middle_name', 'spouse_last_name']);
            
            // Re-add the old spouse_name_id column
            $table->foreignId('spouse_name_id')->nullable()->constrained('name_details');
        });
    }
};
