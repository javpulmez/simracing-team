<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Race extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'circuit',
        'game',
        'race_date',
        'max_participants',
        'status',
    ];

    protected $casts = [
        'race_date' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'race_user')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function results()
    {
        return $this->hasMany(RaceResult::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}