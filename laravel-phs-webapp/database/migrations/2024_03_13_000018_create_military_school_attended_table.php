<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('military_school_attended', function (Blueprint $table) {
            $table->id('history_id');
            $table->string('username');
            $table->foreignId('school_location')->constrained('address_details', 'addr_id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('date_attended');
            $table->string('nature_of_training');
            $table->string('rating');
            $table->timestamps();

            $table->foreign('username')
                  ->references('username')
                  ->on('military_history')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('military_school_attended');
    }
}; 