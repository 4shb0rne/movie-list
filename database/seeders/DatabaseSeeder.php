<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\MovieActor;
use App\Models\ShowGenre;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            MovieSeeder::class,
            GenreSeeder::class,
            ActorSeeder::class,
            MovieGenreSeeder::class,
            MovieActor::class,
            WatchlistSeeder::class,
        ]);
    }
}
