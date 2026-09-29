<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'borrower_type',
        'user_id',
        'external_borrower_name',
        'external_borrower_origin',
        'inventaris_item_id',
        'purpose',
        'quantity',
        'borrow_date',
        'return_date',
        'status',
        'condition_when_borrowed',
        'condition_when_returned',
        'returned_quantity_normal',
        'returned_quantity_damaged',
        'returned_quantity_lost',
        'return_notes',
        'borrow_proof_image',
        'return_proof_image',
        'recorded_by_id',
        'recorder_ip',
        'recorder_location',
        'return_recorded_by_id',
        'return_recorder_ip',
        'return_recorder_location',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inventarisItem(): BelongsTo
    {
        return $this->belongsTo(InventarisItem::class, 'inventaris_item_id');
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by_id');
    }

    public function returnRecordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'return_recorded_by_id');
    }

    protected static function booted()
    {
        static::created(function ($loan) {
            if ($loan->status === 'borrowed' && $loan->inventarisItem) {
                $loan->inventarisItem->decrement('jumlah_tersedia', $loan->quantity);
            }
        });

        static::updated(function ($loan) {
            if ($loan->isDirty('status') && in_array($loan->status, ['returned', 'late', 'damaged', 'lost']) && $loan->getOriginal('status') === 'borrowed') {
                if ($loan->inventarisItem) {
                    $normalQty = (int)$loan->returned_quantity_normal;
                    $damagedQty = (int)$loan->returned_quantity_damaged;
                    $lostQty = (int)$loan->returned_quantity_lost;

                    if ($normalQty > 0) {
                        $loan->inventarisItem->increment('jumlah_tersedia', $normalQty);
                    }
                    
                    if ($lostQty > 0) {
                        $loan->inventarisItem->decrement('jumlah_total', $lostQty);
                    }

                    if ($damagedQty > 0) {
                        \App\Models\LaporanKerusakan::create([
                            'inventaris_item_id' => $loan->inventaris_item_id,
                            'pelapor_user_id' => $loan->return_recorded_by_id ?? auth()->id(),
                            'deskripsi_kerusakan' => "Otomatis: Barang rusak saat dikembalikan sejumlah " . $damagedQty . " unit. Catatan: " . $loan->return_notes,
                            'foto_bukti' => $loan->return_proof_image,
                            'status' => 'pending',
                        ]);
                    }
                }
            }
        });
    }
}
