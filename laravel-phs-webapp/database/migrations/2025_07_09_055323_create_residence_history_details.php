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
        Schema::create('residence_history_details', function (Blueprint $table) {
            $table->string('username');
            $table->unsignedBigInteger('addr');

            $table->foreign('username')->references('username')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('addr')->references('addr_id')->on('address_details')->onDelete('restrict')->onUpdate('cascade');

            $table->primary(['username','addr']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residence_history_details');
    }
};
