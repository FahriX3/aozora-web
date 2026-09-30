<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventarisItem extends Model
{
    use HasFactory;

    protected $table = 'inventaris_items';

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'kategori',
        'deskripsi',
        'jumlah_total',
        'jumlah_tersedia',
        'kondisi',
        'lokasi_penyimpanan',
        'foto',
    ];

    protected $casts = [
        'jumlah_total' => 'integer',
        'jumlah_tersedia' => 'integer',
    ];

    public const KATEGORI_OPTIONS = [
        'cosplay' => 'Cosplay & Kostum',
        'properti_matsuri' => 'Properti Matsuri',
        'alat_kaligrafi' => 'Alat Kaligrafi (Shodo)',
        'elektronik' => 'Elektronik & Multimedia',
        'lainnya' => 'Lainnya',
    ];

    public const KONDISI_OPTIONS = [
        'baik' => 'Baik',
        'rusak_ringan' => 'Rusak Ringan',
        'rusak_berat' => 'Rusak Berat',
        'hilang' => 'Hilang',
    ];

    public function transaksi(): HasMany
    {
        return $this->hasMany(TransaksiInventaris::class, 'inventaris_item_id');
    }

    public function laporanKerusakan(): HasMany
    {
        return $this->hasMany(LaporanKerusakan::class, 'inventaris_item_id');
    }
}
