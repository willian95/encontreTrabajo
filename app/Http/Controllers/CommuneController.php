<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commune;

class CommuneController extends Controller
{
    function fetchByRegion($region_id){

        try{

            $communes = Commune::where("region_id", $region_id)->get();
            return response()->json(["success" => true, "communes" => $communes]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }


    }
}
