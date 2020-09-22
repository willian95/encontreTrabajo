<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;

class SearchController extends Controller
{
    
    function index(){

        return view("users/search");

    }

    function search(Request $request){

        try{

            if(\Auth::user()->role_id == 2){

                $words = explode(' ',strtolower($request->search)); // coloco cada palabra en un espacio del array
                $wordsToDelete = array('de');

                $words = array_values(array_diff($words,$wordsToDelete));

                $dataAmount = 18;
                $skip = ($request->page - 1) * $dataAmount;

                $offers = Offer::with("user")->has("user")
                ->where(function ($query) use($words) {
                    for ($i = 0; $i < count($words); $i++){
                        if($words[$i] != ""){
                            //$query->orWhere('description', "like", "%".$words[$i]."%");
                            $query->orWhere('title', "like", "%".$words[$i]."%");
                            $query->orWhere('job_position', "like", "%".$words[$i]."%");
                            $query->orWhere('description', "like", "%".$words[$i]."%");
                            
                        }
                    }      
                })
                ->where("status", "abierto")
                ->whereDate('expiration_date', '>', Carbon::today()->toDateString())
                ->take($dataAmount)
                ->orderBy("id", "desc")
                ->get();

                $offersCount = Offer::with("user")->has("user")
                ->where(function ($query) use($words) {
                    for ($i = 0; $i < count($words); $i++){
                        if($words[$i] != ""){
                            //$query->orWhere('description', "like", "%".$words[$i]."%");
                            $query->orWhere('title', "like", "%".$words[$i]."%");
                            $query->orWhere('job_position', "like", "%".$words[$i]."%");
                            $query->orWhere('description', "like", "%".$words[$i]."%");
                            
                        }
                    }      
                })
                ->whereDate('expiration_date', '>', Carbon::today()->toDateString())
                ->orderBy("id", "desc")
                ->count();

            }else if(\Auth::user()->role_id == 3){

                $words = explode(' ',strtolower($request->search)); // coloco cada palabra en un espacio del array
                $wordsToDelete = array('de');

                $words = array_values(array_diff($words,$wordsToDelete));

                $dataAmount = 18;
                $skip = ($request->page - 1) * $dataAmount;

                $offers = Offer::with("user")->has("user")
                ->where(function ($query) use($words) {
                    for ($i = 0; $i < count($words); $i++){
                        if($words[$i] != ""){
                            //$query->orWhere('description', "like", "%".$words[$i]."%");
                            $query->orWhere('title', "like", "%".$words[$i]."%");
                            $query->orWhere('job_position', "like", "%".$words[$i]."%");
                            $query->orWhere('description', "like", "%".$words[$i]."%");
                            
                        }
                    }      
                })
                ->where("status", "abierto")
                ->where("user_id", \Auth::user()->id)
                ->whereDate('expiration_date', '>', Carbon::today()->toDateString())
                ->take($dataAmount)
                ->orderBy("id", "desc")
                ->get();

                $offersCount = Offer::with("user")->has("user")
                ->where(function ($query) use($words) {
                    for ($i = 0; $i < count($words); $i++){
                        if($words[$i] != ""){
                            //$query->orWhere('description', "like", "%".$words[$i]."%");
                            $query->orWhere('title', "like", "%".$words[$i]."%");
                            $query->orWhere('job_position', "like", "%".$words[$i]."%");
                            $query->orWhere('description', "like", "%".$words[$i]."%");
                            
                        }
                    }      
                })
                ->whereDate('expiration_date', '>', Carbon::today()->toDateString())
                ->where("user_id", \Auth::user()->id)
                ->orderBy("id", "desc")
                ->count();

            }

            
            
            //$offersCount = Offer::with("user")->where("status", "abierto")->has("user")->count();

            return response()->json(["success" => true, "offers" => $offers, "offersCount" => $offersCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "ln" => $e->getLine(), "err" => $e->getMessage()]);
        }

    }

}
