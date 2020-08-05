<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobCategory;

class JobCategoryController extends Controller
{
    
    function fetchAll(){

        try{

            $jobCategories = JobCategory::all();
            return response()->json(["success" => true, "jobCategories" => $jobCategories]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

}
