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
            // Add new separate fields after date_of_birth
            $table->string('citizenship')->nullable()->after('date_of_birth');
            $table->string('address')->nullable()->after('citizenship');
            $table->string('father_name')->nullable()->after('address');
            $table->string('mother_name')->nullable()->after('father_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('children', function (Blueprint $table) {
            // Drop new separate fields
            $table->dropColumn(['citizenship', 'address', 'father_name', 'mother_name']);
        });
    }
};
