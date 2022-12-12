<?php

namespace Database\Seeders;

use App\Models\Cast;
use Illuminate\Database\Seeder;

class CastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cast::create([
            'show_id' => 1,
            'actor_id' => 1,
            'character_name' => 'Peter Parker / Spider-Man',
        ]);

        Cast::create([
            'show_id' => 1,
            'actor_id' => 2,
            'character_name' => "Michelle ''MJ'' Jones",
        ]);

        Cast::create([
            'show_id' => 1,
            'actor_id' => 3,
            'character_name' => 'Stephen Strange / Doctor Strange',
        ]);

        Cast::create([
            'show_id' => 2,
            'actor_id' => 4,
            'character_name' => 'Mirabel Madrigal (voice)',
        ]);

        Cast::create([
            'show_id' => 2,
            'actor_id' => 5,
            'character_name' => 'Abuela Alma Madrigal (voice)',
        ]);

        Cast::create([
            'show_id' => 3,
            'actor_id' => 6,
            'character_name' => 'Thomas A. Anderson / Neo',
        ]);

        Cast::create([
            'show_id' => 3,
            'actor_id' => 7,
            'character_name' => 'Tiffany / Trinity',
        ]);

        Cast::create([
            'show_id' => 4,
            'actor_id' => 8,
            'character_name' => 'Eddie Brock / Venom',
        ]);

        Cast::create([
            'show_id' => 4,
            'actor_id' => 9,
            'character_name' => 'Cletus Kasady / Carnage',
        ]);

        Cast::create([
            'show_id' => 5,
            'actor_id' => 10,
            'character_name' => 'Claire Redfield',
        ]);

        Cast::create([
            'show_id' => 5,
            'actor_id' => 11,
            'character_name' => 'Chris Redfield',
        ]);

        Cast::create([
            'show_id' => 6,
            'actor_id' => 12,
            'character_name' => 'Emily Elizabeth',
        ]);

        Cast::create([
            'show_id' => 6,
            'actor_id' => 13,
            'character_name' => 'Casey',
        ]);
    }
}
