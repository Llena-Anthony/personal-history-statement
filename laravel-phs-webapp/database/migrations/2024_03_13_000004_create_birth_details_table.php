<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('birth_details', function (Blueprint $table) {
            $table->id('birth_id');
            $table->integer('b_date');
            $table->integer('b_month');
            $table->integer('b_year');
            $table->foreignId('b_place')->constrained('address_details', 'addr_id')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('birth_details');
    }
}; 