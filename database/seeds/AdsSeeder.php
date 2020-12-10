<?php

use Illuminate\Database\Seeder;
use App\Ad;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $ad = new Ad;
        $ad->place = "Home empresa";
        $ad->save();

        $ad = new Ad;
        $ad->place = "Home empresa";
        $ad->save();


    }
}
