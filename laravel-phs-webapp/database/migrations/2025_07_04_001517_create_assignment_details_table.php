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
        Schema::create('assignment_details', function (Blueprint $table) {
            $table->id('assign_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('assign_unit')->nullable();
            $table->string('assign_chief')->nullable();
            $table->string('username');

            $table->foreign('username')
            ->references('username')
            ->on('users')
            ->restrictOnDelete()
            ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_details');
    }
};
