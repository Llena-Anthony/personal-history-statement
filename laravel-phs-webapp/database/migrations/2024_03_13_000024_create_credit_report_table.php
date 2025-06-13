<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('credit_report', function (Blueprint $table) {
            $table->id('credit_id');
            $table->string('username', 100);
            $table->foreignId('institution')->constrained('credit_institution', 'inst_id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('account_type');
            $table->string('account_number');
            $table->string('account_status');
            $table->timestamps();

            $table->foreign('username')
                  ->references('username')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('credit_report');
    }
}; 