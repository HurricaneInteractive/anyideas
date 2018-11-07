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
            'interests' => '["technology", "entertainment"]',
        ]);

        // creates an idea for the dev
        DB::table('ideas')->insert([
            'user_id' => '1234',
            'success' => true,
            'title' => 'any.ideas',
            'pitch' => 'Lorem ipsum dolor amet deep v shaman kitsch hoodie, vinyl meggings tattooed cliche. Chillwave authentic blog, squid la croix raw denim biodiesel intelligentsia paleo twee fixie bitters pitchfork. Sartorial poutine franzen swag, mustache woke salvia scenester. Lumbersexual freegan typewriter gentrify, pabst enamel pin vinyl waistcoat leggings +1 irony fixie. Four loko keytar pok pok, taiyaki ugh snackwave pitchfork pork belly butcher hella stumptown. 90s normcore health goth ramps la croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'creating',
            'category' => 'business',
            'tags' => '["tags","of","ideas"]',
            'description' => "## so the idea is.... it just **works**

            >...hopefully",
            'darts' => '3'
        ]);
    }
}
