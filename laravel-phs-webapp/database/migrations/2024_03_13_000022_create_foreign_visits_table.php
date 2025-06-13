<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('foreign_visits', function (Blueprint $table) {
            $table->id('foreign_id');
            $table->string('username');
            $table->date('date_of_visit');
            $table->string('country_visited');
            $table->string('purpose_of_visit');
            $table->foreignId('foreign_address')->constrained('address_details', 'addr_id')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('foreign_visits');
    }
}; 