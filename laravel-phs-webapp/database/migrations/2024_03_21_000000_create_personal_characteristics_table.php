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
            $table->enum('body_build', ['slim', 'medium', 'athletic', 'heavy']);
            $table->enum('complexion', ['fair', 'medium', 'dark', 'olive']);
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->enum('hair_color', ['black', 'brown', 'blonde', 'red', 'gray', 'white']);
            $table->text('distinguishing_features')->nullable();
            $table->enum('health_status', ['excellent', 'good', 'fair', 'poor']);
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