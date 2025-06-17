<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('family_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('spouse_first_name')->nullable();
            $table->string('spouse_middle_name')->nullable();
            $table->string('spouse_last_name')->nullable();
            $table->string('spouse_suffix')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->string('spouse_employer')->nullable();
            $table->string('spouse_business_address')->nullable();
            $table->string('spouse_telephone')->nullable();
            $table->string('father_first_name');
            $table->string('father_middle_name');
            $table->string('father_last_name');
            $table->string('father_suffix')->nullable();
            $table->string('mother_first_name');
            $table->string('mother_middle_name');
            $table->string('mother_last_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_backgrounds');
    }
}; 