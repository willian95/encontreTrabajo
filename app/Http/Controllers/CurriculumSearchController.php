<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceAmount;
use App\BusinessCurriculumView;
use App\User;
use App\Profile;
use App\Region;
use App\JobCategory;
use App\JobReference;
use App\AcademicBackground;
use App\JobBackground;
use Carbon\Carbon;
use PDF;


class CurriculumSearchController extends Controller
{
    
    function index(){

        return view("users.businessSearch");

    }

    function download($id){

        if(\Auth::user()->role_id == 3){
            $businessCurriculum = BusinessCurriculumView::where("business_id", \Auth::user()->id)->where("user_curriculum_id", $id)->count();
            if($businessCurriculum == 0){
                $businessCurriculum = new BusinessCurriculumView;
                $businessCurriculum->business_id = \Auth::user()->id;
                $businessCurriculum->user_curriculum_id = $id;
                $businessCurriculum->save();
            }
        }

        $user = User::where("id", $id)->with("region", "commune")->has("region")->has("commune")->first();
        $profile = Profile::where("user_id", $user->id)->first();
        $academicBackground = AcademicBackground::where("user_id", $user->id)->get();
        $jobBackground = JobBackground::where("user_id", $user->id)->get();
        $jobReferences = JobReference::where("user_id", $user->id)->get();
        $age = Carbon::parse($profile->birth_date)->age;
        $informaticKnowledgeList = [
            ["id" => 1, "name"=> "Hojas de cálculo"],
            ["id"=> 2, "name" => "Intranet"],
            ["id"=> 3, "name" => "Gmail"],
            ["id"=> 4, "name" => "Procesadores de texto"],
            ["id"=> 5, "name" => "Bases de datos Oracle"],
            ["id"=> 6, "name" => "MySQL"],
            ["id"=> 7, "name" => "PostgreSQL"],
            ["id"=> 8, "name" => "Internet"],
            ["id"=> 9, "name" => "Redes Internas"],
            ["id"=> 10, "name" => "TCP/IP"],
            ["id"=> 11, "name" => "Routers"],
            ["id"=> 12, "name" => "WAP"],
            ["id"=> 13, "name" => "Wireless"],
            ["id"=> 14, "name" => "Google Analytics"],
            ["id"=> 15, "name" => "Google Adwords"],
            ["id"=> 16, "name" => "SEO"],
            ["id"=> 17, "name" => "SEM"],
            ["id"=> 18, "name" => "Wordpress"],
            ["id"=> 19, "name" => "Blogger"],
            ["id"=> 20, "name" => "Redes Sociales"],
            ["id"=> 21, "name" => "Adobe Dreamweaver"],
            ["id"=> 22, "name" => "Adobe Flash"],
            ["id"=> 23, "name" => "Photoshop"],
            ["id"=> 24, "name" => "Adobe InDesign"],
            ["id"=> 25, "name" => "Adobe Illustrator"],
            ["id"=> 26, "name" => "Premiere Pro"],
            ["id"=> 27, "name" => "Microsoft Office"],
            ["id"=> 28, "name" => "Mac"],
            ["id"=> 29, "name" => "Windows"],
            ["id"=> 30, "name" => "Linux"],
            ["id"=> 31, "name" => "CRM"],
            ["id"=> 32, "name" => "SAP"],
            ["id"=> 33, "name" => "Peoplesoft"],
            ["id"=> 34, "name" => "Jira"],
            ["id"=> 35, "name" => "Trello"],
            ["id"=> 36, "name" => "Java"],
            ["id"=> 37, "name" => "Javascript"],
            ["id"=> 38, "name" => "XML"],
            ["id"=> 39, "name" => "ASP/.NET"],
            ["id"=> 40, "name" => "PHP"],
            ["id"=> 41, "name" => "HTML"]
        ];

        $desireAreaExplode = explode(",", $profile->desired_areas);
        $desiredAreasArray = JobCategory::whereIn("id", $desireAreaExplode)->get();
        $desiredAreaString = "";

        $i = 0;
        foreach($desiredAreasArray as $desiredArea){

            $desiredAreaString .= $desiredArea->name;   
            if($i < count($desiredAreasArray) - 1){
                $desiredAreaString .= ", ";
            }


            $i++;
        }

        $informaticKnowledgeArray = explode(",", $profile->informatic_knowledge);
        $informaticKnowledgeString = "";
        $i = 0;

        foreach($informaticKnowledgeArray as $informaticKnowledge){

            foreach($informaticKnowledgeList as $list){
                if($list['id'] == $informaticKnowledge){
                    $informaticKnowledgeString .= $list['name'];
                    if($i < count($informaticKnowledgeArray) - 1){
                        $informaticKnowledgeString .= ", ";
                    }
                }
            }
            
            $i++;
        }
        $licenseString = str_replace("license", "", $profile->driver_license);
        $licenseString = str_replace(":true", "", $licenseString);

        $serviceAmount = ServiceAmount::where("user_id", \Auth::user()->id)->first();
        $serviceAmount->download_profiles_amount = $serviceAmount->download_profiles_amount - 1;
        $serviceAmount->update();

        $pdf = PDF::loadView('pdf.profile', ["user" => $user, "profile" => $profile, "age" => $age, "academicBackground" => $academicBackground, "desiredAreaString" => $desiredAreaString, "jobBackground" => $jobBackground, "informaticKnowledgeString" => $informaticKnowledgeString, "licenseString" => $licenseString, "jobReferences" => $jobReferences]);
        return $pdf->download('profile.pdf');

    }

}
