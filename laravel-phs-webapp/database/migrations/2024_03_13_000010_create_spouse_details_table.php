<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('spouse_details', function (Blueprint $table) {
            $table->string('username');
            $table->string('spouse_name');
            $table->date('date_of_marriage');
            $table->string('place_of_marriage');
            $table->date('spouse_dob');
            $table->string('spouse_birthplace');
            $table->string('spouse_occupation');
            $table->string('spouse_employer');
            $table->string('contact_number');
            $table->string('citizenship');
            $table->string('dual_citizenship')->nullable();
            $table->timestamps();

            $table->foreign('username')
                  ->references('username')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->primary('username');
        });
    }

    public function down()
    {
        Schema::dropIfExists('spouse_details');
    }
}; 