<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiInventaris extends Model
{
    use HasFactory;

    protected $table = 'transaksi_inventaris';

    protected $fillable = [
        'inventaris_item_id',
        'user_id',
        'tipe',
        'jumlah',
        'keterangan',
        'tanggal',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'tanggal' => 'date',
    ];

    protected static function booted(): void
    {
        static::created(function (TransaksiInventaris $transaksi) {
            $item = $transaksi->inventarisItem;
            if ($item) {
                if ($transaksi->tipe === 'keluar') {
                    $item->decrement('jumlah_tersedia', $transaksi->jumlah);
                } elseif ($transaksi->tipe === 'masuk') {
                    $item->increment('jumlah_tersedia', $transaksi->jumlah);
                }
            }
        });
    }

    public function inventarisItem(): BelongsTo
    {
        return $this->belongsTo(InventarisItem::class, 'inventaris_item_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
