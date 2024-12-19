<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 
        'stock', 
        'sum_ticket', 
        'status', 
        'event_id'
    ];

    // Relasi ke Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
