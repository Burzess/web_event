<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
        'organizer', 
        'refresh_token'
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
