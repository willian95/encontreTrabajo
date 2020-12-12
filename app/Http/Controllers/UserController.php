<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SendEmailRequest;
use App\serviceAmount;
use App\Proposal;
use App\Offer;
use App\User;

class UserController extends Controller
{
    function index(){
        return view('admin.user.index');
    }

    function business(){
        return view('admin.business.index');
    }

    function fetch($page = 1){

        try{

            $skip = ($page - 1) * 20;

            $users = User::with("role")->skip($skip)->where("role_id", 2)->take(20)->get();
            $usersCount = User::with("role")->where("role_id", 2)->count();

            return response()->json(["success" => true, "users" => $users, "usersCount" => $usersCount]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor"]);

        }

    }

    function fetchBusiness($page = 1){

        try{

            $skip = ($page - 1) * 20;

            $users = User::with("role")->skip($skip)->where("role_id", 3)->take(20)->get();
            $usersCount = User::with("role")->where("role_id", 3)->count();

            return response()->json(["success" => true, "users" => $users, "usersCount" => $usersCount]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor"]);

        }

    }

    function getServiceAmount(){

        return response()->json(serviceAmount::where("user_id", \Auth::user()->id)->get());

    }

    function delete(Request $request){

        try{

            $user = User::where("id", $request->id)->first();
            $user->email = $user->email."-rm";
            $user->update();

            foreach(Offer::where("id", $user->id)->get() as $offer){

                Proposal::where("offer_id", $offer->id)->delete();

            }
            Offer::where("user_id", $user->id)->delete();
            $user->delete();

            return response()->json(["success" => true, "msg" => "Usuario eliminado"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function sendEmail(SendEmailRequest $request){

        try{

            $user = User::where("email", $request->email)->first();
            $to_name = $user->name;
            $to_email = $user->email;
            $data = ["messageMail" => $request->text];

            \Mail::send("emails.emailUser", $data, function($message) use ($to_name, $to_email) {

                $message->to($to_email, $to_name)->subject("¡Valida tu correo!");
                $message->from( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));

            });

            return response()->json(["success" => true, "msg" => "Mensaje enviado"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

}
