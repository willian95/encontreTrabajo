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
    
    function index(){
        return view("users.proposals");
    }

    function store(ProposalStoreRequest $request){

        try{

            $proposal = new Proposal;
            $proposal->user_id = \Auth::user()->id;
            $proposal->offer_id = $request->offerId;
            $proposal->proposal = str_replace("\n", "", $request->proposal);
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

    function answer(ProposalStoreRequest $request){

        try{

            $proposal = new Proposal;
            $proposal->user_id = $request->user_id;
            $proposal->offer_id = $request->offerId;
            $proposal->proposal = str_replace("\n", ". ", $request->proposal);
            $proposal->is_answer = 1;
            $proposal->save();

            $offer = Offer::where("id", $request->offerId)->first();
            $offer->proposal_updated_at = Carbon::now();
            $offer->update();

            $user = User::where("id", $offer->user_id)->first();

            $data = ["messageMail" => "Hola ".$user->name.", la empresa ".\Auth::user()->name." ha respondido tu oferta de trabajo. Haz click en el botón para conocer su respuesta", "slug" => $offer->slug];
            $to_name = $user->name;
            $to_email = $user->email;

            \Mail::send("emails.proposalNotification", $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject("¡La empresa ".\Auth::user()->name." te ha respondido!");
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

            $proposals = Proposal::skip($skip)->take($dataAmount)->where('offer_id', $request->offerId)->where("is_answer", 0)->groupBy("offer_id", "user_id")->orderBy("id", "desc")->with("user")->with("offer")->has("user")->has("offer")->get();
            $proposalsCount = Proposal::with("user")->with("offer")->has("user")->has("offer")->where('offer_id', $request->offerId)->where("is_answer", 0)->groupBy("offer_id", "user_id")->count();

            return response()->json(["success" => true, "proposals" => $proposals, "proposalsCount" => $proposalsCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function myProposals($page = 1){

        try{
            
            $dataAmount = 20;
            $skip = ($page - 1) * $dataAmount;

            $proposals = Proposal::skip($skip)->take($dataAmount)->whereHas('offer', function($q){

                $q->where("user_id", \Auth::user()->id);

            })->orderBy("id", "desc")->with("user", "offer")->groupBy("offer_id", "user_id")->has("user")->get();

            $proposalsCount = Proposal::with("user", "offer")->whereHas('offer', function($q){

                $q->where("user_id", \Auth::user()->id);

            })->has("user")->groupBy("offer_id", "user_id")->count();

            return response()->json(["success" => true, "proposals" => $proposals, "proposalsCount" => $proposalsCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
       
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function myAppliesView(){
        return view("users/applies");
    }

    function myApplies($page = 1){

        try{
            
            $dataAmount = 20;
            $skip = ($page - 1) * $dataAmount;

            $applies = Proposal::skip($skip)->take($dataAmount)->orderBy("id", "desc")->with("user", "offer", "offer.user")->groupBy("offer_id")->has("user")->has("offer")->has("offer.user")->get();
            $appliessCount = Proposal::with("user", "offer")->has("user")->has("offer")->has("offer.user")->groupBy("offer_id")->count();

            return response()->json(["success" => true, "applies" => $applies, "appliessCount" => $appliessCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
       
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function messages($slug, $email){

        try{

            $offer = Offer::where("slug", $slug)->with("user", "user.region", "user.commune", "user.profile")->has("user")->has("user.profile")->first();
            $user = User::where("email", $email)->first();
            $proposals = Proposal::where("offer_id", $offer->id)->where("user_id", $user->id)->get();

            return view("users.messages", ["proposals" => $proposals, "offer" => $offer, "user" => $user]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function fetchMessages(Request $request){

        try{

            $proposals = Proposal::where("offer_id", $request->offerId)->where("user_id", $request->user)->with("user")->get();
            return response()->json(["success" => true, "proposals" => $proposals]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

}
