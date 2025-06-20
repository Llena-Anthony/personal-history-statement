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
        Schema::create('credit_reputations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('dependent_on_salary')->nullable();
            $table->boolean('has_loans')->nullable();
            $table->boolean('has_filed_assets_liabilities')->nullable();
            $table->string('assets_liabilities_agency')->nullable();
            $table->date('assets_liabilities_date')->nullable();
            $table->boolean('has_filed_itr')->nullable();
            $table->decimal('itr_amount', 15, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('other_incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_reputation_id')->constrained()->onDelete('cascade');
            $table->string('source');
            $table->timestamps();
        });

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_reputation_id')->constrained()->onDelete('cascade');
            $table->string('bank_name');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('other_incomes');
        Schema::dropIfExists('credit_reputations');
    }
}; 