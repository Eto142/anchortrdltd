<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('email')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('method'); // btc, eth, usdt, bank
            $table->string('transaction_id')->nullable(); // user-provided TX ID
            $table->string('payment_proof')->nullable(); // file path
            $table->text('notes')->nullable();
            $table->tinyInteger('status')->default(0); // 0=pending, 1=approved, 2=rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
