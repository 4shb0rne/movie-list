<?php

namespace Database\Seeders;

use App\Models\MovieGenre;
use Illuminate\Database\Seeder;

class MovieGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MovieGenre::create([
            'movie_id' => 1,
            'genre_id' => 3
        ]);

        MovieGenre::create([
            'movie_id' => 1,
            'genre_id' => 10
        ]);

        MovieGenre::create([
            'movie_id' => 1,
            'genre_id' => 6
        ]);

        MovieGenre::create([
            'movie_id' => 2,
            'genre_id' => 12
        ]);

        MovieGenre::create([
            'movie_id' => 2,
            'genre_id' => 14
        ]);

        MovieGenre::create([
            'movie_id' => 2,
            'genre_id' => 10
        ]);

        MovieGenre::create([
            'movie_id' => 2,
            'genre_id' => 7
        ]);

        MovieGenre::create([
            'movie_id' => 3,
            'genre_id' => 3
        ]);

        MovieGenre::create([
            'movie_id' => 3,
            'genre_id' => 6
        ]);

        MovieGenre::create([
            'movie_id' => 4,
            'genre_id' => 6
        ]);

        MovieGenre::create([
            'movie_id' => 4,
            'genre_id' => 3
        ]);

        MovieGenre::create([
            'movie_id' => 4,
            'genre_id' => 9
        ]);

        MovieGenre::create([
            'movie_id' => 5,
            'genre_id' => 1
        ]);

        MovieGenre::create([
            'movie_id' => 5,
            'genre_id' => 3
        ]);

        MovieGenre::create([
            'movie_id' => 5,
            'genre_id' => 6
        ]);

        MovieGenre::create([
            'movie_id' => 6,
            'genre_id' => 11
        ]);

        MovieGenre::create([
            'movie_id' => 6,
            'genre_id' => 14
        ]);

        MovieGenre::create([
            'movie_id' => 6,
            'genre_id' => 10
        ]);
    }
}
