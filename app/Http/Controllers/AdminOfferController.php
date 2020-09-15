<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;

class AdminOfferController extends Controller
{
    
    function index(){
        return view("admin.offers.index");
    }

    function fetch($page = 1){

        try{
            $dataAmount = 18;
            $skip = ($page - 1) * $dataAmount;

            $offers = Offer::skip($skip)->take($dataAmount)->orderBy("id", "desc")->with("user")->has("user")->with("category")->has("category")->get();
            $offersCount = Offer::with("user")->has("user")->with("category")->has("category")->count();

            return response()->json(["success" => true, "offers" => $offers, "offersCount" => $offersCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Ocurrió un problema"]);
        }

    }

    function search(Request $request){

        try{

            $dataAmount = 18;
            $skip = ($request->page - 1) * $dataAmount;

            $offers = Offer::skip($skip)->take($dataAmount)->orderBy("id", "desc")->with("user")->has("user")->with("category")->has("category")->where(function($q) use($request){

                $q->orWhere("title", 'like', '%'.$request->search.'%');
                $q->orWhere("job_position", 'like', '%'.$request->search.'%');
                $q->orWhereHas('user', function($userQuery) use($request){
                    $userQuery->where('business_name', 'like', '%'.$request->search.'%');
                });

            })->get();
            $offersCount = Offer::with("user")->has("user")->with("category")->has("category")->count();

            return response()->json(["success" => true, "offers" => $offers, "offersCount" => $offersCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Ocurrió un problema"]);
        }

    }

}
