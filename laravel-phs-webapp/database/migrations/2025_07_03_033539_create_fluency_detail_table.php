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
        Schema::create('fluency_detail', function (Blueprint $table) {
            $table->string('username');

            $table->foreignId('lang')
            ->constrained('language_detail','lang_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->string('speak_fluency')->nullable();
            $table->string('read_fluency')->nullable();
            $table->string('write_fluency')->nullable();

            $table->foreign('username')
            ->references('username')
            ->on('user')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->primary(['username','lang']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fluency_detail');
    }
};
