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
        if(Ad::where("id", 1)->count()== 0){
            $ad = new Ad;
            $ad->place = "Home empresa";
            $ad->id = 1;
            $ad->save();
        }
        
        if(Ad::where("id", 2)->count()== 0){
            $ad = new Ad;
            $ad->place = "Home empresa";
            $ad->id = 2;
            $ad->save();
        }

        if(Ad::where("id", 3)->count()== 0){
            $ad = new Ad;
            $ad->place = "Home usuario";
            $ad->id = 3;
            $ad->save();
        }

        if(Ad::where("id", 4)->count()== 0){
            $ad = new Ad;
            $ad->place = "Perfil usuario";
            $ad->id = 4;
            $ad->save();
        }

        if(Ad::where("id", 5)->count()== 0){
            $ad = new Ad;
            $ad->place = "Perfil usuario";
            $ad->id = 5;
            $ad->save();
        }

        if(Ad::where("id", 6)->count()== 0){
            $ad = new Ad;
            $ad->place = "Mostrar perfil usuario";
            $ad->id = 6;
            $ad->save();
        }

        if(Ad::where("id", 7)->count()== 0){
            $ad = new Ad;
            $ad->place = "Mostrar perfil usuario";
            $ad->id = 7;
            $ad->save();
        }

        if(Ad::where("id", 8)->count()== 0){
            $ad = new Ad;
            $ad->place = "buscar empleo";
            $ad->id = 8;
            $ad->save();
        }

        if(Ad::where("id", 9)->count()== 0){
            $ad = new Ad;
            $ad->place = "buscar empleo";
            $ad->id = 9;
            $ad->save();
        }

        if(Ad::where("id", 10)->count()== 0){
            $ad = new Ad;
            $ad->place = "Empleos";
            $ad->id = 10;
            $ad->save();
        }

        if(Ad::where("id", 11)->count()== 0){
            $ad = new Ad;
            $ad->place = "Empleos";
            $ad->id = 11;
            $ad->save();
        }


    }
}
