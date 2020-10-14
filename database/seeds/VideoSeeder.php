<?php

use Illuminate\Database\Seeder;
use App\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        if(Video::count() <= 0){

            $video = new Video;
            $video->save();

        }

    }
}
