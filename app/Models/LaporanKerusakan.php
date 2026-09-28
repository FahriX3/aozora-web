<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanKerusakan extends Model
{
    use HasFactory;

    protected $table = 'laporan_kerusakan';

    protected $fillable = [
        'inventaris_item_id',
        'pelapor_user_id',
        'deskripsi_kerusakan',
        'foto_bukti',
        'status',
        'catatan_koordinator',
    ];

    public const STATUS_OPTIONS = [
        'pending' => 'Menunggu Review',
        'ditinjau' => 'Sedang Ditinjau',
        'selesai' => 'Selesai / Diperbaiki',
        'ditolak' => 'Ditolak',
    ];

    public function inventarisItem(): BelongsTo
    {
        return $this->belongsTo(InventarisItem::class, 'inventaris_item_id');
    }

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pelapor_user_id');
    }
}
