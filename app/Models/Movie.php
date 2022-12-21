<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $dates = ['release_date'];
    protected $fillable = [
        'title',
        'description',
        'director',
        'release_date',
        'image_url',
        'background_url',
    ];

    public function genres() {
        return $this->belongsToMany(Genre::class, 'movie_genres', 'movie_id', 'genre_id');
    }

    public function actors()
    {   
        return $this->belongsToMany(Actor::class, 'movie_actors', 'movie_id', 'actor_id')->withPivot('actor_id', 'character_name');
    }
}
