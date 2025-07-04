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
        Schema::create('membership__details', function (Blueprint $table) {
            $table->string('username');

            $table->foreignId('org')
            ->nullable()
            ->constrained('organization_details','org_id')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->date('mem_date')->nullable();
            $table->string('position')->nullable();

            $table->foreign('username')
            ->references('username')
            ->on('users')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->primary(['username','org']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership__details');
    }
};
