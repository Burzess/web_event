<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'name',
        'status',
        'image_id',
        'organizer_id',
    ];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
