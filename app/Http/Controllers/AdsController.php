<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class AdsController extends Controller
{
    
    function index(){

        return view("admin.ads.index");

    }

    function update(Request $request){
        $type = "";
        if($request->get('image') != null){
            try{

                $imageData = $request->get('image');

                if(explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[0] == "video"){
                    
                    $data = explode( ',', $imageData);
                    $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'.explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                    $ifp = fopen($fileName, 'wb' );
                    fwrite($ifp, base64_decode( $data[1] ) );
                    rename($fileName, 'images/news/'.$fileName);
                    $type = "video";
                }
    
                else if(strpos($imageData, "svg+xml") > 0){
    
                    $data = explode( ',', $imageData);
                    $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                    $ifp = fopen($fileName, 'wb' );
                    fwrite($ifp, base64_decode( $data[1] ) );
                    rename($fileName, 'images/news/'.$fileName);

                    $type = "image";
    
                }else{
    
                    $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                    Image::make($request->get('image'))->save(public_path('images/news/').$fileName);

                    $type = "image";
    
                }
    
                
            }catch(\Exception $e){
    
                return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
    
            }
        }

        $ad = Ad::where("id", $request->id)->first();
        if($request->get("image") !=null){
            $ad->image = url('/').'/images/news/'.$fileName;
        }
        $ad->type = $type;
        $ad->link  = $request->link;
        $ad->update();
        
        return response()->json(["success" => true, "msg" => "Publicidad actualizada"]);


    }

    function delete(Request $request){

        $ad = Ad::where("id", $request->id)->first();
        $ad->image = null;
        $ad->link = null;
        $ad->type = null;
        $ad->update();

        return response()->json(["success" => true, "msg" => "Publicidad eliminada"]);

    }

}
