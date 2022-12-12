<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class ShowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movie::create([
            'title' =>  'Spider-Man: No Way Home',
            'description' => 'Peter Parker is unmasked and no longer able to separate his normal life from the high-stakes of being a super-hero. When he asks for help from Doctor Strange the stakes become even more dangerous, forcing him to discover what it truly means to be Spider-Man',
            'director' => 'Jon Watts',
            'release_date' => date('2021-12-15'),
            'image_url' => '1g0dhYtq4irTY1GPXvft6k4YLjm.jpg',
            'bg_url' => '1Rr5SrvHxMXHu5RjKpaMba8VTzi.jpg'
        ]);

        Movie::create([
            'title' =>  'Encanto',
            'description' => "The tale of an extraordinary family, the Madrigals, who live hidden in the mountains of Colombia, in a magical house, in a vibrant town, in a wondrous, charmed place called an Encanto. The magic of the Encanto has blessed every child in the family with a unique gift from super strength to the power to heal—every child except one, Mirabel. But when she discovers that the magic surrounding the Encanto is in danger, Mirabel decides that she, the only ordinary Madrigal, might just be her exceptional family''s last hope",
            'director' => 'Byron Howard',
            'release_date' => date('2021-11-24'),
            'image_url' => '4j0PNHkMr5ax3IA8tjtxcmPU3QT.jpg',
            'bg_url' => '3G1Q5xF40HkUBJXxt2DQgQzKTp5.jpg'
        ]);

        Movie::create([
            'title' =>  'The Matrix Resurrections',
            'description' => "Plagued by strange memories, Neo''s life takes an unexpected turn when he finds himself back inside the Matrix.",
            'director' => 'Lana Wachowsk',
            'release_date' => date('2021-12-16'),
            'image_url' => '8c4a8kE7PizaGQQnditMmI1xbRp.jpg',
            'bg_url' => 'hv7o3VgfsairBoQFAawgaQ4cR1m.jpg'
        ]);

        Movie::create([
            'title' =>  'Venom: Let There Be Carnage',
            'description' => 'After finding a host body in investigative reporter Eddie Brock, the alien symbiote must face a new enemy, Carnage, the alter ego of serial killer Cletus Kasady.',
            'director' => 'Andy Serkis',
            'release_date' => date('2021-09-30'),
            'image_url' => 'rjkmN1dniUHVYAtwuV3Tji7FsDO.jpg',
            'bg_url' => 'eENEf62tMXbhyVvdcXlnQz2wcuT.jpg'
        ]);

        Movie::create([
            'title' =>  'Resident Evil: Welcome to Raccoon City',
            'description' => 'Once the booming home of pharmaceutical giant Umbrella Corporation, Raccoon City is now a dying Midwestern town. The company’s exodus left the city a wasteland…with great evil brewing below the surface. When that evil is unleashed, the townspeople are forever…changed…and a small group of survivors must work together to uncover the truth behind Umbrella and make it through the night.',
            'director' => 'Johannes Roberts',
            'release_date' => date('2021-11-24'),
            'image_url' => '3eVpNCMoi3C8lA0F0n2retnwvCK.jpg',
            'bg_url' => 'o76ZDm8PS9791XiuieNB93UZcRV.jpg'
        ]);

        Movie::create([
            'title' =>  'Clifford the Big Red Dog',
            'description' => 'As Emily struggles to fit in at home and at school, she discovers a small red puppy who is destined to become her best friend. When Clifford magically undergoes one heck of a growth spurt, becomes a gigantic dog and attracts the attention of a genetics company, Emily and her Uncle Casey have to fight the forces of greed as they go on the run across New York City. Along the way, Clifford affects the lives of everyone around him and teaches Emily and her uncle the true meaning of acceptance and unconditional love.',
            'director' => 'Walt Becker',
            'release_date' => date('2021-11-10'),
            'image_url' => '30ULVKdjBcQTsj2aOSThXXZNSxF.jpg',
            'bg_url' => '1Wlwnhn5sXUIwlxpJgWszT622PS.jpg'
        ]);
    }
}
