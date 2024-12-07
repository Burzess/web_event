<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantForgotPassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'status',
        'active_code',
        'participant_id',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
