<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('history_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->string('username');
            $table->string('action');
            $table->string('table_affected');
            $table->text('details');
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
        Schema::dropIfExists('history_logs');
    }
}; 