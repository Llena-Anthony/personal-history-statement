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
        Schema::create('credit_details', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('other_income_src')->nullable();
            $table->string('saln_detail')->nullable();
            $table->date('saln_date_filed')->nullable();
            $table->double('amount_paid')->nullable();

            $table->foreign('username')
            ->references('username')
            ->on('users')
            ->restrictOnDelete()
            ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_details');
    }
};
