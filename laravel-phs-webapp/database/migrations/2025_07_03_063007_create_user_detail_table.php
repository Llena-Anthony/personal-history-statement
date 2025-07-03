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
        Schema::create('user_detail', function (Blueprint $table) {
            $table->string('username')->primary();

            $table->foreignId('full_name')
            ->nullable()
            ->constrained('name_detail','name_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->string(column: 'profile_path')->nullable();

            $table->foreignId('home_addr')
            ->nullable()
            ->constrained('address_detail','addr_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->date('birth_date')->nullable();

            $table->foreignId('birth_place')
            ->nullable()
            ->constrained('address_detail','addr_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('nationality')
            ->nullable()
            ->constrained('citizenship_detail','cit_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->string(column: 'religion')->nullable();
            $table->string(column:'mobile_num')->nullable();
            $table->string(column:'email_addr')->nullable()->unique();

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
        Schema::dropIfExists('user_detail');
    }
};
