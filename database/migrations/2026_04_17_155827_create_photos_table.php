<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photographer_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('event_id')
                  ->nullable()
                  ->constrained('events')
                  ->nullOnDelete();
            $table->string('filename', 255);
            $table->string('r2_path', 255);
            $table->string('r2_url', 500);
            $table->string('watermark_path', 255)->nullable();
            $table->decimal('price', 10, 2);
            $table->string('ai_photo_id', 100)->nullable();
            $table->enum('embed_status', ['pending', 'embedded', 'failed'])
                  ->default('pending');
            $table->string('category', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};