<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{

    function index(){
        return view("login");
    }
    
    function login(LoginRequest $request){

        try{

            $user = User::where("email", $request->email)->first();
            if($user){

                if($user->email_verified_at == null){
                    return response()->json(["success" => false, "msg" => "Aún no has validado tu cuenta"]);
                }else{

                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {

                        $url = redirect()->intended()->getTargetUrl();

                        return response()->json(["success" => true, "msg" => "Usuario validado correctamente", "role_id" => Auth::user()->role_id, "url" => $url]);
                    }
                        
                    return response()->json(["success" => false, "msg" => "Contraseña inválida"]);
                    

                }

            }else{
                return response()->json(["success" => false, "msg" => "Usuario no encontrado"]);
            }

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function logout(){
        Auth::logout();
        return redirect()->to("/");
    }

}
