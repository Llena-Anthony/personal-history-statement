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
        Schema::table('personal_characteristics', function (Blueprint $table) {
            $table->enum('eye_color', ['black', 'brown', 'blue', 'green', 'gray', 'hazel', 'other'])->after('hair_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_characteristics', function (Blueprint $table) {
            $table->dropColumn('eye_color');
        });
    }
};
