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
        Schema::table('children', function (Blueprint $table) {
            // Add new separate fields after birth_date
            if (!Schema::hasColumn('children', 'citizenship')) {
                $table->string('citizenship')->nullable()->after('birth_date');
            }
            if (!Schema::hasColumn('children', 'address')) {
                $table->string('address')->nullable()->after('citizenship');
            }
            if (!Schema::hasColumn('children', 'father_name')) {
                $table->string('father_name')->nullable()->after('address');
            }
            if (!Schema::hasColumn('children', 'mother_name')) {
                $table->string('mother_name')->nullable()->after('father_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('children', function (Blueprint $table) {
            // Drop new separate fields
            $columnsToDrop = ['citizenship', 'address', 'father_name', 'mother_name'];
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('children', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
