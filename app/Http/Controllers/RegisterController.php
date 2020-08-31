<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;
use App\Profile;
use App\serviceAmount as ServiceAmount;

class RegisterController extends Controller
{
    
    function index(){
        return view("register");
    }

    function register(RegisterRequest $request){

        try{

            $registerHash = Str::random(40);

            $user = new User;
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role_id = $request->role_id;
            $user->desired_job = $request->desiredJob;
            $user->image = url('/').'/images/users/default.jpg';
            //$user->commune_id = $request->commune;
            //$user->region_id = $request->region;
            $user->register_hash = $registerHash;
            $user->business_name = $request->businessName;
            $user->business_rut = $request->businessRut;
            $user->business_phone = $request->businessPhone;
            
            if($request->role_id == 3){
                $user->expire_free_trial = Carbon::now()->addMonths(6);
            }
            
            $user->save();

            if($request->role_id == 3){
                $serviceAmount = new ServiceAmount;
                $serviceAmount->user_id = $user->id;
                $serviceAmount->save();
            }

            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->save();
            
            $data = ["messageMail" => "Hola ".$user->name.", haz click en el siguiente enlace para validar tu cuenta", "registerHash" => $registerHash];
            $to_name = $user->name;
            $to_email = $user->email;

            \Mail::send("emails.verifyMail", $data, function($message) use ($to_name, $to_email) {

                $message->to($to_email, $to_name)->subject("¡Valida tu correo!");
                $message->from( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));

            });

            return response()->json(["success" => true, "msg" => "Te has registrado con éxito, revisa tu correo para validar tu cuenta"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function verify($registerHash){

        try{

            $user = User::where("register_hash", $registerHash)->firstOrFail();
            $user->register_hash = null;
            $user->email_verified_at = Carbon::now();
            $user->update();
            
            return redirect()->to('/')->with('alert', 'Has validado tu cuenta, puedes ingresar a la plataforma');

        }catch(\Exception $e){
            abort(403);
        }

    }

}
