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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('name_id')->nullable();
            $table->string('role'); // father, mother, spouse, etc.
            $table->unsignedBigInteger('birth_id')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer')->nullable();
            $table->unsignedBigInteger('employment_addr')->nullable();
            $table->string('citizenship')->nullable();
            $table->boolean('isnaturalized')->nullable();
            $table->string('naturalized_details')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('name_id')->references('name_id')->on('name_details')->onDelete('set null');
            $table->foreign('birth_id')->references('birth_id')->on('birth_details')->onDelete('set null');
            $table->foreign('employment_addr')->references('addr_id')->on('address_details')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
