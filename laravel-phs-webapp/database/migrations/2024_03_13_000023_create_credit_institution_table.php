<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('credit_institution', function (Blueprint $table) {
            $table->id('inst_id');
            $table->string('inst_name');
            $table->foreignId('inst_addr')->constrained('address_details', 'addr_id')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('credit_institution');
    }
}; 