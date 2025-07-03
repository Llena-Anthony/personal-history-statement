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
        Schema::create('credit_reference_detail', function (Blueprint $table) {
            $table->id('account_id');

            $table->foreignId('bank')
            ->nullable()
            ->constrained('bank_detail','bank_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->string('username');

            $table->foreign('username')
            ->references('username')
            ->on('user')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_reference_detail');
    }
};
