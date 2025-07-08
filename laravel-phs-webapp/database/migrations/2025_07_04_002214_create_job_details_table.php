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
        Schema::create('job_details', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('service_branch')->nullable();
            $table->string('rank')->nullable();
            $table->string('afpsn')->nullable();
            $table->string('job_desc')->nullable();

            $table->foreignId('job_addr')
            ->nullable()
            ->constrained('address_details','addr_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('username')
            ->references('username')
            ->on('users'
            )->onUpdate('cascade')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_details');
    }
};
