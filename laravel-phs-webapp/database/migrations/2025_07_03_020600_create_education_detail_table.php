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
        Schema::create('education_detail', function (Blueprint $table) {
            $table->id('educ_id');

            $table->foreignId('school')
            ->nullable()
            ->constrained('school_detail','school_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->string('educ_level')->nullable();
            $table->date('attend_date')->nullable();
            $table->date('year_grad')->nullable();
            $table->string('other_training')->nullable();
            $table->string('civil_service')->nullable();
            $table->string('username')->nullable();

            $table->foreign('username')
            ->references('user')
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
        Schema::dropIfExists('education_detail');
    }
};
