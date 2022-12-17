<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create([
            'name' => 'Horror',
        ]);
        Genre::create([
            'name' => 'Drama',
        ]);
        Genre::create([
            'name' => 'Action',
        ]);
        Genre::create([
            'name' => 'Crime',
        ]);
        Genre::create([
            'name' => 'Thriller',
        ]);
        Genre::create([
            'name' => 'Science Fiction',
        ]);
        Genre::create([
            'name' => 'Fantasy',
        ]);
        Genre::create([
            'name' => 'Western',
        ]);
        Genre::create([
            'name' => 'Adventure',
        ]);
        Genre::create([
            'name' => 'Family',
        ]);
        Genre::create([
            'name' => 'Mystery',
        ]);
        Genre::create([
            'name' => 'Animation',
        ]);
        Genre::create([
            'name' => 'History',
        ]);
        Genre::create([
            'name' => 'Comedy',
        ]);
        Genre::create([
            'name' => 'Reality',
        ]);
        Genre::create([
            'name' => 'Music',
        ]);
    }
}
