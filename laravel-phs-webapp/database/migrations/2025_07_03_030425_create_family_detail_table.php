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
        Schema::create('family_detail', function (Blueprint $table) {
            $table->id('fam_id');

            $table->foreignId('fam_name')
            ->constrained()
            ->constrained('name_detail','name_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->date('birth_date')->nullable();

            $table->foreignId('birth_place')
            ->nullable()
            ->constrained('address_detail','addr_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('fam_addr')
            ->nullable()
            ->constrained('address_detail','addr_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('occupation')
            ->nullable()
            ->constrained('occupation_detail','occupation_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('citizenship')
            ->nullable()
            ->constrained('citizenship_detail','cit_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('dual')
            ->nullable()
            ->constrained('citizenship_detail','cit_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->date('date_naturalized')->nullable();

            $table->foreignId('place_naturalized')
            ->nullable()
            ->constrained('address_detail','addr_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_detail');
    }
};
