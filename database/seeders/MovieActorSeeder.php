<?php

namespace Database\Seeders;

use App\Models\MovieActor;
use Illuminate\Database\Seeder;

class MovieActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MovieActor::create([
            'movie_id' => 1,
            'actor_id' => 1,
            'character_name' => 'Peter Parker / Spider-Man',
        ]);

        MovieActor::create([
            'movie_id' => 1,
            'actor_id' => 2,
            'character_name' => "Michelle ''MJ'' Jones",
        ]);

        MovieActor::create([
            'movie_id' => 1,
            'actor_id' => 3,
            'character_name' => 'Stephen Strange / Doctor Strange',
        ]);

        MovieActor::create([
            'movie_id' => 2,
            'actor_id' => 4,
            'character_name' => 'Mirabel Madrigal (voice)',
        ]);

        MovieActor::create([
            'movie_id' => 2,
            'actor_id' => 5,
            'character_name' => 'Abuela Alma Madrigal (voice)',
        ]);

        MovieActor::create([
            'movie_id' => 3,
            'actor_id' => 6,
            'character_name' => 'Thomas A. Anderson / Neo',
        ]);

        MovieActor::create([
            'movie_id' => 3,
            'actor_id' => 7,
            'character_name' => 'Tiffany / Trinity',
        ]);

        MovieActor::create([
            'movie_id' => 4,
            'actor_id' => 8,
            'character_name' => 'Eddie Brock / Venom',
        ]);

        MovieActor::create([
            'movie_id' => 4,
            'actor_id' => 9,
            'character_name' => 'Cletus Kasady / Carnage',
        ]);

        MovieActor::create([
            'movie_id' => 5,
            'actor_id' => 10,
            'character_name' => 'Claire Redfield',
        ]);

        MovieActor::create([
            'movie_id' => 5,
            'actor_id' => 11,
            'character_name' => 'Chris Redfield',
        ]);

        MovieActor::create([
            'movie_id' => 6,
            'actor_id' => 12,
            'character_name' => 'Emily Elizabeth',
        ]);

        MovieActor::create([
            'movie_id' => 6,
            'actor_id' => 13,
            'character_name' => 'Casey',
        ]);
    }
}
