<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Appointment;
use App\Profile;
use ssh2_connect;

class EveryDayTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:everyday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tasks that runs everyday';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $appointments = Appointment::whereDate("date_time", "<", Carbon::now()->subDay())->get();
        foreach($appointments as $appointment){

            $connection = ssh2_connect(env("JITSI_SERVER_IP"));
            ssh2_auth_password($connection, env('JITSI_SERVER_USER'), env('JITSI_SERVER_PASSWORD'));
            ssh2_exec($connection, 'prosodyctl unregister '.$appointment->name.' '.env('JITSI_DOMAIN'));
        }

        Appointment::whereDate("date_time", "<", Carbon::now()->subDay())->delete();

        $date = Carbon::today();   
        $users = Profile::whereMonth('birth_date', '=', $date->month)->whereDay('birth_date', '=', $date->day)->with("user")->get();
        
        foreach($users as $user){

            $message = $user->user->name.", de parte de todo el equipo de Encontré Trabajo queremos desearte un feliz cumpleaños";
            $data = ["messageMail" => $message];
            $to_name = $user->user->name;
            $to_email = $user->user->email;

            \Mail::send("emails.birthday", $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject("¡Feliz Cumpleaños!");
                $message->from( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

        }

        

    }
}
