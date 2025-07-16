<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Just ensure columns are varchar(255)
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('home_addr', 255)->nullable()->change();
            $table->string('birth_place', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->bigInteger('home_addr')->nullable()->change();
            $table->bigInteger('birth_place')->nullable()->change();
            // Note: You may need to re-add foreign keys manually if needed
        });
    }
}; 