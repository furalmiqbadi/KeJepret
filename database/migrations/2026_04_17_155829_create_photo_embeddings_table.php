<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Aktifkan ekstensi pgvector
        DB::statement('CREATE EXTENSION IF NOT EXISTS vector');

        Schema::create('photo_embeddings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photo_id')
                  ->constrained('photos')
                  ->cascadeOnDelete();
            $table->string('ai_photo_id')->nullable();
            $table->integer('face_index')->default(0);
            $table->timestamps();
        });

        // Tambah kolom vector manual karena Blueprint belum support vector
        DB::statement('ALTER TABLE photo_embeddings ADD COLUMN embedding vector(512)');
    }

    public function down(): void
    {
        Schema::dropIfExists('photo_embeddings');
    }
};