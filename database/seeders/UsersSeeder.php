<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'dob' => Carbon::now(),
            'date_joined' => Carbon::now(),
            'phone' => '081111111111',
        ]);

        User::create([
            'name' => 'hans',
            'email' => 'hans@mail.com',
            'password' => bcrypt('hansgeovani2'),
            'dob' => Carbon::now(),
            'date_joined' => Carbon::now(),
            'phone' => '081212341235',
        ]);
    }
}
