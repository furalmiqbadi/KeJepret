<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('demo_photos', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('r2_url');
            $table->json('faces')->nullable(); // [embedding1, embedding2, ...]
            $table->string('status')->default('pending'); // pending, uploaded, embedded
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demo_photos');
    }
};