<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('marital_status', function (Blueprint $table) {
            $table->string('username');
            $table->string('marital_status');
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
        Schema::dropIfExists('marital_status');
    }
}; 