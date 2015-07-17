<?php

use Illuminate\Database\Seeder;
use App\Hashtag;

class HashtagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hashtags')->delete();

        Hashtag::create(['name'=> 'bootcamp']);

        Hashtag::create(['name'=> 'bootcamp2']);
    }
}
