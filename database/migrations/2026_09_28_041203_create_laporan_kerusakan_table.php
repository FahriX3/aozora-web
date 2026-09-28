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
        Schema::create('laporan_kerusakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventaris_item_id')->constrained('inventaris_items')->cascadeOnDelete();
            $table->foreignId('pelapor_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('deskripsi_kerusakan');
            $table->string('foto_bukti')->nullable();
            $table->string('status')->default('pending'); // pending, ditinjau, selesai, ditolak
            $table->text('catatan_koordinator')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kerusakan');
    }
};
