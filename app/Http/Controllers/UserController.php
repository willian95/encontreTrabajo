<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    function index(){
        return view('admin.user.index');
    }

    function fetch($page = 1){

        try{

            $skip = ($page - 1) * 20;

            $users = User::with("role")->skip($skip)->where("role_id", ">", 1)->take(20)->get();
            $usersCount = User::with("role")->where("role_id", ">", 1)->count();

            return response()->json(["success" => true, "users" => $users, "usersCount" => $usersCount]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor"]);

        }

    }

    function delete(Request $request){

        try{

            $user = User::where("id", $request->id)->first();
            $user->email = $user->email."-rm";
            $user->update();
            $user->delete();

            return response()->json(["success" => true, "msg" => "Usuario eliminado"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

}