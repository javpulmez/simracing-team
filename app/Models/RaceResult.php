<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RaceResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'race_id',
        'user_id',
        'position',
        'points',
        'fastest_lap',
        'notes',
    ];

    public function race()
    {
        return $this->belongsTo(Race::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}