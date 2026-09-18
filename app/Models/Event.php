<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'subtitle', 'description', 
        'event_date', 'start_time', 'end_time',
        'location', 'poster_path', 'status',
        'is_featured', 'is_aftermovie', 'youtube_link',
        'latitude',
        'longitude',
        'visitor_access_instructions', 'location_assistance'
    ];


    public function getStatusAttribute($value)
    {
        if ($value !== 'completed' && $this->event_date && $this->end_time) {
            $endDateTime = \Carbon\Carbon::parse($this->event_date . ' ' . $this->end_time);
            if (now()->greaterThan($endDateTime)) {
                return 'completed';
            }
        }
        return $value;
    }

    public function documentations()
    {
        return $this->hasMany(EventDocumentation::class);
    }

    public function rundowns()
    {
        return $this->hasMany(EventRundown::class)->orderBy('time');
    }
}
