<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OfferStoreRequest;
use App\Offer;
use App\serviceAmount;

class OfferController extends Controller
{

    function create(){

        return view("users.offersCreate");

    }
    
    function store(OfferStoreRequest $request){

        try{

            if(isset($request->maxWage)){
                if($request->maxWage < $request->minWage){
                    return response()->json(["susccess" => false, "msg" => "El sueldo máximo no puede ser menor al mínimo"]);
                }
            }

            $slug = str_replace(" ", "-", $request->title);
            $slug = str_replace("/", "-", $slug);
            $slug = str_replace(".", "-", $slug);

            if(Offer::where("slug", $slug)->count() > 0){
                $slug = $slug."-".uniqid();
            }

            $offer = new Offer;
            $offer->title = $request->title;
            $offer->min_wage = $request->minWage;
            $offer->max_wage = $request->maxWage;
            $offer->description = str_replace("\n", ". ", $request->description);
            $offer->job_position = $request->jobPosition;
            $offer->category_id = $request->category;
            $offer->slug = $slug;
            $offer->user_id = \Auth::user()->id;
            $offer->save();

            $serviceAmount = serviceAmount::where("user_id", \Auth::user()->id)->first();
            $serviceAmount->post_amount = $serviceAmount->post_amount - 1;
            $serviceAmount->update();

            return response()->json(["success" => true, "msg" => "Oferta publicada"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function userFetch($page = 1){

        try{
            $dataAmount = 18;
            $skip = ($page - 1) * $dataAmount;

            $offers = Offer::skip($skip)->where("status", "abierto")->take($dataAmount)->orderBy("id", "desc")->with("user")->has("user")->get();
            $offersCount = Offer::with("user")->where("status", "abierto")->has("user")->count();

            return response()->json(["success" => true, "offers" => $offers, "offersCount" => $offersCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function BusinessFetch($page = 1){

        try{
            $dataAmount = 18;
            $skip = ($page - 1) * $dataAmount;

            $offers = Offer::skip($skip)->take($dataAmount)->where('user_id', \Auth::user()->id)->orderBy("proposal_updated_at", "desc")->with("user")->has("user")->get();
            $offersCount = Offer::with("user")->has("user")->where('user_id', \Auth::user()->id)->count();

            return response()->json(["success" => true, "offers" => $offers, "offersCount" => $offersCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function show($slug){

        try{

            $offer = Offer::where("slug", $slug)->with("user", "user.region", "user.commune", "user.profile")->has("user")->has("user.profile")->firstOrFail();
            return view("users.offerDetails", ["offer" => $offer]);

        }catch(\Exception $e){
            
            abort(403);
        }

    }

}
