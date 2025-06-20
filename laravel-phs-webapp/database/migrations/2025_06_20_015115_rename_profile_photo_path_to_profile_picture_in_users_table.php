<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_picture')->nullable()->after('last_login_at');
        });

        // Copy data from old column to new column
        DB::statement('UPDATE users SET profile_picture = profile_photo_path WHERE profile_photo_path IS NOT NULL');

        // Drop the old column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_photo_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo_path')->nullable()->after('last_login_at');
        });

        // Copy data back from new column to old column
        DB::statement('UPDATE users SET profile_photo_path = profile_picture WHERE profile_picture IS NOT NULL');

        // Drop the new column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_picture');
        });
    }
};
