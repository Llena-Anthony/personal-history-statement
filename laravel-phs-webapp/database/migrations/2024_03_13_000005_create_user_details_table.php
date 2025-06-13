<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->foreignId('name')->constrained('name_details', 'name_id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('profile_pic')->nullable();
            $table->foreignId('home_addr')->constrained('address_details', 'addr_id')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('birth')->constrained('birth_details', 'birth_id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nationality');
            $table->string('tin')->nullable();
            $table->string('religion')->nullable();
            $table->string('mobile_num')->nullable();
            $table->string('email_addr')->nullable();
            $table->string('passport_num')->nullable();
            $table->date('passport_exp')->nullable();
            $table->string('change_in_name')->nullable();
            $table->timestamps();

            $table->foreign('username')
                  ->references('username')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}; 