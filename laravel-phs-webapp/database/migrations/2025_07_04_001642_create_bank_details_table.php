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
        Schema::create('bank_details', function (Blueprint $table) {
            $table->id('bank_id');
            $table->string('bank');

            $table->foreignId('bank_addr')
            ->nullable()
            ->constrained('address_details','addr_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->unique(['bank','bank_addr']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_details');
    }
};
