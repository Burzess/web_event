<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    use HasFactory;

    protected $table = 'talents';
    protected $fillable = ['name', 'organizer', 'image', 'role'];

    // Relasi dengan organizer
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    // Relasi dengan image
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    // Relasi dengan role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
