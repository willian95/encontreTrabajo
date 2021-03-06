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
            if($request->wageType == "2"){
                $offer->min_wage = 0;
            }else{
                $offer->min_wage = $request->minWage;
            }
           
            $offer->description = $request->description;
            $offer->job_position = $request->jobPosition;
            $offer->category_id = $request->category;
            $offer->expiration_date = Carbon::now()->addDays(30);
            $offer->slug = $slug;
            $offer->wage_type = $request->wageType;
            $offer->is_highlighted = $request->highlightPost;
            $offer->extra_wage = $request->extraWage;
            $offer->user_id = \Auth::user()->id;
            $offer->region_id = $request->region;
            $offer->commune_id = $request->commune;
            $offer->address = $request->address;
            $offer->inclusive = $request->inclusive;
            $offer->job_number = $request->jobNumbers; 
            $offer->save();

            if(User::where('id', \Auth::user()->id)->first()->expire_free_trial->lt(Carbon::now())){
                //dd("entre");
                $serviceAmount = serviceAmount::where("user_id", \Auth::user()->id)->first();
                if($request->highlightPost == true){
                    $serviceAmount->highlighted_post_amount = $serviceAmount->highlighted_post_amount - 1;
                }else{
                    
                    if($serviceAmount->due_date == null){
                        $serviceAmount->simple_post_amount = $serviceAmount->simple_post_amount - 1;
                    }else{
                        
                        if($serviceAmount->due_date->lt(Carbon\Carbon::now())){
                            $serviceAmount->simple_post_amount = $serviceAmount->simple_post_amount - 1;
                        }
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

            if(\Auth::user()->role_id == 1){
                $offer = Offer::where("id", $request->id)->first();
            }else{
                $offer = Offer::where("user_id", \Auth::user()->id)->where("id", $request->id)->first();
            }
            
            if($offer){

                $previousHighlighted = 0;
                $offer = Offer::find($request->id);
                $previousHighlighted = $offer->is_highlighted;
                $offer->title = $request->title;
                $offer->min_wage = $request->minWage;
                $offer->description = $request->description;
                $offer->job_position = $request->jobPosition;
                $offer->category_id = $request->category;
                $offer->wage_type = $request->wageType;
                $offer->is_highlighted = $request->highlightPost;
                $offer->extra_wage= $request->extraWage;
                $offer->region_id = $request->region;
                $offer->commune_id = $request->commune;
                $offer->address = $request->address;
                $offer->inclusive = $request->inclusive;
                $offer->job_number = $request->jobNumbers; 
                $offer->update();

                if($previousHighlighted == 0 && $offer->is_highlighted == 1){
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
                }

                return response()->json(["success" => true, "msg" => "Oferta actualizada"]);

            }else{

                return response()->json(["success" => false, "msg" => "Oferta no encontrada"]);

            }

            

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function delete(Request $request){

        $offer = Offer::where("user_id", \Auth::user()->id)->where("id", $request->id)->first();
        if($offer){
            $offer->delete();
            return response()->json(["success" => true, "msg" => "Oferta eliminada"]);
        }else{
            return response()->json(["success" => false, "msg" => "Oferta no encontrada"]);
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

            return view("users.offersEdit", ["offer" => $offer]);

        }else{
            abort(503);
        }

    }

    function BusinessFetch($page = 1, Request $request){

        try{
            $dataAmount = 18;
            $skip = ($page - 1) * $dataAmount;

            $query = Offer::skip($skip)->take($dataAmount)->where('user_id', \Auth::user()->id)->whereDate('expiration_date', '>', Carbon::today()->toDateString())->with("user", "category", "views")->with("user.region")->has("user.region")->has("user")->has("category");
            
            if(isset($request->order)){
                
                if($request->order == 1){
                    $query->orderBy("id", "desc");
                }else if($request->order == 2){
                    $query->orderBy("id", "asc");
                }
                
            }else{

                $query->orderBy("proposal_updated_at", "desc");

            }

            $offers = $query->get();
            $offersCount = Offer::with("user", "category")->where('user_id', \Auth::user()->id)->whereDate('expiration_date', '>', Carbon::today()->toDateString())->with("user.region")->has("user.region")->has("user")->has("category")->count();

            return response()->json(["success" => true, "offers" => $offers, "offersCount" => $offersCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function show($slug){

        try{

            $offer = Offer::where("slug", $slug)->with("user", "user.region", "user.commune", "user.profile")->has("user")->has("user.profile")->has("user.region")->has("user.commune")->firstOrFail();
            
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
