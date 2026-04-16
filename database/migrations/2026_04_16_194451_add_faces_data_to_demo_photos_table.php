<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up(): void
        {
            Schema::table('demo_photos', function (Blueprint $table) {
                // Kita pakai tipe text agar bisa nampung JSON yang panjang
                $table->text('faces_data')->nullable(); 
            });
        }

        public function down(): void
        {
            Schema::table('demo_photos', function (Blueprint $table) {
                $table->dropColumn('faces_data');
            });
        }
};
