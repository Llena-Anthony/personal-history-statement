<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('educational_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('school_name');
            $table->string('degree_course');
            $table->date('period_from');
            $table->date('period_to');
            $table->string('highest_level_units_earned')->nullable();
            $table->string('year_graduated')->nullable();
            $table->string('scholarship_academic_honors')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('educational_backgrounds');
    }
}; 