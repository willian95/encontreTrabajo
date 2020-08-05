<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\JobResumeStoreRequest;
use App\Http\Requests\StoreAcademicBackgroundRequest;
use App\Http\Requests\StoreJobBackgroundRequest;
use App\Http\Requests\OthersStoreRequest;
use App\Http\Requests\BusinessUserUpdateRequest;
use App\Http\Requests\businessBusinessUpdateRequest;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\AcademicBackground;
use App\JobBackground;
use App\User;
use App\Profile;

class ProfileController extends Controller
{
    function index(){

        try{

            $user = User::where("id", \Auth::user()->id)->with("profile")->firstOrFail();
            return view("users.userProfile", ["user" => $user]);

        }catch(\Exception $e){
            abort(403);
        }

    }

    function businessIndex(){
        try{

            $user = User::where("id", \Auth::user()->id)->with("profile")->firstOrFail();
            return view("users.businessProfile", ["user" => $user]);

        }catch(\Exception $e){
            abort(403);
        }
    }

    function businessUserBusinessUpdate(BusinessUserUpdateRequest $request){

        try{

            $user = User::where("id", \Auth::user()->id)->first();
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->update();

            return response()->json(["success" => true, "msg" => "Información del usuario actualizada"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function businessBusinessUpdate(businessBusinessUpdateRequest $request){

        try{

            $user = User::where("id", \Auth::user()->id)->first();
            $user->business_rut = $request->businessRut;
            $user->business_name = $request->businessName;
            $user->business_phone = $request->businessPhone;
            $user->update();

            $profile = Profile::where("user_id", \Auth::user()->id)->first();
            $profile->iva_condition = $request->ivaCondition;
            $profile->industry = $request->industry;
            $profile->amount_employees = $request->amountEmployees;
            $profile->update();

            return response()->json(["success" => true, "msg" => "Información de empresa actualizada"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function update(ProfileUpdateRequest $request){

        try{

            if($request->get('image') != null){
            
                try{
    
                    $imageData = $request->get('image');
    
                    if(strpos($imageData, "svg+xml") > 0){
    
                        $data = explode( ',', $imageData);
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                        $ifp = fopen($fileName, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileName, 'images/users/'.$fileName);
        
                    }else{
    
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                        Image::make($request->get('image'))->save(public_path('images/users/').$fileName);
                    }
        
                }catch(\Exception $e){
        
                    return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        
                }
            }

            try{

                if($request->get("video") != null){
                    
                    $videoData = $request->get('video');
                   
                    if(explode('/', explode(':', substr($videoData, 0, strpos($videoData, ';')))[1])[0] == "video"){
                        
                        $data = explode( ',', $videoData);
                        $fileVideo = Carbon::now()->timestamp . '_' . uniqid() . '.'.explode('/', explode(':', substr($videoData, 0, strpos($videoData, ';')))[1])[1];
                        $ifp = fopen($fileVideo, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileVideo, 'videos/users/'.$fileVideo);
                    }
    
                }
                
            }catch(\Exception $e){
                
                return response()->json(["success" => false, "msg" => "Hubo un problema con el video", "err" => $e->getMessage(), "ln" => $e->getLine()]);
    
            }

            try{

                if($request->get("curriculum") != null){
                    
                    $curriculumData = $request->get('curriculum');
                    if(explode('/', explode(':', substr($curriculumData, 0, strpos($curriculumData, ';')))[1])[1] == "pdf"){
                        
                        $data = explode( ',', $curriculumData);
                        $fileCurriculum = Carbon::now()->timestamp . '_' . uniqid() . '.'.explode('/', explode(':', substr($curriculumData, 0, strpos($curriculumData, ';')))[1])[1];
                        $ifp = fopen($fileCurriculum, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileCurriculum, 'curriculums/users/'.$fileCurriculum);
                    }
    
                }
                
            }catch(\Exception $e){
                
                return response()->json(["success" => false, "msg" => "Hubo un problema con el video", "err" => $e->getMessage(), "ln" => $e->getLine()]);
    
            }

            $user = User::where("id", \Auth::user()->id)->first();
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            if($request->get('image') != null){
                $user->image = url('/').'/images/users/'.$fileName;
            }
            $user->region_id = $request->region;
            $user->commune_id = $request->commune;
            $user->update();

            $profile = Profile::where("user_id", \Auth::user()->id)->first();
            if($request->get("video") != null){
                $profile->video = url('/').'/videos/users/'.$fileVideo;
            }
            if($request->get("curriculum") != null){
                $profile->curriculum = url('/').'/curriculums/users/'.$fileCurriculum;
            }
            $profile->rut = $request->rut;
            $profile->birth_date = $request->birthDate;
            $profile->gender = $request->gender;
            $profile->civil_state = $request->civilState;
            $profile->address = $request->address;
            $profile->city = $request->city;
            $profile->handicap = $request->handicap;
            $profile->phone = $request->phone;
            $profile->home_phone = $request->homePhone;
            $profile->update();
            
            return response()->json(["success" => true, "msg" => "Antecedentes básicos actualizados"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function fetchAcademicBackground(){
        
        try{

            $academicBgs = AcademicBackground::where("user_id", \Auth::user()->id)->get();

            return response()->json(["success" => true, "academicBgs" => $academicBgs]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function storeAcademicBackground(StoreAcademicBackgroundRequest $request){

        try{

            $academicBg = new AcademicBackground;
            $academicBg->user_id = \Auth::user()->id;
            $academicBg->college = $request->college;
            $academicBg->educational_level = $request->educationalLevel;
            $academicBg->start_date = $request->startDate;
            $academicBg->end_date = $request->endDate;
            $academicBg->state = $request->state;
            $academicBg->save();

            return response()->json(["success" => true, "msg" => "Antecedente Académico agregado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function deleteAcademicBackground(Request $request){

        try{

            $academicBg = AcademicBackground::where("id", $request->id)->where("user_id", \Auth::user()->id)->first();
            $academicBg->delete();

            return response()->json(["success" => true, "msg" => "Antecedente Académico eliminado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function storeJobResume(JobResumeStoreRequest $request){

        try{

            $profile = Profile::where("user_id", \Auth::user()->id)->first();
            $profile->job_description = $request->jobDescription;
            $profile->experience_year = $request->expYears;
            $profile->availability = $request->availability;
            $profile->salary = $request->salary;
            $profile->desired_area = $request->desiredArea;
            $profile->update();

            return response()->json(["success" => true, "msg" => "Resumen laboral actualizado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function fetchJobBackground(){

        try{

            $jobBgs = JobBackground::where("user_id", \Auth::user()->id)->get();

            return response()->json(["success" => true, "jobBgs" => $jobBgs]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function storeJobBackground(StoreJobBackgroundRequest $request){

        try{

            $jobBackground = new JobBackground;
            $jobBackground->job = $request->jobBg;
            $jobBackground->company = $request->company;
            $jobBackground->user_id = \Auth::user()->id;
            $jobBackground->start_date = $request->startDateBg;
            $jobBackground->end_date = $request->endDateBg;
            $jobBackground->save();

            return response()->json(["success" => true, "msg" => "Antecendente laboral agregado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function storeOthers(Request $request){

        try{

            $profile = Profile::where("user_id", \Auth::user()->id)->first();
            $profile->informatic_knowledge = $request->informaticKnowledge;
            $profile->knowledge_habilities = $request->knowledgeHabilities;
            $profile->driver_license = $request->driverLicense;
            $profile->handicap_description = $request->handicapDescription;
            $profile->update();

            return response()->json(["success" => true, "msg" => "Otros antecendentes actualizados"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }



}
