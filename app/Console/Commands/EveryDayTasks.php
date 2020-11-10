<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Profile;

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
        
        $users = Profile::whereRaw("to_char(birth_date, 'MM-DD')::text = '" . date("m-d") . "'")->with("user")->get();
        
        foreach($users as $user){

            Log::info($user->user->email);

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
