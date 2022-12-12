<?php

namespace Database\Seeders;

use App\Models\Actor;
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
            UsersSeeder::class,
            ShowsSeeder::class,
            GenresSeeder::class,
            ShowGenreSeeder::class,
            ActorSeeder::class,
            CastSeeder::class,
        ]);
    }
}
