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
        Schema::create('demo_photos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ai_photo_id')->nullable(); // ID di FastAPI
            $table->string('filename');
            $table->text('r2_url');
            $table->string('status')->default('pending'); // pending→uploaded→embedded
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demo_photos');
    }
};
