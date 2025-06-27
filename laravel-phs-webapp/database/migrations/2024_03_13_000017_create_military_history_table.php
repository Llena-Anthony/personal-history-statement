<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('military_history', function (Blueprint $table) {
            $table->string('username');
            $table->date('start_date_of_commision');
            $table->date('end_date_of_commision')->nullable();
            $table->string('source_of_commision');
            $table->foreignId('military_assign')->constrained('military_assignments', 'assign_id')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();

            $table->foreign('username')
                  ->references('username')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->primary('username');
        });
    }

    public function down()
    {
        Schema::dropIfExists('military_history');
    }
}; 