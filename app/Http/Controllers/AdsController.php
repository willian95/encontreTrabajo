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

        if($request->get("image") !=null){
            try{

                $imageData = $request->get('image');

                if(strpos($imageData, "svg+xml") > 0){

                    $data = explode( ',', $imageData);
                    $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                    $ifp = fopen($fileName, 'wb' );
                    fwrite($ifp, base64_decode( $data[1] ) );
                    rename($fileName, 'images/news/'.$fileName);
    
                }else{

                    $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                    Image::make($request->get('image'))->save(public_path('images/news/').$fileName);
                }
    
            }catch(\Exception $e){
    
                return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
    
            }
        }

        
            $ad = Ad::where("id", $request->id)->first();
            if($request->get("image") !=null){
                $ad->image = $filename;
            }
            $ad->link  = $request->link;
            $ad->update();
            
            return response()->json(["success" => true, "msg" => "Publicidad actualizada"]);


    }

}
