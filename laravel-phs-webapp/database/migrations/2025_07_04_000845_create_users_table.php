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
        Schema::create('users', function (Blueprint $table) {
            $table->string('username',255)->primary();
            $table->string('password');
            $table->string('usertype');
            $table->string('organic_role');
            $table->string('phs_status')->default('pending');
            $table->string('is_active')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->rememberToken();
            // Add timestamps for created_at and updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
