<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('membership_details', function (Blueprint $table) {
            $table->id('membership_id');
            $table->string('username');
            $table->foreignId('org_id')->constrained('organization', 'org_id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('membership_type');
            $table->date('date_joined');
            $table->date('date_ended')->nullable();
            $table->string('position_held')->nullable();
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
        Schema::dropIfExists('membership_details');
    }
}; 