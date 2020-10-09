<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JobReferenceStoreRequest;
use App\JobReference;

class JobReferenceController extends Controller
{
    
    function index(){
        return view("users.jobReference");
    }

    function store(JobReferenceStoreRequest $request){

        try{

            if(JobReference::where("user_id", \Auth::user()->id)->count() < 3){
                $reference = new JobReference;
                $reference->business_name = $request->business_name;
                $reference->person_name = $request->person_name;
                $reference->person_job_position = $request->person_job_position;
                $reference->person_telephone = $request->person_telephone;
                $reference->person_email = $request->person_mail;
                $reference->user_id = \Auth::user()->id;
                $reference->save();

                return response()->json(["success" => true, "msg" => "Referencia agregada exitosamente"]);
            }

        }catch(\Exception $e){

            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);

        }

    }

    function update(JobReferenceStoreRequest $request){

        try{

            $reference = JobReference::where("id", $request->id)->first();
            $reference->business_name = $request->business_name;
            $reference->person_name = $request->person_name;
            $reference->person_job_position = $request->person_job_position;
            $reference->person_telephone = $request->person_telephone;
            $reference->person_email = $request->person_mail;
            $reference->update();

            return response()->json(["success" => true, "msg" => "Referencia actualizada exitosamente"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);

        }

    }

    function fetch(){

        try{

            $references = JobReference::where("user_id", \Auth::user()->id)->get();

            return response()->json(["success" => true, "references" => $references]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);

        }

    }

    function fetchById($id){
        try{

            $references = JobReference::where("user_id", $id)->get();

            return response()->json(["success" => true, "references" => $references]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);

        }
    }

    function delete(Request $request){
        try{

            $reference = JobReference::where("id", $request->id)->where("user_id", \Auth::user()->id)->first();
            if($reference){
                $reference->delete();

                return response()->json(["success" => true, "msg" => "Referencia eliminada exitosamente"]);
            }else{
                return response()->json(["success" => false, "msg" => "Referencia no encontrada"]);
            }
            

        }catch(\Exception $e){

            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);

        }
    }

}
