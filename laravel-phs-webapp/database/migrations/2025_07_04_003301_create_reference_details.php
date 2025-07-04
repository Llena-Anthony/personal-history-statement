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
        Schema::create('reference_details', function (Blueprint $table) {
            $table->id('ref_id');

            $table->foreignId('ref_name')
            ->nullable()
            ->constrained('name_details','name_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreignId('ref_addr')
            ->nullable()
            ->constrained('address_details','addr_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->string('ref_type')->nullable();
            $table->string('username')->nullable();

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
        Schema::dropIfExists('reference_details');
    }
};
