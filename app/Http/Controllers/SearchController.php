<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\Offer;
use App\Profile;
use App\Search;

class SearchController extends Controller
{
    
    function index(){

        return view("users/search");

    }

    function search(Request $request){

        try{


            if(\Auth::user()->role_id == 2){

                $dataAmount = 18;
                $skip = ($request->page - 1) * $dataAmount;


                    $words = explode(' ',strtolower($request->search)); // coloco cada palabra en un espacio del array
                    $wordsToDelete = array('de');

                    $words = array_values(array_diff($words,$wordsToDelete));

                    $offers = Offer::with("user")->with("region", "commune", "category")->has("user")->has("user.region")->has("user.commune")->has("category")
                    ->where(function ($query) use($words, $request) {
                        for ($i = 0; $i < count($words); $i++){
                            if($words[$i] != ""){
                                //$query->orWhere('description', "like", "%".$words[$i]."%");
                                $query->orWhere('title', "like", "%".$words[$i]."%");
                                $query->orWhere('job_position', "like", "%".$words[$i]."%");
                                $query->orWhere('description', "like", "%".$words[$i]."%");

                                if(isset($request->region)){
                                    $query->orWhere("region_id", $request->region);
                                }

                                if(isset($request->business)){
                                    $query->orWhere("business_name", 'like', '%'.$request->business.'%');
                                }
                                
                            }
                        }      
                    })
                    ->where("status", "abierto")
                    ->whereDate('expiration_date', '>', Carbon::today()->toDateString())
                    ->take($dataAmount)
                    ->skip($skip)
                    ->orderBy("is_highlighted", "desc")
                    ->orderBy("id", "desc");
                    
                    if(isset($request->category)){
                        $offers->where("category_id", $request->category);
                    }
                
                    $offers = $offers->get();

                    $offersCount = Offer::with("user")->with("region", "commune", "category")->has("user")->has("user.region")->has("user.commune")->has("category")
                    ->where(function ($query) use($words, $request) {
                        for ($i = 0; $i < count($words); $i++){
                            if($words[$i] != ""){
                                //$query->orWhere('description', "like", "%".$words[$i]."%");
                                $query->orWhere('title', "like", "%".$words[$i]."%");
                                $query->orWhere('job_position', "like", "%".$words[$i]."%");
                                $query->orWhere('description', "like", "%".$words[$i]."%");

                                if(isset($request->region)){
                                    $query->orWhere("region_id", $request->region);
                                }

                                if(isset($request->business)){
                                    $query->orWhere("business_name", 'like', '%'.$request->business.'%');
                                }
                                
                            }
                        }      
                    })
                    ->whereDate('expiration_date', '>', Carbon::today()->toDateString())
                    ->orderBy("id", "desc");
                    
                    if(isset($request->category)){
                        $offers->where("category_id", $request->category);
                    }
                
                    $offersCount = $offersCount->count();
                
                if(isset($request->category)){
                    $search = new Search;
                    $search->job_category_id = $request->category;
                    $search->save();
                }

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
                ->skip($skip)
                ->orderBy("id", "desc")
                ->get();

                $offersCount = Offer::with("user", "region", "commune")->has("user")->has("category")
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
            
            if(!isset($request->minAge)){
                return response()->json(["success" => false, "msg" => "Debe incluir una fecha mínima"]);

                if($request->minAge > $request->maxAge){
                    return response()->json(["success" => false, "msg" => "Fecha mínima no puede ser mayor a fecha máxima"]);
                }

            }

            $minAge = Carbon::now()->subYears($request->minAge);
            $maxAge = null;

            if(isset($request->maxAge)){
                $maxAge = Carbon::now()->subYears($request->maxAge);
            }
            
            $dataAmount = 18;
            $skip = ($request->page - 1) * $dataAmount;
            
            $query = Profile::whereDate("birth_date", "<=", $minAge)->with("user", "user.region", "user.commune")->has("user.region")->has("user.commune")->has("user")->whereHas("user", function($q){
                $q->where("is_profile_complete", 1);
            });
            if($maxAge){
                $query = $query->whereDate("birth_date", ">=", $maxAge);
            }

            if(isset($request->category)){
                $query->whereRaw('FIND_IN_SET("'.$request->category.'", desired_areas)');
            }

            if(isset($request->regionSearch)){
                $query->where("region_id", $request->regionSearch);
            }
            $profiles = $query->take($dataAmount)->skip($skip)->get();
            $profilesCount = $query->count();

            return response()->json(["profiles" => $profiles, "profilesCount" => $profilesCount, "dataAmount" => $dataAmount]);

            

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "ln" => $e->getLine(), "err" => $e->getMessage()]);
        }
    }

}
