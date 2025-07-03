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
        Schema::create('marital_detail', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('marital_stat')->nullable();

            $table->foreignId('spouse')
            ->nullable()
            ->constrained('spouse_detail','spouse_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('username')
            ->constrained('user','username')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marital_detail');
    }
};
