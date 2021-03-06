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
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(JobCategories::class);
        $this->call(CountriesSeeder::class);
        $this->call(AboutUsSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(AdsSeeder::class);
    }
}
