<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    use HasFactory;

    protected $table = 'talents';
    protected $fillable = [
        'name',
        'organizer_id',
        'image_id',
        'role_id',
    ];

    // Relasi dengan tabel Organizer
    public function organizer()
    {
        //satu talent hanya memiliki satu organizer
        return $this->belongsTo(Organizer::class);
    }

    // Relasi dengan tabel Image
    public function image()
    {
        //satu talent hanya memiliki satu image
        return $this->belongsTo(Image::class);
    }

    // Relasi dengan tabel Role
    public function role()
    {
        //satu talent hanya memiliki satu role
        return $this->belongsTo(Role::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
}
