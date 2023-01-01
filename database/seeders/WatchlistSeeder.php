<?php

namespace Database\Seeders;

use App\Models\Watchlist;
use Illuminate\Database\Seeder;

class WatchlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Watchlist::create([
            'movie_id' => 1,
            'user_id' => 1,
            'status' => 'Planning',
        ]);

        Watchlist::create([
            'movie_id' => 1,
            'user_id' => 1,
            'status' => 'Finished',
        ]);
    }
}
