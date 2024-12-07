<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role_id', 
        'organizer_id', 
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
  // Di model User.php
public function role()
{
    return $this->belongsTo(Role::class);
}


public function organizer()
{
    return $this->belongsTo(Organizer::class);
}
}
