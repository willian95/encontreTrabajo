<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    function index(){

        if(\Auth::user()->role_id == 2){
            return view("users.usersLanding");
        }

        if(\Auth::user()->role_id == 3){
            return view("users.businessView");
        }

    }

}
