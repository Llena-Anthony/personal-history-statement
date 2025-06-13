<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('military_rank', function (Blueprint $table) {
            $table->id('rank_id');
            $table->string('rank');
            $table->string('rank_desc');
            $table->string('branch');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('military_rank');
    }
}; 