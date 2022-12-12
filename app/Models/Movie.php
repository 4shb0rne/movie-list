<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'shows';
    protected $dates = [
        'release_date'
    ];

    public $timestamps = false;

    protected $fillable = ['title', 'description', 'director', 'release_date', 'image_url', 'bg_url'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'show_genre', 'show_id');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'casts', 'show_id', 'actor_id')->withPivot('actor_id', 'character_name');
    }

    public function getCountAttribute()
    {
        $count = Movie::select('shows.show_id')->join('watchlists', 'shows.id', '=', 'watchlists.show_id')
            ->where('shows.id', $this->id)->groupBy('shows.id')->count();
        return $count;
    }
}
