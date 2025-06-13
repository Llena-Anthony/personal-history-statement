<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('military_awards', function (Blueprint $table) {
            $table->id('history_id');
            $table->string('decoration_award_or_commendation');
            $table->timestamps();

            $table->foreign('history_id')
                  ->references('history_id')
                  ->on('military_school_attended')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('military_awards');
    }
}; 