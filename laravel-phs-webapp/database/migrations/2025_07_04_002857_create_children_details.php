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
        Schema::create('children_details', function (Blueprint $table) {
            $table->id('child_id');

            $table->foreignId('child_name')
            ->nullable()
            ->constrained('name_details','name_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->date('birth_date')->nullable();

            $table->foreignId('citizenship')
            ->nullable()
            ->constrained('citizenship_details','cit_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('addr')
            ->nullable()
            ->constrained('address_details','addr_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('other_parent')
            ->nullable()
            ->constrained('name_details','name_id')
            ->restrictOnDelete()
            ->cascadeOnUpdate();

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
        Schema::dropIfExists('children_details');
    }
};
