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
        Schema::create('foreign_visit_details', function (Blueprint $table) {
            $table->id('visit_id');
            $table->date('visit_date')->nullable();
            $table->string('visit_purpose')->nullable();

            $table->foreignId('visit_addr')
            ->nullable()
            ->constrained('address_details','addr_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->string('username');

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
        Schema::dropIfExists('foreign_visit_details');
    }
};
