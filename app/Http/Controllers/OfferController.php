<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Http\Requests\OfferStoreRequest;
use App\Offer;
use App\OfferViewer;
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
            $offer->description = $request->description;
            $offer->job_position = $request->jobPosition;
            $offer->category_id = $request->category;
            $offer->expiration_date = Carbon::now()->addDays(30);
            $offer->slug = $slug;
            $offer->wage_type = $request->wageType;
            $offer->is_highlighted = $request->highlightPost;
            $offer->user_id = \Auth::user()->id;
            $offer->save();

            if(User::where('id', \Auth::user()->id)->first()->expire_free_trial->lt(Carbon::now())){
                //dd("entre");
                $serviceAmount = serviceAmount::where("user_id", \Auth::user()->id)->first();
                if($request->highlightPost == true){
                    $serviceAmount->highlighted_post_amount = $serviceAmount->highlighted_post_amount - 1;
                }else{

                    if($serviceAmount->due_date->lt(Carbon\Carbon::now()) || $serviceAmount->due_date == null){
                        $serviceAmount->simple_post_amount = $serviceAmount->simple_post_amount - 1;
                    }

                }
                
                $serviceAmount->update();
            }

            return response()->json(["success" => true, "msg" => "Oferta publicada"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function update(OfferStoreRequest $request){

        try{


            $offer = Offer::find($request->id);
            $offer->title = $request->title;
            $offer->min_wage = $request->minWage;
            $offer->description = $request->description;
            $offer->job_position = $request->jobPosition;
            $offer->category_id = $request->category;
            $offer->wage_type = $request->wageType;
            $offer->is_highlighted = $request->highlightPost;
            $offer->update();

            return response()->json(["success" => true, "msg" => "Oferta actualizada"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function userFetch($page = 1){

        try{
            $dataAmount = 18;
            $skip = ($page - 1) * $dataAmount;

            $offers = Offer::skip($skip)->where("status", "abierto")->take($dataAmount)->orderBy("id", "desc")->with("user")->has("user")->whereDate('expiration_date', '>', Carbon::today()->toDateString())->get();
            $offersCount = Offer::with("user")->where("status", "abierto")->has("user")->whereDate('expiration_date', '>', Carbon::today()->toDateString())->count();

            return response()->json(["success" => true, "offers" => $offers, "offersCount" => $offersCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function edit($id){

        $offer = Offer::where("user_id", \Auth::user()->id)->where("id", $id)->first();

        if($offer){



        }else{
            abort(503);
        }

    }

    function BusinessFetch($page = 1){

        try{
            $dataAmount = 18;
            $skip = ($page - 1) * $dataAmount;

            $offers = Offer::skip($skip)->take($dataAmount)->where('user_id', \Auth::user()->id)->whereDate('expiration_date', '>', Carbon::today()->toDateString())->orderBy("proposal_updated_at", "desc")->with("user", "category", "views")->has("user")->with("user.region")->has("user.region")->get();
            $offersCount = Offer::with("user")->has("user", "category", "views")->where('user_id', \Auth::user()->id)->whereDate('expiration_date', '>', Carbon::today()->toDateString())->with("user.region")->has("user.region")->count();

            return response()->json(["success" => true, "offers" => $offers, "offersCount" => $offersCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function show($slug){

        try{

            $offer = Offer::where("slug", $slug)->with("user", "user.region", "user.commune", "user.profile")->has("user")->has("user.profile")->firstOrFail();
            
            if(\Auth::user()->role_id == 2){

                $viewer = new OfferViewer;
                $viewer->offer_id = $offer->id;
                $viewer->save();

                return view("users.offerDetailsUser", ["offer" => $offer]);
            }else if(\Auth::user()->role_id == 3){
                return view("users.offerDetails", ["offer" => $offer]);
            }

        }catch(\Exception $e){
            abort(403);
        }

    }

}
