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
        Schema::create('spouse_detail', function (Blueprint $table) {
            $table->id('spouse_id');

            $table->foreignId('spouse_name')
            ->nullable()
            ->constrained('name_detail','name_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->date(column: 'marr_date')->nullable();

            $table->foreignId('marr_place')
            ->nullable()
            ->constrained('address_detail','addr_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->date(column: 'birth_date')->nullable();

            $table->foreignId('birth_place')
            ->nullable()
            ->constrained('address_detail','addr_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreignId('occupation')
            ->nullable()
            ->constrained('occupation_detail','occupation_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->string('mobile_num')->nullable();

            $table->foreignId('citizenship')
            ->nullable()
            ->constrained('citizenship_detail','cit_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreignId('dual')
            ->nullable()
            ->constrained('citizenship_detail','cit_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spouse_detail');
    }
};
