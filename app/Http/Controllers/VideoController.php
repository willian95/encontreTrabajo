<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Video;

class VideoController extends Controller
{
    
    function index(){

        $video = Video::first();
        return view("admin.video.index", ["image" => $video->video]);
    }

    function updateVideo(Request $request){

        //ini_set('max_execution_time', 0);
       
        

                /*if($request->get("video") != null){
                    
                    $videoData = $request->get('video');
                   
                    if(explode('/', explode(':', substr($videoData, 0, strpos($videoData, ';')))[1])[0] == "video"){
                        
                        $data = explode( ',', $videoData);
                        $fileVideo = Carbon::now()->timestamp . '_' . uniqid() . '.'.explode('/', explode(':', substr($videoData, 0, strpos($videoData, ';')))[1])[1];
                        $ifp = fopen($fileVideo, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileVideo, 'videos/'.$fileVideo);
                    }
    
                }*/
                
            
            return response()->json($request);
            $video = Video::first();
            //$video->video = url('/').'/videos/'.$fileName;
            $video->update();

            //return response()->json(["success" => true, "msg" => "Video actualizado"]);

        

    }

}
