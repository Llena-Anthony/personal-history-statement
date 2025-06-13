<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_details', function (Blueprint $table) {
            $table->string('username');
            $table->string('present_job');
            $table->foreignId('job_addr')->constrained('address_details', 'addr_id')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('rank')->constrained('military_rank', 'rank_id')->onDelete('restrict')->onUpdate('cascade');
            $table->string('afpsn');
            $table->boolean('been_dismissed')->default(false);
            $table->text('reason_for_dismissal')->nullable();
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
        Schema::dropIfExists('job_details');
    }
}; 