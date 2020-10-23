<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Profile;
use App\User;
use App\AcademicBackground;
use App\Search;
use Illuminate\Support\Collection;
use DB;

class StatisticController extends Controller
{
    
    function index(){

        $academic = AcademicBackground::with("user")->orderBy("end_date", "desc")->groupBy("user_id")->whereIn("educational_level", ["Básico", "Medio", "Técnico Profesional", "Universitario", "Magister", "Doctorado"])->whereNotNull("end_date")->get();
        
        $count = $academic->groupBy('educational_level')->map(function ($people) {
            return $people->count();
        });

        dd($academic, $count);


        return view("admin.statistics.index", ["academicCount" => $count]);

    }

    function usersByDate(Request $request){

        if(Carbon::parse($request->endDate)->lt(Carbon::parse($request->startDate))){

            return response()->json([ "success" => false, "msg" => "Fecha din debe ser mayor a la fecha de inicio"]);

        }

        $users = User::where("role_id", 2)->whereBetween("created_at", [Carbon::parse($request->startDate)->format('Y-m-d'), Carbon::parse($request->endDate)->format('Y-m-d')])->count();
        $business = User::where("role_id", 3)->whereBetween("created_at", [Carbon::parse($request->startDate)->format('Y-m-d'), Carbon::parse($request->endDate)->format('Y-m-d')])->count();

        return response()->json(["success" => true, "users" => $users, "business" => $business]);

    }

    function usersByLocation(Request $request){


        if($request->region == 0){
            return response()->json([ "success" => false, "msg" => "Debe seleccionar una región"]);
        }

        $raw = "";
        if(isset($request->region)){
            $raw = "region_id = ".$request->region;
        }

        if(isset($request->location)){
            $raw .= " and location_id = ".$request->location;
        }

        $users = User::where("role_id", 2)->whereRaw($raw)->count();
        $business = User::where("role_id", 3)->whereRaw($raw)->count();

        return response()->json(["success" => true, "users" => $users, "business" => $business]);

    }

    function usersByAge(Request $request){

        $raw = "";
        $query = Profile::with("user");
        if($request->ageEnd > 0){

            if($request->ageEnd < $request->ageStart){
                return response()->json([ "success" => false, "msg" => "Edad inicio debe ser mayor a edad final"]);
            }

            $query->whereDate('birth_date' , '<=', \DB::raw("CURDATE()-INTERVAL ".$request->ageStart." YEAR"))->whereDate('birth_date' , '>=', \DB::raw("CURDATE()-INTERVAL ".$request->ageEnd." YEAR"));
        }else{
            $query->whereDate('birth_date' , '<=', \DB::raw("CURDATE()-INTERVAL ".$request->ageStart." YEAR"));
        }

        $users = $query->count();
        $sql = date(strtotime('-'.$request->ageStart.'years'));

        return response()->json(["success" => true, "users" => $users, "sql" => $sql]);

    }

    function usersDesiredArea(Request $request){

        $count = Profile::with("user")->whereRaw('FIND_IN_SET("'.$request->area.'", desired_areas)')->count();
        return response()->json(["areas" => $count]);
    }

    function searchedCategories(Request $request){

        $amount = Search::where("job_category_id", $request->job_category_id)->count();
        return response()->json(["amount" => $amount]);

    }

}
