<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id');
            $table->string('plan');               // Regular Plan, Premium Plan, etc.
            $table->decimal('amount', 15, 2);     // amount invested
            $table->decimal('roi', 5, 2);         // ROI percentage e.g. 50.00
            $table->decimal('profit', 15, 2);     // calculated profit
            $table->decimal('total_return', 15, 2); // amount + profit
            $table->string('duration');           // e.g. "48 Hours", "7 Days"
            $table->timestamp('maturity_at')->nullable(); // when it matures
            $table->tinyInteger('status')->default(0); // 0=active, 1=completed, 2=cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
