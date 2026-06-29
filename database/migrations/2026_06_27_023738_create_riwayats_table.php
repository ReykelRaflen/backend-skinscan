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
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('rekomendasi_id')->nullable()->constrained()->onDelete('set null');
            $table->string('hasil_label');
            $table->double('skor_akurasi');
            $table->string('path_gambar')->nullable();
            $table->json('all_scores')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamp('tgl_analisis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
