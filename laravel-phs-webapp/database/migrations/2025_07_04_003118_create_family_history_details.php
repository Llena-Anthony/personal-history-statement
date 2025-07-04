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
        Schema::create('family_history_details', function (Blueprint $table) {
            $table->string('username')->primary();

            $table->foreignId('father')
            ->nullable()
            ->constrained('family_details','fam_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('mother')
            ->nullable()
            ->constrained('family_details','fam_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('guardian')
            ->nullable()
            ->constrained('family_details','fam_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('father_in_law')
            ->nullable()
            ->constrained('family_details','fam_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('mother_in_law')
            ->nullable()
            ->constrained('family_details','fam_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_history_details');
    }
};
