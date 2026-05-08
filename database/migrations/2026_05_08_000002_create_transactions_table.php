<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id');
            $table->string('transaction_type'); // deposit, withdrawal, etc.
            $table->string('transaction');      // description / label
            $table->string('credit')->default('0');
            $table->string('debit')->default('0');
            $table->tinyInteger('status')->default(0); // 0=pending, 1=approved
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
