<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('personal_char', function (Blueprint $table) {
            $table->string('username');
            $table->string('sex');
            $table->integer('age');
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->string('body_build');
            $table->string('complexion');
            $table->string('eye_color');
            $table->string('hair_color');
            $table->text('other_features')->nullable();
            $table->string('health_state');
            $table->text('recent_illness')->nullable();
            $table->string('blood_type');
            $table->decimal('shoesize', 4, 1);
            $table->decimal('headsize', 4, 1);
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
        Schema::dropIfExists('personal_char');
    }
}; 