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
        Schema::create('employment_details', function (Blueprint $table) {
            $table->id('employ_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('employ_type')->nullable();
            $table->string('employer')->nullable();

            $table->foreignId('employ_addr')
            ->nullable()
            ->constrained('address_details','addr_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->string('reason_for_leaving')->nullable();
            $table->string('dismissal_desc')->nullable();
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
        Schema::dropIfExists('employment_details');
    }
};
