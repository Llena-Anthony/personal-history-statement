<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('children', function (Blueprint $table) {
            if (!Schema::hasColumn('children', 'name_id')) {
                $table->foreignId('name_id')->nullable()->constrained('name_details', 'name_id')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('children', function (Blueprint $table) {
            if (Schema::hasColumn('children', 'name_id')) {
                $table->dropForeign(['name_id']);
                $table->dropColumn('name_id');
            }
        });
    }
}; 