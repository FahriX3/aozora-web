<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected $casts = [
        'is_featured' => 'boolean',
        'is_aftermovie' => 'boolean',
    ];

    public function getStatusAttribute($value)
    {
        if ($value !== 'completed' && ! empty($this->attributes['event_date']) && ! empty($this->attributes['end_time'])) {
            $rawDate = Str::before((string) $this->attributes['event_date'], ' ');
            $rawTime = trim((string) $this->attributes['end_time']);

            try {
                $endDateTime = Carbon::parse($rawDate . ' ' . $rawTime);
                if (now()->greaterThan($endDateTime)) {
                    return 'completed';
                }
            } catch (\Throwable) {
                // Fallback safely if date format is invalid
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
