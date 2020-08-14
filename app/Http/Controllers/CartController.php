<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

class CartController extends Controller
{
    
    function store(Request $request){

        try{

            Cart::where("user_id", \Auth::user()->id)->delete();

            $index = uniqid();

            $cart = new Cart;
            $cart->user_id = \Auth::user()->id;
            $cart->price = $request->price;
            $cart->plan_id = $request->plan_id;
            $cart->index = $index;
            $cart->save();

            return response()->json(["success" => true, "index" => $index]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);

        }

    }

}
