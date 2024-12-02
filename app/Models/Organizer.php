<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        //satuorganizer memiliki banyak user
        return $this->hasMany(User::class, 'organizer');
    }
    public function talents()
    {
        return $this->hasMany(Talent::class, 'organizer');
    }
    public function category()
    {
        //satu organizer memiliki banyak kategori
        return $this->hasMany(Category::class, 'organizer');
    }

}
