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
            // Remove the old date type fields and exact date fields
            if (Schema::hasColumn('military_history', 'commission_date_from_type')) {
                $table->dropColumn('commission_date_from_type');
            }
            if (Schema::hasColumn('military_history', 'commission_date_to_type')) {
                $table->dropColumn('commission_date_to_type');
            }
            if (Schema::hasColumn('military_history', 'start_date_of_commision')) {
                $table->dropColumn('start_date_of_commision');
            }
            if (Schema::hasColumn('military_history', 'end_date_of_commision')) {
                $table->dropColumn('end_date_of_commision');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('military_history', function (Blueprint $table) {
            $table->string('commission_date_from_type')->nullable();
            $table->string('commission_date_to_type')->nullable();
            $table->date('start_date_of_commision')->nullable();
            $table->date('end_date_of_commision')->nullable();
        });
    }
};
