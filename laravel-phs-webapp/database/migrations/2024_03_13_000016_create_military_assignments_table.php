<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('military_assignments', function (Blueprint $table) {
            $table->id('assign_id');
            $table->string('inclusive_dates');
            $table->string('unit_office');
            $table->string('co_or_chief_of_office');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('military_assignments');
    }
}; 