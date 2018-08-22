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
            'password' => bcrypt(env('SEED_PASS'))
        ]);

        // creates an idea for the dev
        DB::table('ideas')->insert([
            'user_id' => '1234',
            'id' => '5678',
            'title' => 'any.ideas',
            'pitch' => 'Lorem ipsum dolor amet deep v shaman kitsch hoodie, vinyl meggings tattooed cliche. Chillwave authentic blog, squid la croix raw denim biodiesel intelligentsia paleo twee fixie bitters pitchfork. Sartorial poutine franzen swag, mustache woke salvia scenester. Lumbersexual freegan typewriter gentrify, pabst enamel pin vinyl waistcoat leggings +1 irony fixie. Four loko keytar pok pok, taiyaki ugh snackwave pitchfork pork belly butcher hella stumptown. 90s normcore health goth ramps la croix pabst chicharrones XOXO man braid gentrify shabby chic. Disrupt trust fund whatever kale chips unicorn VHS.',
            'status' => 'In Development',
            'description' => 'Lorem ipsum dolor amet brooklyn slow-carb pabst vexillologist skateboard wayfarers hot chicken cardigan. Enamel pin raclette tofu, distillery vegan palo santo helvetica iPhone kitsch edison bulb knausgaard leggings jianbing yr. Seitan locavore raclette wayfarers. Quinoa migas keffiyeh man bun bespoke banjo. Twee kickstarter food truck small batch celiac knausgaard next level chicharrones heirloom. Quinoa you probably havent heard of them distillery cardigan, cloud bread man braid tote bag. Cliche celiac put a bird on it lyft cloud bread, vaporware yr selvage. Photo booth williamsburg copper mug blog wayfarers flexitarian, tattooed health goth PBR&B organic artisan mixtape occupy.                         Mlkshk gluten-free taxidermy, schlitz paleo waistcoat health goth cray next level. Lo-fi freegan photo booth church-key venmo kale chips 8-bit meh edison bulb migas. Roof party farm-to-table butcher, cray pinterest unicorn quinoa neutra ethical swag tousled affogato shoreditch pop-up. Disrupt dreamcatcher cardigan ethical skateboard. Chartreuse paleo fingerstache vinyl scenester poutine mixtape kombucha shaman snackwave migas cliche try-hard 8-bit bespoke. Hammock tousled polaroid activated charcoal live-edge. Hell of hexagon cardigan meh actually squid banjo. Bushwick forage man bun crucifix roof party 90s semiotics retro tumeric authentic pug. Hell of keffiyeh typewriter disrupt vape live-edge. Thundercats next level sustainable four dollar toast. Beard gentrify craft beer farm-to-table kombucha, cold-pressed tote bag shabby chic small batch poke pour-over taiyaki portland microdosing echo park. Chartreuse artisan YOLO flexitarian, activated charcoal viral hell of food truck whatever 90s knausgaard godard thundercats. Edison bulb polaroid fingerstache vaporware ugh umami, meditation +1 cliche cray. Four dollar toast before they sold out kitsch affogato gentrify, salvia sustainable poke. Listicle mixtape hella seitan.',
            'darts' => '3'
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

        DB::table('discussions_entry')->insert([
            'user_id' => '1234',
            'idea_id' => '5678',
            'id' => '5252',
            'message' => 'sick idea man - have you tried turning it around?',
            'title' => 'Turn it around',
            'created_at' => '2018-08-20 20:47:07',
            'updated_at' => '2018-08-20 21:43:17'
        ]);
    }
}
