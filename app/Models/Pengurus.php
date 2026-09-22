<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $fillable = [
        'nama',
        'kelas',
        'jabatan',
        'sub_jabatan',
        'divisi',
        'avatar',
        'user_id',
        'urutan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
