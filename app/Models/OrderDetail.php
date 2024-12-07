<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';

    protected $fillable = [
        'history_ticket_categories',
        'sum_ticket',
        'order_id',
    ];

    protected $casts = [
        'history_ticket_categories' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
