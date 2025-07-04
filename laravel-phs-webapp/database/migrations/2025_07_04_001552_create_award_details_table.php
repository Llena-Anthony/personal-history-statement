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
        Schema::create('award_details', function (Blueprint $table) {
            $table->id('award_id');
            $table->string('award_desc')->nullable();
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
        Schema::dropIfExists('award_details');
    }
};
