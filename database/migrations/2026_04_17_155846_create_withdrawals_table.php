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
            $table->foreignId('photographer_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('bank_name', 50);
            $table->string('bank_account_number', 30);
            $table->string('bank_account_name', 100);
            $table->enum('status', ['pending', 'approved', 'rejected', 'transferred'])
                  ->default('pending');
            $table->foreignId('approved_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamp('transferred_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};