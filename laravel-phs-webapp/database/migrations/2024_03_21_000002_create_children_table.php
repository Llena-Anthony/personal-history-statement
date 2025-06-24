<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Table already exists, skipping creation
        // Schema::create('children', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('marital_status_id')->constrained()->onDelete('cascade');
        //     $table->string('name');
        //     $table->date('birth_date');
        //     $table->string('citizenship_address')->nullable();
        //     $table->string('parent_name')->nullable();
        //     $table->timestamps();
        // });
    }

    public function down()
    {
        Schema::dropIfExists('children');
    }
}; 