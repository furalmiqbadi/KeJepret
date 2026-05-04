<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('search_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('search_session_id')
                  ->constrained('search_sessions')
                  ->cascadeOnDelete();
            $table->foreignId('photo_id')
                  ->constrained('photos')
                  ->cascadeOnDelete();
            $table->decimal('similarity_score', 5, 2);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('search_results');
    }
};