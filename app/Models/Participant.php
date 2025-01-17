<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Participant extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'active_code',
        'gauth_id',
        'gauth_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function forgotPasswords()
    {
        return $this->hasMany(ParticipantForgotPassword::class);
    }
}
