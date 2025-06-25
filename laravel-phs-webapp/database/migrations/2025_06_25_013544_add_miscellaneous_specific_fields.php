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
        Schema::table('miscellaneous', function (Blueprint $table) {
            // Add specific fields for the new miscellaneous structure
            $table->text('hobbies_sports_pastimes')->nullable()->after('misc_details');
            $table->text('languages_dialects')->nullable()->after('hobbies_sports_pastimes');
            $table->enum('lie_detection_test', ['yes', 'no'])->nullable()->after('languages_dialects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('miscellaneous', function (Blueprint $table) {
            $table->dropColumn(['hobbies_sports_pastimes', 'languages_dialects', 'lie_detection_test']);
        });
    }
};
