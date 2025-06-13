<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('address_details', function (Blueprint $table) {
            $table->id('addr_id');
            $table->string('street');
            $table->string('barangay');
            $table->string('municipality');
            $table->string('province');
            $table->string('city');
            $table->string('country');
            $table->string('zip_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('address_details');
    }
}; 