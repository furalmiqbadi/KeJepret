<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('photo_id')
                  ->constrained('photos')
                  ->cascadeOnDelete();
            $table->decimal('price', 10, 2);
            $table->timestamp('created_at')->useCurrent();

            // 1 foto tidak bisa masuk keranjang 2x oleh user yang sama
            $table->unique(['user_id', 'photo_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};