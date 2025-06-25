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
        Schema::table('arrest_record', function (Blueprint $table) {
            // Question A: Have you ever been investigated/arrested, indicted or convicted for any violation of law?
            $table->enum('investigated_arrested', ['yes', 'no'])->nullable()->after('case_details');
            $table->text('investigated_arrested_details')->nullable()->after('investigated_arrested');
            
            // Question B: Has any member of your family ever been investigated/arrested, indicted or convicted for any violation of law?
            $table->enum('family_investigated_arrested', ['yes', 'no'])->nullable()->after('investigated_arrested_details');
            $table->text('family_investigated_arrested_details')->nullable()->after('family_investigated_arrested');
            
            // Question C: Have you ever been charged of any administrative case?
            $table->enum('administrative_case', ['yes', 'no'])->nullable()->after('family_investigated_arrested_details');
            $table->text('administrative_case_details')->nullable()->after('administrative_case');
            
            // Question D: Have you ever been arrested or detained pursuant to the provisions of PD 1081 and its implementing orders?
            $table->enum('pd1081_arrested', ['yes', 'no'])->nullable()->after('administrative_case_details');
            $table->text('pd1081_arrested_details')->nullable()->after('pd1081_arrested');
            
            // Question E: Do you take/use intoxicating liquor or narcotics?
            $table->enum('intoxicating_liquor_narcotics', ['yes', 'no'])->nullable()->after('pd1081_arrested_details');
            $table->text('intoxicating_liquor_narcotics_details')->nullable()->after('intoxicating_liquor_narcotics');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arrest_record', function (Blueprint $table) {
            $table->dropColumn([
                'investigated_arrested',
                'investigated_arrested_details',
                'family_investigated_arrested',
                'family_investigated_arrested_details',
                'administrative_case',
                'administrative_case_details',
                'pd1081_arrested',
                'pd1081_arrested_details',
                'intoxicating_liquor_narcotics',
                'intoxicating_liquor_narcotics_details'
            ]);
        });
    }
};
