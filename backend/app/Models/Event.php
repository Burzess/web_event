<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'date', 'about', 'tagline', 'keypoint', 'venue_name', 'status', 'categories_id', 'image_id', 'talent_id', 'organizer_id'
     ];

    protected $casts = [
        'keypoint' => 'array', 
        'date' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id'); // Sesuaikan jika nama kolom berbeda
    }
    

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function talent()
    {
        return $this->belongsTo(Talent::class);
    }
    

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function ticketCategories()
    {
        return $this->hasMany(TicketCategory::class, 'event');
    }

    protected static function booted()
    {
        static::deleting(function ($event) {
            $event->ticketCategories()->delete();
        });
    }
}
