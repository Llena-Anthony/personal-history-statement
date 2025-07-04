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
        Schema::create('activity_log_details', function (Blueprint $table) {
            $table->id('act_id');
            $table->string('changes_made_by');
            $table->string('action')->nullable();
            $table->string('act_desc')->nullable();
            $table->string('act_stat')->nullable();
            $table->string('ip_addr')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('act_date_time')->nullable();
            $table->string('old_value')->nullable();
            $table->string('new_value')->nullable();

            $table->foreign('changes_made_by')
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
        Schema::dropIfExists('activity_log_details');
    }
};
