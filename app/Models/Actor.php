<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;
    protected $table = 'actors';
    protected $fillable = ['name', 'dob', 'image_url', 'place_of_birth', 'gender', 'popularity', 'biography'];

    public $timestamps = false;

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'casts', 'actor_id', 'show_id')->withPivot('actor_id', 'character_name');
    }

    public function getCharacterAttribute()
    {
        $cast = Cast::where('actor_id', $this->id)->where('show_id', $this->show_id)->first();
        return $cast->character_name;
    }

    public function getMovieNameAttribute()
    {
        $movies = $this->movies;
        $movieTitle = [];
        foreach ($movies as $movie) {
            array_push($movieTitle, $movie->title);
        }
        $str = implode(' , ', $movieTitle);
        return $str;
    }

    public function filter($show_id)
    {
        $this->show_id = $show_id;
        return $this;
    }
}
