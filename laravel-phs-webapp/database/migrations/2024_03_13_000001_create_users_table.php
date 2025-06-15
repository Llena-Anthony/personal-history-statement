<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('usertype');
            $table->string('organic_role');
            $table->string('branch');
            $table->string('created_by');
            $table->boolean('is_active')->default(true);
            $table->string('phs_stat')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}; 