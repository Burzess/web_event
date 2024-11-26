<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'organizer_id'];  // Kolom yang bisa diisi

    // Relasi dengan Organizer
    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'organizer_id');  // Relasi satu ke banyak
    }
}
