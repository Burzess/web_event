<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'date', 'about', 'tagline', 'keypoint', 'venue_name', 'status', 'categories', 'image', 'talent', 'organizer'
    ];

    protected $casts = [
        'keypoint' => 'array', // Untuk tipe data JSON
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories');
    }

    public function image()
    {
        return $this->belongsTo(Image::class, 'image');
    }

    public function talent()
    {
        return $this->belongsTo(Talent::class, 'talent');
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'organizer');
    }
}
