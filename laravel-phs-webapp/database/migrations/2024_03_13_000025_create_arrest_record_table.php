<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('arrest_record', function (Blueprint $table) {
            $table->id('arrest_id');
            $table->string('username', 100);
            $table->date('date_of_arrest');
            $table->string('case_number');
            $table->string('arresting_agency');
            $table->string('place_of_arrest');
            $table->string('case_status');
            $table->text('case_details');
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
        Schema::dropIfExists('arrest_record');
    }
}; 