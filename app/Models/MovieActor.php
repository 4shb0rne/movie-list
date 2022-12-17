<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieActor extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'movie_id',
        'actor_id',
        'character_name',
    ];
}
