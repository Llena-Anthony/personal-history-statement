<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('personal_characteristics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('sex', ['male', 'female']);
            $table->integer('age');
            $table->decimal('height', 3, 2); // meters
            $table->decimal('weight', 5, 2); // kg
            $table->enum('body_build', ['heavy', 'medium', 'light']);
            $table->enum('complexion', ['dark', 'fair', 'light']);
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->string('hair_color', 50);
            $table->string('eye_color', 50);
            $table->text('distinguishing_features')->nullable();
            $table->enum('health_status', ['excellent', 'good', 'poor']);
            $table->string('recent_illness')->nullable();
            $table->decimal('shoe_size', 3, 1); // US size
            $table->enum('cap_size', ['XS', 'S', 'M', 'L', 'XL', 'XXL']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personal_characteristics');
    }
}; 