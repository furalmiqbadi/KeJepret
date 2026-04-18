<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->cascadeOnDelete();
            $table->foreignId('photo_id')
                  ->constrained('photos')
                  ->cascadeOnDelete();
            $table->foreignId('photographer_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->decimal('price', 10, 2);
            $table->decimal('photographer_amount', 10, 2);
            $table->string('download_token', 100)->unique()->nullable();
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};