<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('password');
            $table->string('usertype');
            $table->string('organic_role');
            $table->string('branch');
            $table->string('created_by');
            $table->boolean('is_active')->default(true);
            $table->string('phs_stat')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}; 