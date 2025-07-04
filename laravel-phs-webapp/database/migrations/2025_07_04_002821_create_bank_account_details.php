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
        Schema::create('bank_account_details', function (Blueprint $table) {
            $table->id('account_id');

            $table->foreignId('bank')
            ->nullable()
            ->constrained('bank_details','bank_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

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
        Schema::dropIfExists('bank_account_details');
    }
};
