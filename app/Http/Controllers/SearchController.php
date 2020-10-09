<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Offer;
use App\Profile;

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

    function businessIndex(){
        return view("users.businessSearch");
    }

    function businessSearch(Request $request){
        try{
            
            $usersArray = [];
            $dataAmount = 18;
            $skip = ($request->page - 1) * $dataAmount;
            $usersCount = 0;
            $count = 0;
            $offsetCount = 0;

            foreach(Profile::has("user")->with("user")->get() as $profile){
                
                
                    if($count >= $dataAmount){
                        break;
                    }

                    if(strlen($profile->desired_areas) > 0){
                        $areasArray = explode(",", $profile->desired_areas);
                        if($offsetCount >= $skip){
                            if(in_array($request->search."", $areasArray)){
                                $usersArray[] = [
                                    "users" => $profile
                                ];
                                $count++;
                            }
                        }
                
                        $offsetCount++;


                    }
                
                
            }

            foreach(Profile::has("user")->with("user")->get() as $profile){
                $areasArray = explode(",", $profile->desired_areas);
                if(in_array($request->search."", $areasArray)){
                    $usersCount++;
                }
            }

            return response()->json(["success" => true, "users" => $usersArray, "dataAmount" => $dataAmount, "usersCount" => $usersCount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "ln" => $e->getLine(), "err" => $e->getMessage()]);
        }
    }

}
