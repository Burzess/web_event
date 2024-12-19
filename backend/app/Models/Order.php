<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'date',
        'status',
        'total_pay',
        'total_order_ticket',
        'participant_id',
        'event_id',
        'personalDetail',
    ];

    protected $casts = [
        'personalDetail' => 'array',
    ];
    
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
