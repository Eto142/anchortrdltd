<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id');
            $table->decimal('amount', 15, 2);
            $table->string('method'); // btc, eth, usdt, bank
            // Crypto fields
            $table->string('wallet_address')->nullable();
            // Bank fields
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('swift_code')->nullable();
            // Extra
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(0); // 0=pending, 1=approved, 2=rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
