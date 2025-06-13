<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('school_details', function (Blueprint $table) {
            $table->id('school_id');
            $table->foreignId('location')->constrained('address_details', 'addr_id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('level');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('school_details');
    }
}; 