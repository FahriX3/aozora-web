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
        Schema::create('inventaris_items', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->string('kategori')->default('lainnya'); // cosplay, properti_matsuri, alat_kaligrafi, elektronik, lainnya
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_total')->default(1);
            $table->integer('jumlah_tersedia')->default(1);
            $table->string('kondisi')->default('baik'); // baik, rusak_ringan, rusak_berat, hilang
            $table->string('lokasi_penyimpanan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris_items');
    }
};
