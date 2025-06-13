<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employment_history', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100);
            $table->string('inclusive_dates', 100);
            $table->string('employment_type');
            $table->string('employment_address');
            $table->text('employment_reason_for_leaving');
            $table->string('employer_name');
            $table->string('employer_addr');
            $table->timestamps();

            $table->foreign('username')
                  ->references('username')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->unique(['username', 'inclusive_dates']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('employment_history');
    }
}; 