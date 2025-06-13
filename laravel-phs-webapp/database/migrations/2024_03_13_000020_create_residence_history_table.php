<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('residence_history', function (Blueprint $table) {
            $table->string('username');
            $table->foreignId('address_id')->constrained('address_details', 'addr_id')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('from_year');
            $table->integer('to_year');
            $table->timestamps();

            $table->foreign('username')
                  ->references('username')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->primary(['username', 'address_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('residence_history');
    }
}; 