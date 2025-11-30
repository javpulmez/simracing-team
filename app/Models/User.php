<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relaciones
    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    public function races()
    {
        return $this->belongsToMany(Race::class, 'race_user')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function raceResults()
    {
        return $this->hasMany(RaceResult::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    // Helpers
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPilot()
    {
        return $this->role === 'pilot';
    }
}