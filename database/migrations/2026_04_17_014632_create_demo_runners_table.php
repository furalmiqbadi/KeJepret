<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('demo_runners', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ai_runner_id')->nullable(); // ID di FastAPI
            $table->text('selfie_url');
            $table->string('status')->default('pending'); // pending→enrolled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demo_runners');
    }
};
