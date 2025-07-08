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
        Schema::create('arrest_details', function (Blueprint $table) {
            $table->id('arrest_detail_id');
            $table->string('court_name')->nullable();
            $table->string('nature_of_offense')->nullable();
            $table->string('disposition_of_case')->nullable();

            $table->unique(['court_name','nature_of_offense','disposition_of_case'],'full_arr_detail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrest_details');
    }
};
