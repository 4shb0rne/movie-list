<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'dob',
        'image_url',
        'place_of_birth',
        'gender',
        'popularity',
        'biography'
    ];

    public $timestamps = false;

    public function movies() {
        return $this->belongsToMany(Movie::class, 'movie_actors', 'actor_id', 'movie_id')->withPivot('actor_id', 'character_name');
    }

    public function getCharacterNameAttribute() {
        $movie_actor = MovieActor::where('movie_id', '=', $this->movie_id)->where('actor_id','=',$this->id)->first();
        return $movie_actor->character_name;
    }

}
