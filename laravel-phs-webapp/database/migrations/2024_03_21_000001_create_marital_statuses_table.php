<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('marital_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('marital_status');
            $table->string('spouse_first_name')->nullable();
            $table->string('spouse_middle_name')->nullable();
            $table->string('spouse_last_name')->nullable();
            $table->string('spouse_suffix', 10)->nullable();
            $table->date('marriage_date')->nullable();
            $table->string('marriage_place')->nullable();
            $table->date('spouse_birth_date')->nullable();
            $table->string('spouse_birth_place')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->string('spouse_employer')->nullable();
            $table->string('spouse_employment_place')->nullable();
            $table->string('spouse_contact', 20)->nullable();
            $table->string('spouse_citizenship', 100)->nullable();
            $table->string('spouse_other_citizenship', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marital_statuses');
    }
}; 