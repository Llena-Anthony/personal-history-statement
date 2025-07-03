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
        Schema::create('sibling_detail', function (Blueprint $table) {
            $table->id('sib_id');

            $table->foreignId('sib_detail')
            ->nullable()
            ->constrained('family_detail','fam_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->string('username');

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
        Schema::dropIfExists('sibling_detail');
    }
};
