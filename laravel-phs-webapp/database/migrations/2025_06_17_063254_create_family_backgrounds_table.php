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
        Schema::create('family_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('father_name');
            $table->string('father_occupation')->nullable();
            $table->string('father_employer')->nullable();
            $table->string('father_business_address')->nullable();
            $table->string('father_telephone', 20)->nullable();
            $table->string('mother_name');
            $table->string('mother_occupation')->nullable();
            $table->string('mother_employer')->nullable();
            $table->string('mother_business_address')->nullable();
            $table->string('mother_telephone', 20)->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->string('spouse_employer')->nullable();
            $table->string('spouse_business_address')->nullable();
            $table->string('spouse_telephone', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_backgrounds');
    }
};
