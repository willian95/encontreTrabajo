<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PlanStoreRequest;
use App\Plan;

class PlanController extends Controller
{

    function index(){
        return view('users.plan');
    }

    function adminIndex(){
        return view('admin.plans.index');
    }

    function fetch(){

        try{

            $plans = Plan::all();
            return response()->json(["success" => true, "plans" => $plans]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function store(PlanStoreRequest $request){

        try{

            $plan = new Plan;
            $plan->title = $request->title;
            $plan->simple_posts = $request->simplePostAmounts;
            $plan->hightlight_posts = $request->hightlightPostAmount;
            $plan->offer_posting = $request->offerPosting;
            $plan->post_days = $request->postDays;
            $plan->plan_time = $request->planLength;
            $plan->download_curriculum = $request->downloadCurriculum;
            $plan->show_video = $request->showVideo;
            $plan->download_profiles = $request->downloadProfile;
            $plan->position = $request->position;
            $plan->price = $request->price;
            $plan->conference_infinity = $request->conferenceInfinity;
            $plan->conference_amount = $request->conferenceAmounts;
            $plan->simple_post_infinity = $request->simplePostInfinity;
            $plan->save();

            return response()->json(["success" => true, "msg" => "Plan registrado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function update(PlanStoreRequest $request){

        try{

            $plan = Plan::where("id", $request->id)->first();
            $plan->title = $request->title;
            $plan->simple_posts = $request->simplePostAmounts;
            $plan->hightlight_posts = $request->hightlightPostAmount;
            $plan->offer_posting = $request->offerPosting;
            $plan->post_days = $request->postDays;
            $plan->plan_time = $request->planLength;
            $plan->download_curriculum = $request->downloadCurriculum;
            $plan->show_video = $request->showVideo;
            $plan->download_profiles = $request->downloadProfile;
            $plan->position = $request->position;
            $plan->conference_infinity = $request->conferenceInfinity;
            $plan->price = $request->price;
            $plan->conference_amount = $request->conferenceAmounts;
            $plan->simple_post_infinity = $request->simplePostInfinity;
            $plan->update();

            return response()->json(["success" => true, "msg" => "Plan actualizado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function delete(Request $request){

        try{

            $plan = Plan::where("id", $request->id)->first();
            $plan->delete();

            return response()->json(["success" => true, "msg" => "Plan eliminado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

}
