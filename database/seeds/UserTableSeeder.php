<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'Barbie',
            'twitter_username' => 'barbijaputa',
            'email' => 'bar@bie.com',
            'password' => bcrypt('barbiebarbie')
        ]);

        User::create([
            'name' => 'Waltraud',
            'twitter_username' => 'wallie69',
            'email' => 'waltraudgarciaheveling@gmail.com',
            'password' => bcrypt('oscar')
        ]);
    }
}
