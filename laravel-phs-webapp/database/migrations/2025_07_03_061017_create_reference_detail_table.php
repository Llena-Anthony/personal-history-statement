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
        Schema::create('reference_detail', function (Blueprint $table) {
            $table->id('ref_id');

            $table->foreignId('ref_name')
            ->nullable()
            ->constrained('name_detail','name_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreignId('ref_addr')
            ->nullable()
            ->constrained('address_detail','addr_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->string('ref_type')->nullable();
            $table->string('username')->nullable();

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
        Schema::dropIfExists('reference_detail');
    }
};
