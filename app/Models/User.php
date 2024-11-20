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
        'organizer', 
        'refresh_token'
    ];

     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Menyatakan hubungan dengan tabel roles
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Menyatakan hubungan dengan tabel organizers
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
