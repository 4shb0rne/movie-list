<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $table = 'genres';
    public $timestamps = false;

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'showgenre', 'genre_id', 'show_id', 'genre_id', 'show_id');
    }
}
