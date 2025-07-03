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
        Schema::create('occupation_detail', function (Blueprint $table) {
            $table->id('occupation_id');
            $table->string('occupation_desc');
            $table->string('employer')->nullable();

            $table->foreignId('occupation_addr')
            ->nullable()
            ->constrained('address_detail','addr_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupation_detail');
    }
};
