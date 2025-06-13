<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('family_history', function (Blueprint $table) {
            $table->id('fam_id');
            $table->string('username');
            $table->foreignId('name')->constrained('name_details', 'name_id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('role');
            $table->foreignId('birthdate')->constrained('birth_details', 'birth_id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('occupation');
            $table->string('employer');
            $table->foreignId('employment_addr')->constrained('address_details', 'addr_id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('citizenship');
            $table->boolean('isnaturalized')->default(false);
            $table->text('naturalized_details')->nullable();
            $table->timestamps();

            $table->foreign('username')
                  ->references('username')
                  ->on('user_details')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_history');
    }
}; 