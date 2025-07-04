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
        Schema::create('user_details', function (Blueprint $table) {
            $table->string('username')->primary();

            $table->foreignId('full_name')
            ->nullable()
            ->constrained('name_details','name_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->string(column: 'profile_path')->nullable();

            $table->foreignId('home_addr')
            ->nullable()
            ->constrained('address_details','addr_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->date('birth_date')->nullable();

            $table->foreignId('birth_place')
            ->nullable()
            ->constrained('address_details','addr_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('nationality')
            ->nullable()
            ->constrained('citizenship_details','cit_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->string(column: 'religion')->nullable();
            $table->string(column:'mobile_num')->nullable();
            $table->string(column:'email_addr')->nullable()->unique();

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
        Schema::dropIfExists('user_details');
    }
};
