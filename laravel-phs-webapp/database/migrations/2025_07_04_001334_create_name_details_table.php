<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('name_details', function (Blueprint $table) {
            $table->id('name_id');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('nickname')->nullable();
            $table->string('change_in_name')->nullable();

            $table->unique(['first_name','last_name','middle_name','suffix'],'full_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('name_details');
    }
};
