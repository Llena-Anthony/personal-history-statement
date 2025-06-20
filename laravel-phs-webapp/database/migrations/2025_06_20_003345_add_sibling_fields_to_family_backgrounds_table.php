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
        Schema::table('family_backgrounds', function (Blueprint $table) {
            // Sibling 1
            $table->string('sibling1_full_name')->nullable();
            $table->string('sibling1_occupation')->nullable();
            $table->text('sibling1_address')->nullable();
            $table->string('sibling1_contact')->nullable();
            
            // Sibling 2
            $table->string('sibling2_full_name')->nullable();
            $table->string('sibling2_occupation')->nullable();
            $table->text('sibling2_address')->nullable();
            $table->string('sibling2_contact')->nullable();
            
            // Sibling 3
            $table->string('sibling3_full_name')->nullable();
            $table->string('sibling3_occupation')->nullable();
            $table->text('sibling3_address')->nullable();
            $table->string('sibling3_contact')->nullable();
            
            // Sibling 4
            $table->string('sibling4_full_name')->nullable();
            $table->string('sibling4_occupation')->nullable();
            $table->text('sibling4_address')->nullable();
            $table->string('sibling4_contact')->nullable();
            
            // Sibling 5
            $table->string('sibling5_full_name')->nullable();
            $table->string('sibling5_occupation')->nullable();
            $table->text('sibling5_address')->nullable();
            $table->string('sibling5_contact')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('family_backgrounds', function (Blueprint $table) {
            $table->dropColumn([
                'sibling1_full_name', 'sibling1_occupation', 'sibling1_address', 'sibling1_contact',
                'sibling2_full_name', 'sibling2_occupation', 'sibling2_address', 'sibling2_contact',
                'sibling3_full_name', 'sibling3_occupation', 'sibling3_address', 'sibling3_contact',
                'sibling4_full_name', 'sibling4_occupation', 'sibling4_address', 'sibling4_contact',
                'sibling5_full_name', 'sibling5_occupation', 'sibling5_address', 'sibling5_contact',
            ]);
        });
    }
};
