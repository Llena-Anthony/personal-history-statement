<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('children_details', function (Blueprint $table) {
            $table->id('child_id');
            $table->string('username');
            $table->string('child_name');
            $table->date('child_dob');
            $table->string('child_citizenship_address');
            $table->string('parent_name');
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
        Schema::dropIfExists('children_details');
    }
}; 