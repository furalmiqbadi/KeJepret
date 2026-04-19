<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('search_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('event_id')
                  ->nullable()
                  ->constrained('events')
                  ->nullOnDelete();
            $table->string('selfie_r2_path', 255);
            $table->string('ai_runner_id', 100)->nullable();
            $table->enum('enroll_status', ['pending', 'enrolled', 'failed'])
                  ->default('pending');
            $table->enum('search_status', ['pending', 'completed', 'failed'])
                  ->default('pending');
            $table->integer('result_count')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('search_sessions');
    }
};