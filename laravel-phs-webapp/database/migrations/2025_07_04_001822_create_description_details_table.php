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
        Schema::create('description_details', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('sex')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->unsignedDecimal('height',3,2)->nullable();
            $table->unsignedDecimal('weight',5,2)->nullable();
            $table->string('body_build')->nullable();
            $table->string('complexion')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('other_marks')->nullable();

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
        Schema::dropIfExists('description_details');
    }
};
