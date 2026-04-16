<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('demo_runners', function (Blueprint $table) {
            $table->id();
            $table->string('selfie_url');
            $table->json('embedding'); // runner face vector
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demo_runners');
    }
};