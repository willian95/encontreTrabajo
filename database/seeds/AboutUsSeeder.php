<?php

use Illuminate\Database\Seeder;
use App\AboutUs;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(AboutUs::count() <= 0)
        {
            $aboutUs = new AboutUs;
            $aboutUs->save();
        }

    }
}
