<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'about',
        'tagline',
        'keypoint',
        'venue_name',
        'status',
        'categories_id',
        'image_id',
        'talent_id',
        'organizer_id',
        'user_id',
    ];

    protected $casts = [
        'keypoint' => 'array',
        'date' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }


    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

    public function talent()
    {
        return $this->belongsTo(Talent::class, 'talent_id');
    }


    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'organizer_id');
    }

    public function ticketCategories()
    {
        return $this->hasMany(TicketCategory::class);
    }

    protected static function booted()
    {
        static::deleting(function ($event) {
            $event->ticketCategories()->delete();
        });
    }
}
