<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
            'email' => 'admin@movielistadmin.com',
            'password' => bcrypt('admin'),
            'dob' => Carbon::now(),
            'date_joined' => Carbon::now(),
            'phone' => '081111111111',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'william',
            'email' => 'william@ashborne.com',
            'password' => bcrypt('william123'),
            'dob' => Carbon::now(),
            'date_joined' => Carbon::now(),
            'phone' => '08333123123',
            'role' => 'user'
        ]);
    }
}
