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
        Schema::create('arrest_record_detail', function (Blueprint $table) {
            $table->string('username')->primary();

            $table->foreign('username')
                ->references('username')
                ->on('user')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreignId('arr_desc')
                ->nullable()
                ->constrained('arrest_detail','arrest_detail_id')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('fam_arr_desc')
                ->nullable()
                ->constrained('arrest_detail','arrest_detail_id')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->string('admin_case_desc')->nullable();

            $table->foreignId('violation_desc')
                ->nullable()
                ->constrained('arrest_detail','arrest_detail_id')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->string('extent_of_intoxication')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrest_record_detail');
    }
};
