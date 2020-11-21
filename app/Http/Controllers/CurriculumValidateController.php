<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;

class CurriculumValidateController extends Controller
{
    
    function index(){

        return view("admin.curriculumValidation.index");

    }

    function fetch($page){

        try{

            $dataAmount = 18;
            $skip = ($page - 1) * $dataAmount;

            $profiles = Profile::skip($skip)->take($dataAmount)->with("user")->has("user")->where("request_for_curriculum_validation", 1)->get();
            $profilesCount = Profile::with("user")->has("user")->where("request_for_curriculum_validation", 1)->count();

            return response()->json(["success" => true, "profiles" => $profiles, "profilesCount" => $profilesCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function approveCurriculum(Request $request){

        try{

            $profile = Profile::where("user_id", $request->user_id)->first();
            $profile->request_for_curriculum_validation = 0;
            $profile->is_curriculum_validated = 1;
            $profile->update();

            $user = User::find($request->user_id);

            $data = ["messageMail" => "Hola ".$user->name.", el administrador ya validó tu correo", "link" => url('/').'/profile/show/'.$user->id];
            $to_name = $user->name;
            $to_email = $user->email;

            \Mail::send("emails.userCurriculumValidation", $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject("¡Tu curriculum ha sido validado!");
                $message->from( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            return response()->json(["success" => true, "msg" =>"Curriculum validado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

}
