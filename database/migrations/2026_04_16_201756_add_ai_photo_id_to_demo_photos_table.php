<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('demo_photos', function (Blueprint $table) {
            // Kita pakai bigInteger karena angka dari time() + rand() itu panjang
            // Agar tidak kena error "integer out of range" lagi
            $table->bigInteger('ai_photo_id')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('demo_photos', function (Blueprint $table) {
            $table->dropColumn('ai_photo_id');
        });
    }
};