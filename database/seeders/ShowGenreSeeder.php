<?php

namespace Database\Seeders;

use App\Models\ShowGenre;
use Illuminate\Database\Seeder;

class ShowGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShowGenre::create([
            'show_id' => 1,
            'genre_id' => 3
        ]);

        ShowGenre::create([
            'show_id' => 1,
            'genre_id' => 10
        ]);

        ShowGenre::create([
            'show_id' => 1,
            'genre_id' => 6
        ]);

        ShowGenre::create([
            'show_id' => 2,
            'genre_id' => 12
        ]);

        ShowGenre::create([
            'show_id' => 2,
            'genre_id' => 14
        ]);

        ShowGenre::create([
            'show_id' => 2,
            'genre_id' => 10
        ]);

        ShowGenre::create([
            'show_id' => 2,
            'genre_id' => 7
        ]);

        ShowGenre::create([
            'show_id' => 3,
            'genre_id' => 3
        ]);

        ShowGenre::create([
            'show_id' => 3,
            'genre_id' => 6
        ]);

        ShowGenre::create([
            'show_id' => 4,
            'genre_id' => 6
        ]);

        ShowGenre::create([
            'show_id' => 4,
            'genre_id' => 3
        ]);

        ShowGenre::create([
            'show_id' => 4,
            'genre_id' => 9
        ]);

        ShowGenre::create([
            'show_id' => 5,
            'genre_id' => 1
        ]);

        ShowGenre::create([
            'show_id' => 5,
            'genre_id' => 3
        ]);

        ShowGenre::create([
            'show_id' => 5,
            'genre_id' => 6
        ]);

        ShowGenre::create([
            'show_id' => 6,
            'genre_id' => 11
        ]);

        ShowGenre::create([
            'show_id' => 6,
            'genre_id' => 14
        ]);

        ShowGenre::create([
            'show_id' => 6,
            'genre_id' => 10
        ]);
    }
}
