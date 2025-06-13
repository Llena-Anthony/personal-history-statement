<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('organization', function (Blueprint $table) {
            $table->id('org_id');
            $table->string('org_name');
            $table->string('org_type');
            $table->foreignId('org_address')->constrained('address_details', 'addr_id')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organization');
    }
}; 