<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        if(Role::where("id", 1)->first() == null){
            $role = new Role;
            $role->id = 1;
            $role->name = "admin";
            $role->save();
        }

        if(Role::where("id", 2)->first() == null){
            $role = new Role;
            $role->id = 2;
            $role->name = "usuario";
            $role->save();
        }

        if(Role::where("id", 3)->first() == null){
            $role = new Role;
            $role->id = 3;
            $role->name = "empresa";
            $role->save();
        }

    }
}
