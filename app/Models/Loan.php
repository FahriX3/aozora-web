<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'borrower_type',
        'user_id',
        'external_borrower_name',
        'external_borrower_origin',
        'item_id',
        'quantity',
        'borrow_date',
        'return_date',
        'status',
        'condition_when_borrowed',
        'condition_when_returned',
        'borrow_proof_image',
        'return_proof_image',
        'recorded_by_id',
        'recorder_ip',
        'recorder_location',
        'return_recorded_by_id',
        'return_recorder_ip',
        'return_recorder_location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by_id');
    }

    public function returnRecordedBy()
    {
        return $this->belongsTo(User::class, 'return_recorded_by_id');
    }
}
