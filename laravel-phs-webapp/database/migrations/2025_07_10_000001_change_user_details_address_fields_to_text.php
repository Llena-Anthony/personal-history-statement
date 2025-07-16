<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Drop foreign key for home_addr if it exists
        $fk = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'user_details' AND COLUMN_NAME = 'home_addr' AND CONSTRAINT_SCHEMA = DATABASE() AND REFERENCED_TABLE_NAME IS NOT NULL");
        if (!empty($fk)) {
            $fkName = $fk[0]->CONSTRAINT_NAME;
            DB::statement("ALTER TABLE user_details DROP FOREIGN KEY `$fkName`");
        }
        // Drop foreign key for birth_place if it exists
        $fk = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'user_details' AND COLUMN_NAME = 'birth_place' AND CONSTRAINT_SCHEMA = DATABASE() AND REFERENCED_TABLE_NAME IS NOT NULL");
        if (!empty($fk)) {
            $fkName = $fk[0]->CONSTRAINT_NAME;
            DB::statement("ALTER TABLE user_details DROP FOREIGN KEY `$fkName`");
        }
        // Now change columns to varchar
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('home_addr', 255)->nullable()->change();
            $table->string('birth_place', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->bigInteger('home_addr')->nullable()->change();
            $table->bigInteger('birth_place')->nullable()->change();
            // Note: You may need to re-add foreign keys manually if needed
        });
    }
}; 