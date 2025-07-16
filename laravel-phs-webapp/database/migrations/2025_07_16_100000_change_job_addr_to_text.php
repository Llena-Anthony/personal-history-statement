<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Drop foreign key for job_addr if it exists
        $fk = DB::select("SELECT CONSTRAINT_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_NAME = 'job_details' AND COLUMN_NAME = 'job_addr' AND CONSTRAINT_SCHEMA = DATABASE() AND REFERENCED_TABLE_NAME IS NOT NULL");
        if (!empty($fk)) {
            $fkName = $fk[0]->CONSTRAINT_NAME;
            DB::statement("ALTER TABLE job_details DROP FOREIGN KEY `$fkName`");
        }
        // Change job_addr to varchar(255)
        Schema::table('job_details', function (Blueprint $table) {
            $table->string('job_addr', 255)->nullable()->change();
        });
    }

    public function down(): void
    {
        // Revert job_addr to bigint
        Schema::table('job_details', function (Blueprint $table) {
            $table->bigInteger('job_addr')->nullable()->change();
        });
    }
}; 