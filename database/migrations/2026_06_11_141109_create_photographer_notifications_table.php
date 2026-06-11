<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photographer_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photographer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('order_item_id')->constrained('order_items')->cascadeOnDelete();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('photo_id')->constrained('photos')->cascadeOnDelete();
            $table->string('type', 50)->default('photo_sold');
            $table->string('title', 120);
            $table->string('message', 255);
            $table->decimal('amount', 10, 2);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->unique(['photographer_id', 'order_item_id']);
            $table->index(['photographer_id', 'read_at', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photographer_notifications');
    }
};
