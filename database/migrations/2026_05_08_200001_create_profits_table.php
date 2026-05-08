<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('source')->nullable(); // e.g. "Investment Return", "Bonus", etc.
            $table->tinyInteger('status')->default(1); // 1 = credited
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profits');
    }
};
