<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('educational_background', function (Blueprint $table) {
            $table->string('username');
            $table->foreignId('educ_details')->constrained('education_details', 'educ_id')->onDelete('restrict')->onUpdate('cascade');
            $table->text('other_training_attended')->nullable();
            $table->date('other_training_date')->nullable();
            $table->string('civil_service_qualification')->nullable();
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
        Schema::dropIfExists('educational_background');
    }
}; 