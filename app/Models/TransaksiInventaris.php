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
        'jumlah'  => 'integer',
        'tanggal' => 'date',
    ];

    public function inventarisItem(): BelongsTo
    {
        return $this->belongsTo(InventarisItem::class, 'inventaris_item_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
