<?php

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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'id' => '1234',
            'name' => env('SEED_USER'),
            'username' => env('SEED_USER'),
            'email' => env('SEED_EMAIL'),
            'password' => bcrypt(env('SEED_PASS')),
            'interests' => '["Technology", "Entertainment"]',
        ]);

        DB::table('user_meta_datas')->insert([
            'user_id' => '1234',
            'id' => '4321',
            'occupation' => 'Web Developer',
            'bio' => "# maybe this was a crazy idea
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ultricies nibh nunc, vitae malesuada urna commodo eget. Etiam eget lobortis lorem. Donec malesuada enim id nisl blandit sollicitudin. Mauris feugiat ligula quis mattis iaculis. Aenean ac dui eget tortor vestibulum sollicitudin. Sed pulvinar est eu sem condimentum, ac molestie nunc auctor. Integer sagittis magna in dolor fringilla mattis. Ut scelerisque felis ut porttitor congue. Aliquam vestibulum magna faucibus eleifend volutpat. Proin tellus urna, dignissim dictum velit a, pretium mollis enim. Nunc dictum congue lacus eget tempus. Vestibulum bibendum luctus interdum. Fusce a volutpat turpis.
            > All our dreams can come true, if we have the courage to pursue them. – Walt Disney
            Praesent posuere, massa eu pretium ullamcorper, magna eros hendrerit mauris, ut pretium mauris orci sed metus. Integer non neque efficitur, facilisis nisl id, consectetur metus. Quisque vel massa egestas, blandit leo eu, volutpat ex. Fusce massa nisl, aliquet sed felis et, semper rutrum turpis. Nunc arcu leo, hendrerit vel nibh vitae, semper posuere est. Praesent eleifend nisl vel enim blandit auctor quis et metus. In fringilla efficitur volutpat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean ligula ligula, varius et bibendum quis, varius eget ligula. Curabitur in euismod enim, vitae accumsan diam. Morbi vestibulum turpis ut mauris iaculis, eget volutpat enim ultrices. Phasellus pellentesque lectus purus, non hendrerit sem bibendum ac. Nullam a viverra ante. Proin tellus ipsum, sagittis ac massa sed, convallis finibus orci.
            ",
            'website' => 'lukesecomb.digital',
            'avatar' => 'https://instagram.fsyd4-1.fna.fbcdn.net/vp/00d356add2e63acd4896babf8b090673/5C7070BF/t51.2885-19/s150x150/39494074_2032250917085339_6758160061350019072_n.jpg',
            'social_media' => '{
                "facebook": "facebook.com",
                "instagram": "instagram",
                "youtube": "youtube.com"
            }',
            "following" => '["2235"]',
            "followers" => '["1235"]',
            'likes' => '{
                "discussions": ["1234", "1235"],
                "discussion_replies": ["1234", "1235"],
                "updates": ["1234","1235"],
                "ideas": ["1234","1235"],
                "timelines": ["1234","1235"]
            }'
        ]);

        DB::table('users')->insert([
            'id' => '1235',
            'name' => 'The Notorious B.I.G',
            'username' => 'biggie',
            'email' => 'biggie@smalls.com',
            'password' => bcrypt(env('SEED_PASS')),
            'interests' => '["Arts", "Entertainment", "Culture"]',
        ]);

        DB::table('user_meta_datas')->insert([
            'user_id' => '1235',
            'id' => '4322',
            'occupation' => 'Lyricist/Rapper',
            'bio' => 'Christopher George Latore Wallace, known professionally as the Notorious B.I.G., Biggie Smalls, or Biggie, was an American rapper. He is considered by many to be one of the greatest rappers of all time. Wallace was raised in the Brooklyn borough of New York City.
            ',
            'website' => 'https://www.youtube.com/watch?v=glEiPXAYE-U',
            'avatar' => 'https://www.billboard.com/files/styles/article_main_image/public/media/notorious-big-jan-18-billboard-1548.jpg',
            'social_media' => '{
                "facebook": "facebook.com",
                "instagram": "instagram",
                "youtube": "youtube.com"
            }',
            "following" => '["2235"]',
            "followers" => '["1235"]',
            'likes' => '{
                "discussions": ["1234", "1235"],
                "discussion_replies": ["1234", "1235"],
                "updates": ["1234","1235"],
                "ideas": ["1234","1235"],
                "timelines": ["1234","1235"]
            }'
        ]);

        DB::table('users')->insert([
            'id' => '1236',
            'name' => 'Kendrick Lamar',
            'username' => 'be_humble',
            'email' => 'i.got@dna.com',
            'password' => bcrypt(env('SEED_PASS')),
            'interests' => '["Arts", "Entertainment", "Culture"]',
        ]);

        DB::table('user_meta_datas')->insert([
            'user_id' => '1236',
            'id' => '4323',
            'occupation' => 'Lyricist/Rapper',
            'bio' => '# New King of Hip Hop
            Kendrick Lamar Duckworth is an American rapper, songwriter, and record producer. He has been branded as the "new king of hip hop" numerous times.
            ',
            'website' => 'kendricklamar.com',
            'avatar' => 'https://bit.ly/2JEoCe7',
            'social_media' => '{
                "facebook": "facebook.com",
                "instagram": "instagram",
                "youtube": "youtube.com"
            }',
            "following" => '["2235"]',
            "followers" => '["1235"]',
            'likes' => '{
                "discussions": ["1234", "1235"],
                "discussion_replies": ["1234", "1235"],
                "updates": ["1234","1235"],
                "ideas": ["1234","1235"],
                "timelines": ["1234","1235"]
            }'
        ]);

        

        // creates an idea for the dev
        DB::table('ideas')->insert([
            'user_id' => '1234',
            'success' => true,
            'id' => '5678',
            'title' => 'any.ideas',
            'pitch' => 'Lorem ipsum dolor amet deep v shaman kitsch hoodie, vinyl meggings tattooed cliche. Chillwave authentic blog, squid la croix raw denim biodiesel intelligentsia paleo twee fixie bitters pitchfork. Sartorial poutine franzen swag, mustache woke salvia scenester. Lumbersexual freegan typewriter gentrify, pabst enamel pin vinyl waistcoat leggings +1 irony fixie. Four loko keytar pok pok, taiyaki ugh snackwave pitchfork pork belly butcher hella stumptown. 90s normcore health goth ramps la croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'creating',
            'category' => 'business',
            'tags' => '["tags","of","ideas"]',
            'description' => "## so the idea is.... it just **works**

            >...hopefully",
            'darts' => '3'
        ]);

        DB::table('ideas')->insert([
            'user_id' => '1234',
            'success' => false,
            'id' => '5649',
            'title' => 'Spotify Websockets',
            'pitch' => 'Lorem ipsum dolor amet deep v shaman kitsch hoodie, vinyl meggings tattooed cliche. Chillwave authentic blog, squid la croix raw denim biodiesel intelligentsia paleo twee fixie bitters pitchfork. Sartorial poutine franzen swag, mustache woke salvia scenester. Lumbersexual freegan typewriter gentrify, pabst enamel pin vinyl waistcoat leggings +1 irony fixie. Four loko keytar pok pok, taiyaki ugh snackwave pitchfork pork belly butcher hella stumptown. 90s normcore health goth ramps la croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'abandoned',
            'category' => 'industry',
            'tags' => '["tags","of","ideas"]',
            'description' => "** Desc can have data pushed using the same schema**",
            'darts' => '12'
        ]);

        DB::table('ideas')->insert([
            'user_id' => '1234',
            'success' => false,
            'id' => '5679',
            'title' => 'Lyrical',
            'pitch' => 'Lorem ipsum dolor amet deep v shaman kitsch hoodie, vinyl meggings tattooed cliche. Chillwave authentic blog, squid la croix raw denim biodiesel intelligentsia paleo twee fixie bitters pitchfork. Sartorial poutine franzen swag, mustache woke salvia scenester. Lumbersexual freegan typewriter gentrify, pabst enamel pin vinyl waistcoat leggings +1 irony fixie. Four loko keytar pok pok, taiyaki ugh snackwave pitchfork pork belly butcher hella stumptown. 90s normcore health goth ramps la croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'evaluating',
            'category' => 'industry',
            'tags' => '["tags","of","ideas"]',
            'description' => "** Desc can have data pushed using the same schema**",
            'darts' => '12'
        ]);

        DB::table('ideas')->insert([
            'user_id' => '1234',
            'success' => false,
            'id' => '5694',
            'title' => 'Posh Weather',
            'pitch' => 'Lorem ipsum dolor amet deep v shaman kitsch hoodie, vinyl meggings tattooed cliche. Chillwave authentic blog, squid la croix raw denim biodiesel intelligentsia paleo twee fixie bitters pitchfork. Sartorial poutine franzen swag, mustache woke salvia scenester. Lumbersexual freegan typewriter gentrify, pabst enamel pin vinyl waistcoat leggings +1 irony fixie. Four loko keytar pok pok, taiyaki ugh snackwave pitchfork pork belly butcher hella stumptown. 90s normcore health goth ramps la croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'completed',
            'category' => 'industry',
            'tags' => '["tags","of","ideas"]',
            'description' => "** Desc can have data pushed using the same schema**",
            'darts' => '5'
        ]);

        DB::table('ideas')->insert([
            'user_id' => '1234',
            'success' => false,
            'id' => '1234',
            'title' => 'any.ideas.v2',
            'pitch' => 'Lorem ipsum dolor amet deep croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'on-hold',
            'category' => 'technology',
            'tags' => '["tags","of","ideas"]',
            'description' => "## SEED Data
            here is another example used to create an idea within the `ideas` table in the DB.
            ```
            ...
            public function run()
            {
                ...
                DB::table('ideas')->insert([
                    'user_id' => '1234',
                    'id' => '5678',
                    'title' => 'any.ideas',
                    'pitch' => 'Lorem ipsum dolor amet deep v shaman kitsch hoodie, vinyl meggings tattooed cliche.',
                    'status' => 'In Development',
                    'description' => 'Lorem ipsum dolor amet brooklyn slow-carb pabst vexillologist skateboard',
                    'darts' => '3'
                ]);    
                // add more entries below
            }
            ...
            ```
            any table can have data pushed using the same schema",
            'darts' => '42'
        ]);

        DB::table('ideas')->insert([
            'user_id' => '1235',
            'success' => false,
            'id' => '2235',
            'title' => 'New users = New ideas',
            'pitch' => 'Lorem ipsum dolor amet deep croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'ideation',
            'category' => 'innovation',
            'tags' => '["tags","of","ideas"]',
            'description' => "
                #### code
                ```
                ...
                public function run()
                {
                    DB::table('users')->insert([
                        'id' => '1234',
                        'name' => env('SEED_USER'),
                        'username' => env('SEED_USER'),
                        'email' => env('SEED_EMAIL'),
                        'password' => bcrypt(env('SEED_PASS')),
                
                    ]);
                    // add more entries below
                }
                ...
                ```",
            'darts' => '42'
        ]);

        DB::table('timelines')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'id' => '9876',
            'title' => 'Initial Idea',
            'message' => 'Lorem ipsum dolor amet deep croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'link' => 'google.com.au',
            'darts' => '8',
            'created_at' => '2018-11-03 20:02:18',
            'updated_at' => '2018-11-03 20:02:18'
        ]);

        DB::table('updates_posts')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'id' => '1120',
            'message' => 'updates message',
            'created_at' => '2018-11-03 20:02:18',
            'updated_at' => '2018-11-03 20:02:18'
        ]);

        DB::table('updates_posts')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'id' => '1121',
            'message' => 'updates message number two',
            'created_at' => '2018-11-03 20:02:18',
            'updated_at' => '2018-11-03 20:02:18'
        ]);

        DB::table('discussions')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'replies' => '2',
            'id' => '2120',
            'message' => 'interesting idea',
            'title' => 'interesting',
            'created_at' => '2018-11-03 20:02:18',
            'updated_at' => '2018-11-03 20:02:18'
        ]);

        DB::table('discussions')->insert([
            'user_id' => '1235',
            'idea_id' => '5678',
            'replies' => '2',
            'id' => '2121',
            'title' => 'sick',
            'message' => 'Hah, sicka than your average
            Poppa twist cabbage off instinct
            _____ don"t think sh*t stink, pink gators,
            My Detroit players
            Timbs for my hooligans in Brooklyn
            Dead right, if the head right, Biggie there ery"night
            Poppa been smooth since days of Underroos
            Never lose, never choose to, bruise crews who
            Do something to us, talk go through us
            Girls walk to us, wanna do us, screw us
            Who us? Yeah, Poppa and Puff (hehehe)',
            'created_at' => '2018-11-03 20:02:18',
            'updated_at' => '2018-11-03 20:02:18'
        ]);

        DB::table('discussions')->insert([
            'user_id' => '1236',
            'idea_id' => '5678',
            'id' => '2122',
            'message' => 'sick idea, keep it humble',
            'title' => 'keep it humble',
            'created_at' => '2018-11-03 23:55:55',
            'updated_at' => '2018-11-03 23:55:55'
        ]);

        DB::table('discussions')->insert([
            'user_id' => '1235',
            'idea_id' => '5678',
            'id' => '2123',
            'message' => 'interesting name....?',
            'title' => 'why any.ideas? why not "who shot ya ideas" - he',
            'created_at' => '2018-11-03 23:55:55',
            'updated_at' => '2018-11-03 23:55:55'
        ]);

        DB::table('discussion_replies')->insert([
            'user_id' => '1235',
            'idea_id' => '5678',
            'discussions_id' => '2121',
            'id' => '5557',
            'message' => 'asdfsegasdf asdf asdf ed?',
            'darts' => '2',
            'created_at' => '2018-11-04 14:02:18',
            'updated_at' => '2018-11-04 14:02:18'
        ]);

        DB::table('discussion_replies')->insert([
            'user_id' => '1236',
            'idea_id' => '5678',
            'discussions_id' => '2121',
            'id' => '5558',
            'message' => 'great idea matey',
            'darts' => '48',
            'created_at' => '2018-11-04 12:02:18',
            'updated_at' => '2018-11-04 12:02:18'
        ]);

        DB::table('discussion_replies')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'discussions_id' => '2120',
            'id' => '5555',
            'message' => 'interesting idea',
            'darts' => '2',
            'created_at' => '2018-11-03 20:02:18',
            'updated_at' => '2018-11-03 20:02:18'
        ]);

        DB::table('discussion_replies')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'discussions_id' => '2120',
            'id' => '5556',
            'message' => 'super dooper, have you tried green?',
            'darts' => '48',
            'created_at' => '2018-11-03 20:02:18',
            'updated_at' => '2018-11-03 20:02:18'
        ]);
    }
}
