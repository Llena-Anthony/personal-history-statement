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
        if (Schema::hasTable('siblings')) {
            Schema::table('siblings', function (Blueprint $table) {
                if (!Schema::hasColumn('siblings', 'name_id')) {
                    $table->foreignId('name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('siblings')) {
            Schema::table('siblings', function (Blueprint $table) {
                if (Schema::hasColumn('siblings', 'name_id')) {
                    $table->dropForeign(['name_id']);
                    $table->dropColumn('name_id');
                }
            });
        }
    }
};
