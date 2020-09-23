<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;
use ssh2_connect;

class ConferenceController extends Controller
{
    function store(Request $request){

        try{
            
            $room_name = Str::random(40);
            $password = Str::random(15);
            $name = explode(" ", \Auth::user()->name);
            $username = $name[0].Str::random(4);

            $appointment = new Appointment;
            $appointment->user_id = \Auth::user()->id;
            $appointment->room_name = $room_name;
            $appointment->guest_id = $request->guest_id;
            $appointment->name = $username;
            $appointment->password = $password;
            $appointment->date_time = Carbon::createFromFormat('d/m/Y H:i', $request->date_time);
            $appointment->save();

            $connection = ssh2_connect(env('JITSI_SERVER_IP'), 22);
            ssh2_auth_password($connection, env('JITSI_SERVER_USER'), env('JITSI_SERVER_PASSWORD'));
            ssh2_exec($connection, 'prosodyctl register '.$username.' '.env('JITSI_DOMAIN').' '.$password);

            $data = ["businessName" => \Auth::user()->business_name, "date_time" => $request->date_time, "link" => url('/conference/'.$room_name)];
            $to_name = User::where("id", $request->guest_id)->first()->name;
            $to_email = User::where("id", $request->guest_id)->first()->email;

            \Mail::send("emails.conferenceNotification", $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject("¡Tienes una conferencia!");
                $message->from( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            $data = ["username" => $username, "password" => $password, "date_time" => $request->date_time, "link" => url('/conference/'.$room_name)];
            $to_name = User::where("id", $request->guest_id)->first()->name;
            $to_email = User::where("id", $request->guest_id)->first()->email;

            \Mail::send("emails.conferenceBusinessNotification", $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject("¡Tienes una conferencia!");
                $message->from( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });


        }catch(\Exception $e){

            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);
        }

    }

    function conferenceRoom($room_name){
        
        try{

            return view("users.conferenceLogin", ["room_name" => $room_name]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);
        }
    }

    function conferenceShowRoom(Request $request, $room_name){
        
        try{    

            if($request->password == Appointment::where("room_name", $room_name)->first()->password){
                return view("users.conference", ["room_name" => $room_name]);
            }

            echo "Credenciales inválidas";

        }catch(\Exception $e){

            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);
        }
    }

    function conferenceLogin(Request $request){

        try{
            if(Appointment::where('room_name', $request->room_name)->count() > 0){

                $appointment = App\Appointment::where("room_name", $request->room_name)->first();

                if(\Auth::user()->id == $appointment->user_id || \Auth::user()->id == $appointment->guest_id){

                    if(Carbon::now()->gte($appointment->date_time) && $appointment->date_time->lt($appointment->date_time->addDay())){

                        return response()->json(["success" => true]);

                    }else{

                        if($appointment->date_time->lt(Carbon::now())){
                            return response()->json(["success" => false, "msg" => "La conferencia comienza el ".$appointment->date_time]);
                        }
                        else if($appointment->date_time->addDay()->gt(Carbon\Carbon::now())){

                            return response()->json(["success" => false, "msg" => "La conferencia ha expirado"]);

                        }
                        

                    }

                }else{

                    return response()->json(["success" => false, "msg" => "Usted no ha sido invitado a esta conferencia"]);

                }

            }else
                return response()->json(["success" => false, "msg" => "Sala no encontrada"]);
            }


                @php
                    
                @endphp

                @if(\Auth::user()->id == $appointment->user_id || \Auth::user()->id == $appointment->guest_id)

                    @if(Carbon\Carbon::now()->gte($appointment->date_time) && $appointment->date_time->lt($appointment->date_time->addDay()))
                    
                        <div id="meet"></div>

                    @else

                        @if($appointment->date_time->lt(Carbon\Carbon::now()))
                            <h3>La conferencia comienza el {{ $appointment->date_time }}</h3>
                        @elseif($appointment->date_time->addDay()->gt(Carbon\Carbon::now()))
                            <h3>La conferencia ha expirado</h3>
                        @endif

                    @endif

                @else
                    <h3 class="text-center">Usted no ha sido invitado a esta conferencia</h3>
                @endif

            @

            @endif
        }

    }


}
