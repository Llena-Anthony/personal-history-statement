<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('name_details', function (Blueprint $table) {
            $table->id('name_id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('name_extension')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('name_details');
    }
}; 