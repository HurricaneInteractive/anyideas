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

        // creates an idea for the dev
        DB::table('ideas')->insert([
            'user_id' => '1234',
            'id' => '5678',
            'title' => 'any.ideas',
            'pitch' => 'Lorem ipsum dolor amet deep v shaman kitsch hoodie, vinyl meggings tattooed cliche. Chillwave authentic blog, squid la croix raw denim biodiesel intelligentsia paleo twee fixie bitters pitchfork. Sartorial poutine franzen swag, mustache woke salvia scenester. Lumbersexual freegan typewriter gentrify, pabst enamel pin vinyl waistcoat leggings +1 irony fixie. Four loko keytar pok pok, taiyaki ugh snackwave pitchfork pork belly butcher hella stumptown. 90s normcore health goth ramps la croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'In Development',
            'category' => 'Web App',
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
            
            
            By default, the `users` table pulls in the `SEED_*` environment files in the `.env` file. You may either add the below variables to your `.env` file, or choose to change the `DB:table` with plain string data.
            
            ```
            SEED_USER=user_name
            SEED_EMAIL=user_email
            SEED_PASS=user_password
            ```
            ---
            
            
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
            'darts' => '3'
        ]);

        DB::table('ideas')->insert([
            'user_id' => '1234',
            'id' => '1234',
            'title' => 'any.ideas.v2',
            'pitch' => 'Lorem ipsum dolor amet deep croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'Not even in Development',
            'category' => 'Mobile App',
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
            
            
            By default, the `users` table pulls in the `SEED_*` environment files in the `.env` file. You may either add the below variables to your `.env` file, or choose to change the `DB:table` with plain string data.
            
            ```
            SEED_USER=user_name
            SEED_EMAIL=user_email
            SEED_PASS=user_password
            ```
            ---
            
            
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

        DB::table('timelines')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'id' => '9876',
            'title' => 'any.ideas.v2',
            'message' => 'Lorem ipsum dolor amet deep croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'darts' => '7'
        ]);

        DB::table('user_meta')->insert([
            'user_id' => '1234',
            'id' => '4321',
            'occupation' => 'Web Dev',
            'website' => 'luke@luke.com',
            'avatar' => 'https://avatars0.githubusercontent.com/u/13529535?s=460&v=4',
            'social_media' => '{
                "facebook": "facebook.com",
                "instagram": "instagram",
                "youtube": "youtube.com"
            }'
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
            'darts' => '4'
        ]);

        DB::table('discussion_replies')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'discussions_id' => '2120',
            'id' => '5556',
            'message' => 'sick idea man - have you tried turning it around?',
            'darts' => '2'
        ]);
    }
}
