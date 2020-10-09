<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\JobResumeStoreRequest;
use App\Http\Requests\StoreAcademicBackgroundRequest;
use App\Http\Requests\UpdateAcademicBackgroundRequest;
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
use App\Region;
use App\JobCategory;
use PDF;

class ProfileController extends Controller
{
    function index(){

        try{

            $user = User::where("id", \Auth::user()->id)->with("profile")->has("profile")->firstOrFail();
            $moveRegionArray = explode(",", $user->profile->move_regions);
            $moveRegions = Region::whereIn("id", $moveRegionArray)->get();

            $desiredAreasArray = explode(",", $user->profile->desired_areas);
            $desiredAreas = JobCategory::whereIn("id", $desiredAreasArray)->get();

            return view("users.userProfile", ["user" => $user,"moveRegions" => json_encode($moveRegions), "desiredAreas" => json_encode($desiredAreas)]);

        }catch(\Exception $e){
            abort(403);
        }

    }

    function businessIndex(){
        try{

            $user = User::where("id", \Auth::user()->id)->with("profile")->has("profile")->firstOrFail();
            return view("users.businessProfile", ["user" => $user]);

        }catch(\Exception $e){
            abort(403);
        }
    }

    function businessUserBusinessUpdate(BusinessUserUpdateRequest $request){

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

            $user = User::where("id", \Auth::user()->id)->first();
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            if($request->get('image') != null){
                $user->image = url('/').'/images/users/'.$fileName;
            }
            $user->update();

            $this->isProfileComplete();

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
            $user->region_id = $request->region;
            $user->commune_id = $request->commune;
            $user->update();

            $profile = Profile::where("user_id", \Auth::user()->id)->first();
            $profile->iva_condition = $request->ivaCondition;
            $profile->industry = $request->industry;
            $profile->amount_employees = $request->amountEmployees;
            $profile->country_id = $request->countryId;
            $profile->address = str_replace("\n", ". ", $request->address);
            $profile->update();

            //$this->isProfileComplete();

            if(\Auth::user()->role_id == 3){
                if(\Auth::user()->commune_id != null && \Auth::user()->image != url('/')."images/users/default.jpg" && \Auth::user()->region_id != null && $profile->address != null){

                    $user = User::where("id", \Auth::user()->id)->first();
                    $user->is_profile_complete = 1;
                    $user->update();
    
                }
            }

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

                    if(explode('/', explode(':', substr($curriculumData, 0, strpos($curriculumData, ';')))[1])[1] == "pdf" || explode('/', explode(':', substr($curriculumData, 0, strpos($curriculumData, ';')))[1])[1] == "vnd.openxmlformats-officedocument.wordprocessingml.document" || explode('/', explode(':', substr($curriculumData, 0, strpos($curriculumData, ';')))[1])[1] == "vnd.oasis.opendocument.text"){
                        
                        $data = explode( ',', $curriculumData);
                        $fileCurriculum = Carbon::now()->timestamp . '_' . uniqid() . '.'.explode('/', explode(':', substr($curriculumData, 0, strpos($curriculumData, ';')))[1])[1];

                        $fileCurriculum = str_replace("vnd.openxmlformats-officedocument.wordprocessingml.document", "docx", $fileCurriculum);
                        $fileCurriculum = str_replace("vnd.oasis.opendocument.text", "odt", $fileCurriculum);

                        $ifp = fopen($fileCurriculum, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileCurriculum, 'curriculums/users/'.$fileCurriculum);
                    }
    
                }
                
                
            }catch(\Exception $e){
                
                return response()->json(["success" => false, "msg" => "Hubo un problema con el video", "err" => $e->getMessage(), "ln" => $e->getLine()]);
    
            }

            //dd($request->all());

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
            $profile->address = str_replace("\n", ". ", $request->address);
            $profile->country_id = $request->country;
            $profile->handicap = $request->handicap;
            $profile->phone = $request->phone;
            $profile->nationality = $request->nationality;
            $profile->home_phone = $request->homePhone;
            $profile->update();

            $this->isProfileComplete();
            
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

    function fetchShowAcademicBackground(Request $request){
        
        try{

            $academicBgs = AcademicBackground::where("user_id", $request->user_id)->get();

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
            $academicBg->study_field = $request->studyField;
            $academicBg->save();

            //$this->isProfileComplete();

            return response()->json(["success" => true, "msg" => "Antecedente Académico agregado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function updateAcademicBackground(UpdateAcademicBackgroundRequest $request){

        try{

            $academicBg = AcademicBackground::where("id", $request->id)->first();
            $academicBg->college = $request->college;
            $academicBg->educational_level = $request->educationalLevel;
            $academicBg->start_date = $request->startDate;
            $academicBg->end_date = $request->endDate;
            $academicBg->state = $request->state;
            $academicBg->study_field = $request->studyField;
            $academicBg->update();

            //$this->isProfileComplete();

            return response()->json(["success" => true, "msg" => "Antecedente Académico Actualizado"]);

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

            $regionString= "";
            $desiredString="";

            $profile = Profile::where("user_id", \Auth::user()->id)->first();
            $profile->job_description = str_replace("\n", ". ", $request->jobDescription);
            $profile->experience_year = $request->expYears;
            $profile->availability = $request->availability;
            $profile->salary = $request->salary;
            $profile->desired_areas = $request->desiredArea;
            $profile->functions = str_replace("\n", ".", $request->functions);
            $profile->awards = str_replace("\n", ". ", $request->awards);
            $profile->move_regions = $request->moveRegions;
            $profile->update();

            $this->isProfileComplete();

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

    function fetchShowJobBackground(Request $request){
        
        try{

            $jobBgs = JobBackground::where("user_id", $request->user_id)->get();

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

            //$this->isProfileComplete();

            return response()->json(["success" => true, "msg" => "Antecendente laboral agregado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function updateJobBackground(StoreJobBackgroundRequest $request){

        try{

            //$academicBg = JobBackground::where("id", $request->id)->first();
            
            $jobBackground = JobBackground::where("id", $request->id)->first();
            $jobBackground->job = $request->jobBg;
            $jobBackground->company = $request->company;
            $jobBackground->start_date = $request->startDateBg;
            $jobBackground->end_date = $request->endDateBg;
            $jobBackground->update();

            //$this->isProfileComplete();

            return response()->json(["success" => true, "msg" => "Antecedente laboral Actualizado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function deleteJobBackground(Request $request){

        try{

            $jobBg = JobBackground::where("id", $request->id)->where("user_id", \Auth::user()->id)->first();
            $jobBg->delete();

            return response()->json(["success" => true, "msg" => "Antecedente laboral eliminado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function storeOthers(Request $request){

        try{

            $driverString = "";

            if($request->licenseA1 == true){
                $driverString .= "licenseA1:true, ";
            }
            if($request->licenseA2 == true){
                $driverString .= "licenseA2:true, ";
            }
            if($request->licenseA3 == true){
                $driverString .= "licenseA3:true, ";
            }
            if($request->licenseA4 == true){
                $driverString .= "licenseA4:true, ";
            }
            if($request->licenseA5 == true){
                $driverString .= "licenseA5:true, ";
            }
            if($request->licenseB == true){
                $driverString .= "licenseB:true, ";
            }
            if($request->licenseC == true){
                $driverString .= "licenseC:true, ";
            }
            if($request->licenseD == true){
                $driverString .= "licenseD:true, ";
            }
            if($request->licenseE == true){
                $driverString .= "licenseE:true, ";
            }
            if($request->licenseF == true){
                $driverString .= "licenseF:true, ";
            }

            $profile = Profile::where("user_id", \Auth::user()->id)->first();
            $profile->informatic_knowledge = str_replace("\n", ". ", $request->informaticKnowledge);
            $profile->knowledge_habilities = str_replace("\n", ". ", $request->knowledgeHabilities);
            $profile->driver_license = $driverString;
            $profile->handicap_description = str_replace("\n", ". ", $request->handicapDescription);
            $profile->handicap_percentage = $request->handicapPercentage;
            $profile->necesary_condition = str_replace("\n", ". ", $request->necesaryCondition);
            $profile->update();

            $this->isProfileComplete();

            return response()->json(["success" => true, "msg" => "Otros antecendentes actualizados"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function isProfileComplete(){

        if(\Auth::user()->role_id == 2){

           

            $profile = Profile::where("user_id", \Auth::user()->id)->first();
            $profile->is_curriculum_validated = 0;
            $profile->update();


            if(\Auth::user()->image != url('/')."/images/users/default.jpg" && $profile->video != null && $profile->curriculum != null && $profile->address != null && AcademicBackground::where("user_id", \Auth::user()->id)->count() > 0){

                $user = User::where("id", \Auth::user()->id)->first();
                $user->is_profile_complete = 1;
                
                $user->update();

            }

        }else if(\Auth::user()->role_id == 3){

            $profile = Profile::where("user_id", \Auth::user()->id)->first();

            if(\Auth::user()->commune_id != null && \Auth::user()->image != url('/')."images/users/default.jpg" && \Auth::user()->region_id != null && $profile->address != null){

                $user = User::where("id", \Auth::user()->id)->first();
                
                $user->update();

            }

        }

    }

    function showProfile($email){

        try{

            $user = User::where("email", $email)->first();
            $profile = Profile::where("user_id", $user->id)->first();

            if(\Auth::user()->role_id == 1){

                $age = Carbon::parse($profile->birth_date)->age;
                $moveRegionArray = explode(",", $profile->move_regions);
                $moveRegions = Region::whereIn("id", $moveRegionArray)->get();

                return view("users.showAdminUserProfile", ["user" => $user, "profile" => $profile,"age" =>$age, "moveRegions" => json_encode($moveRegions)]);
            }

            else{

                if($user->role_id == 2){

                    $age = Carbon::parse($profile->birth_date)->age;
                    $moveRegionArray = explode(",", $profile->move_regions);
                    $moveRegions = Region::whereIn("id", $moveRegionArray)->get();
               
                    return view("users.showUserProfile", ["user" => $user, "profile" => $profile,"age" =>$age, "moveRegions" => json_encode($moveRegions)]);
    
                }else if($user->role_id == 3){
                    return view("users.showBusinessProfile", ["user" => $user, "profile" => $profile]);
                }

            }


        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }


    function validateUser(){

        try{

            $user = Profile::where("user_id", \Auth::user()->id)->first();
            $user->is_curriculum_validated = 0;
            $user->request_for_curriculum_validation = 1;
            $user->update();

            $data = ["messageMail" => "Hola Admin, el usuario ".$user->name.", quiere validar su correo", "link" => url('/').'/profile/show/'.$user->email];
            $to_name = "admin";
            $to_email = env('ADMIN_EMAIL');

            \Mail::send("emails.adminCurriculumValidation", $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject("¡Un usuario quiere validar su curriculum!");
                $message->from( env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            return response()->json(["success" => true, "msg" => "Se ha enviado una solicitud al administrador"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function download($email){

        try{

            $user = User::where("email", $email)->with("region", "commune")->first();
            $profile = Profile::where("user_id", $user->id)->first();
            $academicBackground = AcademicBackground::where("user_id", $user->id)->get();
            $age = Carbon::parse($profile->birth_date)->age;
           
            $pdf = PDF::loadView('pdf.profile', ["user" => $user, "profile" => $profile, "age" => $age, "academicBackground" => $academicBackground]);
            return $pdf->stream('profile.pdf');

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }


}
