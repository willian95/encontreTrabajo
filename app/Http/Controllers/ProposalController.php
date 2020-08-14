<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProposalStoreRequest;
use Carbon\Carbon;
use App\Offer;
use App\Proposal;
use App\User;

class ProposalController extends Controller
{
    
    function store(ProposalStoreRequest $request){

        try{

            $proposal = new Proposal;
            $proposal->user_id = \Auth::user()->id;
            $proposal->offer_id = $request->offerId;
            $proposal->proposal = $request->proposal;
            $proposal->save();

            $offer = Offer::where("id", $request->offerId)->first();
            $offer->proposal_updated_at = Carbon::now();
            $offer->update();

            $user = User::where("id", $offer->user_id)->first();

            $data = ["messageMail" => "Hola ".$user->name.", el usuario ".\Auth::user()->name." ha respondido tu oferta de trabajo. Haz click en el botón para conocer su propuesta", "slug" => $offer->slug];
            $to_name = $user->name;
            $to_email = $user->email;

            \Mail::send("emails.proposalNotification", $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject("¡Han respondido tu oferta de trabajo!");
                $message->from( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            return response()->json(["success" => true, "msg" => "Propuesta creada, espere su respuesta"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function fetch(Request $request){

        try{
            
            $dataAmount = 20;
            $skip = ($request->page - 1) * $dataAmount;

            $proposals = Proposal::skip($skip)->take($dataAmount)->where('offer_id', $request->offerId)->orderBy("id", "desc")->with("user")->get();
            $proposalsCount = Proposal::with("user")->where('offer_id', $request->offerId)->count();

            return response()->json(["success" => true, "proposals" => $proposals, "proposalsCount" => $proposalsCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

}
