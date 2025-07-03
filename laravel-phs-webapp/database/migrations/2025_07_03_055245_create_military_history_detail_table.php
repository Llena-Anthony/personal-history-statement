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
        Schema::create('military_history_detail', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->date('enlist_date')->nullable();
            $table->date('start_comm')->nullable();
            $table->date('end_comm')->nullable();
            $table->string('comm_src')->nullable();

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
        Schema::dropIfExists('military_history_detail');
    }
};
