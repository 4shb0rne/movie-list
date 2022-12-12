<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::create([
            'name' => 'Tom Holland',
            'dob' => date('1996-06-01'),
            'image_url' => 'tomholland.jpg',
            'place_of_birth' => 'Surrey, England, UK',
            'gender' => 'Male',
            'popularity' => 135.488,
            'biography' => 'Tom" Stanley Holland is an English actor and dancer. He is best known for playing Peter Parker / Spider-Man in the Marvel Cinematic Universe and has appeared as the character in six films: Captain America: Civil War (2016), Spider-Man: Homecoming (2017), Avengers: Infinity War (2018), Avengers: Endgame (2019), Spider-Man: Far From Home (2019), and Spider-Man: No Way Home (2021). He is also known for playing the title role in Billy Elliot the Musical at the Victoria Palace Theatre, London, as well as for starring in the 2012 film The Impossible.',
        ]);

        Actor::create([
            'name' => 'Zendaya',
            'dob' => date('1996-09-01'),
            'image_url' => 'zendaya.jpg',
            'place_of_birth' => 'Oakland, California, USA',
            'gender' => 'Female',
            'popularity' => 57.107,
            'biography' => 'Zendaya Maree Stoermer Coleman (born September 1, 1996) is an American actress and singer. She began her career as a child model and backup dancer. She rose to mainstream prominence for her role as Rocky Blue on the Disney Channel sitcom Shake It Up (2010–2013). In 2013, Zendaya was a contestant on the 16th season of the dance competition series Dancing with the Stars. She produced and starred as the titular spy, K.C. Cooper, in the sitcom K.C. Undercover (2015–2018). Her performance as a struggling, drug addict teenager in the HBO drama series Euphoria (2019–present) made her the youngest recipient of the Primetime Emmy Award for Outstanding Lead Actress in a Drama Series. Her film roles include the musical drama The Greatest Showman (2017), the superhero film Spider-Man: Homecoming (2017) and its sequels, the computer-animated musical comedy Smallfoot (2018), the romantic drama Malcolm & Marie (2021), the live-action/animation hybrid sports comedy Space Jam: A New Legacy (2021), and the science fiction epic Dune (2021).',
        ]);

        Actor::create([
            'name' => 'Benedict Cumberbatch',
            'dob' => date('1976-07-19'),
            'image_url' => 'benedictcumberbatch.jpg',
            'place_of_birth' => 'London, England, UK',
            'gender' => 'Male',
            'popularity' => 34.786,
            'biography' => "Benedict Timothy Carlton Cumberbatch (born 19 July 1976) is an English actor. He first performed at the Open Air Theatre, Regent''s Park in Shakespearean productions, and made his West End debut in Richard Eyre''s revival of Hedda Gabler in 2005. Since then, he has starred in the Royal National Theatre productions After the Dance (2010) and Frankenstein (2011). In 2015, he played the title role in Hamlet at the Barbican Theatre.  His television work includes appearances in Silent Witness (2002) and Fortysomething (2003) before playing Stephen Hawking in the television film Hawking (2004). He has starred as Sherlock Holmes in the series Sherlock since 2010. He has also headlined Tom Stoppard''s adaptation of Parade''s End (2012), The Hollow Crown: The Wars of the Roses (2016), and Patrick Melrose (2018). In the film, he has starred in Amazing Grace (2006), Star Trek Into Darkness (2013), 12 Years a Slave (2013), The Fifth Estate (2013), and The Imitation Game (2014). He also made a brief appearance in 1917 (2019). From 2012 to 2014, through voice and motion capture, he played the characters of Smaug and the Necromancer in The Hobbit film series. In superhero films set in the Marvel Cinematic Universe, he has played Dr. Stephen Strange in Doctor Strange (2016), Thor: Ragnarok (2017), Avengers: Infinity War (2018), and Avengers: Endgame (2019).  He has received numerous accolades, including the Laurence Olivier Award for Best Actor for Frankenstein, and the Primetime Emmy Award for Outstanding Lead Actor in a Miniseries or a Movie for Sherlock. His performance in The Imitation Game earned him a nomination for the Academy Award for Best Actor. In 2015, he was appointed a CBE in the 2015 Birthday Honours for services to the performing arts and to charity.  The description above is from the Wikipedia article Benedict Cumberbatch, licensed under CC-BY-SA, full list of contributors on Wikipedia.",
        ]);

        Actor::create([
            'name' => 'María Cecilia Botero',
            'dob' => date('1955-05-13'),
            'image_url' => 'mariacecilliabotero.jpg',
            'place_of_birth' => 'Medellín, Colombia',
            'gender' => 'Female',
            'popularity' => 13.8,
            'biography' => 'María Cecilia Botero Cadavid (Medellín Antioquia, May 13, 1955) is a Colombian actress, presenter and journalist.',
        ]);

        Actor::create([
            'name' => 'John Leguizamo',
            'dob' => date('1964-07-22'),
            'image_url' => 'johnleguizamo.jpg',
            'place_of_birth' => 'Bogotá, Colombia',
            'gender' => 'Male',
            'popularity' => 6.437,
            'biography' => 'John Leguizamo (born July 22, 1964) is a Colombian-American actor, comedian, voice artist, and producer. Leguizamo is of Puerto Rican and Colombian descent.',
        ]);

        Actor::create([
            'name' => 'Keanu Reeves',
            'dob' => date('1964-09-02'),
            'image_url' => 'keanureeves.jpg',
            'place_of_birth' => 'Beirut, Lebanon',
            'gender' => 'Male',
            'popularity' => 123.653,
            'biography' => "Keanu Charles Reeves is a Canadian actor. Reeves is known for his roles in Bill & Ted''s Excellent Adventure, Speed, Point Break, and The Matrix trilogy as Neo. He has collaborated with major directors such as Stephen Frears (in the 1988 period drama Dangerous Liaisons); Gus Van Sant (in the 1991 independent film My Own Private Idaho); and Bernardo Bertolucci (in the 1993 film Little Buddha). Referring to his 1991 film releases, The New York Times'' critic, Janet Maslin, praised Reeves'' versatility, saying that he \"displays considerable discipline and range. He moves easily between the buttoned-down demeanor that suits a police procedural story and the loose-jointed manner of his comic roles.\" A repeated theme in roles he has portrayed is that of saving the world, including the characters of Ted Logan, Buddha, Neo, Johnny Mnemonic, John Constantine and Klaatu.",
        ]);

        Actor::create([
            'name' => 'Carrie-Anne Moss',
            'dob' => date('1967-08-21'),
            'image_url' => 'carrieannemoss.jpg',
            'place_of_birth' => 'Burnaby, British Columbia, Canada',
            'gender' => 'Female',
            'popularity' => 119.627,
            'biography' => "Carrie-Anne Moss is a Canadian film and television actress, best known for playing character Trinity in the feature film trilogy \"The Matrix\". She''s a graduate of the American Academy of Dramatic Arts, Los Angeles, California, USA.",
        ]);

        Actor::create([
            'name' => 'Tom Hardy',
            'dob' => date('1977-09-15'),
            'image_url' => 'tomhardy.jpg',
            'place_of_birth' => 'Hammersmith, London, England, UK',
            'gender' => 'Male',
            'popularity' => 34.588,
            'biography' => "Edward Thomas \"Tom\" Hardy (born 15 September 1977) is an English actor. He is best known for playing the title character in the 2009 British film Bronson, and for his roles in the films Star Trek Nemesis, RocknRolla, and Inception. He has been cast in the Christopher Nolan film The Dark Knight Rises as Bane",
        ]);

        Actor::create([
            'name' => 'Woody Harrelson',
            'dob' => date('1961-07-23'),
            'image_url' => 'woodyharrelson.jpg',
            'place_of_birth' => 'Midland, Texas, USA',
            'gender' => 'Male',
            'popularity' => 13.092,
            'biography' => "Academy Award-nominated and Emmy Award-winning actor Woodrow Tracy Harrelson was born on July 23, 1961 in Midland, Texas, to Diane Lou (Oswald) and Charles Harrelson. He grew up in Lebanon, Ohio, where his mother was from. After receiving degrees in theater arts and English from Hanover College, he had a brief stint in New York theater. He was soon cast as Woody on TV series Cheers (1982), which wound up being one of the most-popular TV shows ever and also earned Harrelson an Emmy for his performance in 1989.  While he dabbled in film during his time on Cheers (1982), that area of his career didn''t fully take off until towards the end of the show''s run. In 1991, Doc Hollywood (1991) gave him his first widely-seen movie role, and he followed that up with White Men Can''t Jump (1992), Indecent Proposal (1993) and Natural Born Killers (1994). More recently, Harrelson was seen in No Country for Old Men (2007), Zombieland (2009), 2012 (2009), and Friends with Benefits (2011), along with the acclaimed HBO movie Game Change (2012).  In 2011, Harrelson snagged the coveted role of fan-favorite drunk Haymitch Abernathy in the big-screen adaptation of The Hunger Games (2012), which ended up being one of the highest-grossing movies ever at the domestic box office. Harrelson is set to reprise that role for the sequels, which are scheduled for release in November 2013, 2014 and 2015. Harrelson has received two Academy Award nominations, first for his role as controversial Hustler founder Larry Flynt in The People vs. Larry Flynt (1996) and then for a role in The Messenger (2009). He also received Golden Globe nominations for both of these parts. In 2016, he had a stand-out role as a wise teacher in the teen drama The Edge of Seventeen (2016).  Harrelson was briefly married to Nancy Simon in the 80s, and later married his former assistant, Laura Louie, with whom he has three daughters",
        ]);

        Actor::create([
            'name' => 'Kaya Scodelario',
            'dob' => date('1992-03-13'),
            'image_url' => 'kayascodelario.jpg',
            'place_of_birth' => 'London, England, U.K.',
            'gender' => 'Female',
            'popularity' => 32.381,
            'biography' => "An English actress (Born March 13, 1992). She is best known for her roles as Effy Stonem on the E4 teen drama Skins (2007-2010; 2012), Catherine Earnshaw in Andrea Arnold''s Wuthering Heights (2011), Teresa Agnes in The Maze Runner film series and Carina Smyth in Pirates of the Caribbean: Dead Men Tell No Tales (2017).",
        ]);

        Actor::create([
            'name' => 'Robbie Amell',
            'dob' => date('1988-04-21'),
            'image_url' => 'robbieamell.jpg',
            'place_of_birth' => 'Toronto, Ontario,  Canada',
            'gender' => 'Male',
            'popularity' => 14.645,
            'biography' => "Robbie Amell (born April 21, 1988) is a Canadian actor, who is best known for his roles in Resident Evil: Welcome to Raccoon City, True Jackson, VP and Picture This as well as Fred Jones in Scooby-Doo! The Mystery Begins and Scooby-Doo! Curse of the Lake Monster.",
        ]);

        Actor::create([
            'name' => 'Darby Camp',
            'dob' => date('2007-07-14'),
            'image_url' => 'darbycamp.jpg',
            'place_of_birth' => 'None',
            'gender' => 'Female',
            'popularity' => 6.18,
            'biography' => "Darby Eliza Camp is an American actress, known for her roles in the Netflix holiday film The Christmas Chronicles and the HBO television series Big Little Lies.",
        ]);

        Actor::create([
            'name' => 'Jack Whitehall',
            'dob' => date('1988-07-07'),
            'image_url' => 'jackwhitehall.jpg',
            'place_of_birth' => 'London, England, UK',
            'gender' => 'Male',
            'popularity' => 14.181,
            'biography' => "An English comedian, television presenter, actor and writer. He is best known for his stand up comedy, for starring as JP in the TV series Fresh Meat (2011–2016), and for playing Alfie Wickers in the TV series Bad Education (2012–2014) and the spin-off film The Bad Education Movie (2015), both of which he also co-wrote. He has also starred in Frozen in the role of Gothi the Troll. From 2012 to 2018, Whitehall was a regular panellist on the game show A League of Their Own. In 2017, Whitehall appeared with his father, Michael, in the Netflix comedy documentary series Jack Whitehall: Travels with My Father and starred in the television series Decline and Fall. Since 2018, Whitehall has been the host of the BRIT Awards.",
        ]);
    }
}
