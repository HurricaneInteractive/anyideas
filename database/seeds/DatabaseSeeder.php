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
            'interests' => '["basketball", "photography", "technology"]',
        ]);

        DB::table('user_meta_datas')->insert([
            'user_id' => '1234',
            'id' => '4321',
            'occupation' => 'Web Dev',
            'website' => 'google.com',
            'avatar' => 'https://avatars0.githubusercontent.com/u/13529535?s=460&v=4',
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
            'name' => 'steve',
            'username' => 'user_two',
            'email' => 'user@user.com',
            'password' => bcrypt(env('SEED_PASS')),
            'interests' => '["Industry & Business", "Arts, Entertainment & Culture"]',
        ]);

        

        // creates an idea for the dev
        DB::table('ideas')->insert([
            'user_id' => '1234',
            'success' => true,
            'id' => '5678',
            'title' => 'any.ideas',
            'pitch' => 'Lorem ipsum dolor amet deep v shaman kitsch hoodie, vinyl meggings tattooed cliche. Chillwave authentic blog, squid la croix raw denim biodiesel intelligentsia paleo twee fixie bitters pitchfork. Sartorial poutine franzen swag, mustache woke salvia scenester. Lumbersexual freegan typewriter gentrify, pabst enamel pin vinyl waistcoat leggings +1 irony fixie. Four loko keytar pok pok, taiyaki ugh snackwave pitchfork pork belly butcher hella stumptown. 90s normcore health goth ramps la croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'Creating',
            'category' => 'business',
            'tags' => "['vue','cooking','rabbits']",
            'description' => "## SEED Data
            To push the seed table data run  `php artisan migrate:refresh --seed` *running this will clear any data currently in the tables*
            ------
            for testing purposes, we can add data to the `/database/seeds/DatabaseSeeder.php` file. This allows us to create database entries automatically.
            
            The below code provides an example of how to push test data to the database. The `users` table is defined, and then the corresponding fields are outlined within the `insert([])` array.
            
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
            ```
            any table can have data pushed using the same schema",
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
            'tags' => "['react','music','lyrics']",
            'description' => "** Desc can have data pushed using the same schema**",
            'darts' => '12'
        ]);

        DB::table('ideas')->insert([
            'user_id' => '1234',
            'success' => false,
            'id' => '5679',
            'title' => 'lyrical',
            'pitch' => 'Lorem ipsum dolor amet deep v shaman kitsch hoodie, vinyl meggings tattooed cliche. Chillwave authentic blog, squid la croix raw denim biodiesel intelligentsia paleo twee fixie bitters pitchfork. Sartorial poutine franzen swag, mustache woke salvia scenester. Lumbersexual freegan typewriter gentrify, pabst enamel pin vinyl waistcoat leggings +1 irony fixie. Four loko keytar pok pok, taiyaki ugh snackwave pitchfork pork belly butcher hella stumptown. 90s normcore health goth ramps la croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'evaluating',
            'category' => 'industry',
            'tags' => "['react','music','lyrics']",
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
            'tags' => "['react','music','lyrics']",
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
            'tags' => "['vue','photography','cheese']",
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
            'tags' => "['vue','photography','cheese']",
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
            'darts' => '8'
        ]);

        DB::table('updates_posts')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'id' => '1120',
            'message' => 'updates message'
        ]);

        DB::table('updates_posts')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'id' => '1121',
            'message' => 'updates message number two'
        ]);

        DB::table('discussions')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'id' => '2120',
            'message' => 'sick idea man - have you tried turning it around?',
            'title' => 'Turn it around'
        ]);

        DB::table('discussion_replies')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'discussions_id' => '2120',
            'id' => '5555',
            'message' => 'sick idea man - have you tried turning it around?',
            'darts' => '2'
        ]);

        DB::table('discussion_replies')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'discussions_id' => '2120',
            'id' => '5556',
            'message' => 'super dooper, have you tried green?',
            'darts' => '48'
        ]);
    }
}
