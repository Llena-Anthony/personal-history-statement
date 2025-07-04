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
        Schema::create('military_school_details', function (Blueprint $table) {
            $table->id('mil_school_id');

            $table->foreignId('school')
            ->nullable()
            ->constrained('school_details','school_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->date('attend_date')->nullable();
            $table->string('train_nature')->nullable();
            $table->string('rating')->nullable();
            $table->string('username')->nullable();

            $table->foreign('username')
            ->references('username')
            ->on('users')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('military_school_details');
    }
};
