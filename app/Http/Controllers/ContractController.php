<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\Offer;

class ContractController extends Controller
{
    
    function store(Request $request){

        try{

            $contract = new Contract;
            $contract->offer_id = $request->offer_id;
            $contract->user_id = $request->user_id;
            $contract->save();

            $offer = Offer::where("id", $request->offer_id)->first();
            $offer->status = "cerrado";
            $offer->save();

            return response()->json(["success" => true, "msg" => "Has realizado una contratación"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

}
