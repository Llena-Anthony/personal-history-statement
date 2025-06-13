<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('character_references', function (Blueprint $table) {
            $table->id('ref_id');
            $table->string('username');
            $table->string('ref_name');
            $table->string('ref_occupation');
            $table->string('ref_employer');
            $table->foreignId('ref_address')->constrained('address_details', 'addr_id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('ref_contact');
            $table->string('ref_relationship');
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
        Schema::dropIfExists('character_references');
    }
}; 