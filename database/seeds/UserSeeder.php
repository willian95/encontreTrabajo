<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        /*if(User::where('id', 1)->first() == null){

            $user = new User;
            $user->id = 1;
            $user->name = "admin";
            $user->email = "admin@gmail.com";
            $user->role_id = 1;
            $user->password = bcrypt('12345678');
            $user->save();

        }

        if(User::where("email", "juan@gmail.com")->first() == null){
            $user = new User;
            $user->name = "juan";
            $user->email = "juan@gmail.com";
            $user->role_id = 2;
            $user->password = bcrypt('12345678');
            $user->save();
        }
        
        if(User::where("email", "pedro@gmail.com")->first() == null){
            $user = new User;
            $user->name = "pedro";
            $user->email = "pedro@gmail.com";
            $user->role_id = 2;
            $user->password = bcrypt('12345678');
            $user->save();
        }

        if(User::where("email", "sofia@gmail.com")->first() == null){
            $user = new User;
            $user->name = "sofia";
            $user->email = "sofia@gmail.com";
            $user->role_id = 2;
            $user->password = bcrypt('12345678');
            $user->save();
        }

        if(User::where("email", "cm@gmail.com")->first() == null){
            $user = new User;
            $user->name = "Contact Marketing";
            $user->email = "cm@gmail.com";
            $user->role_id = 3;
            $user->password = bcrypt('12345678');
            $user->save();
        }

        if(User::where("email", "puntodata@gmail.com")->first() == null){
            $user = new User;
            $user->name = "Punto Data";
            $user->email = "puntodata@gmail.com";
            $user->role_id = 3;
            $user->password = bcrypt('12345678');
            $user->save();
        }*/

    }
}
