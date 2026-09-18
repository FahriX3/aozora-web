<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventDocumentation extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'file_path', 'file_type'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
