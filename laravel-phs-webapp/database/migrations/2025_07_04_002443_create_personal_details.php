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
        Schema::create('personal_details', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('health_state')->nullable();
            $table->string('illness')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('cap_size')->nullable();
            $table->string('shoe_size')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('undergo_lie_detection')->nullable();

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
        Schema::dropIfExists('personal_details');
    }
};
