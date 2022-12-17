<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'director',
        'release_date',
        'image_url',
        'background_url',
    ];
}
