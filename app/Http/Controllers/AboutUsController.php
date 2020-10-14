<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutUs;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class AboutUsController extends Controller
{
    
    function index(){

        $aboutUs = AboutUs::first();
        return view("admin.aboutUs.index", ["image" => $aboutUs->image, "text" => $aboutUs->text]);

    }

    function update(Request $request){

        try{

            if($request->get('image') != null){
            
                try{
    
                    $imageData = $request->get('image');
    
                    if(strpos($imageData, "svg+xml") > 0){
    
                        $data = explode( ',', $imageData);
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                        $ifp = fopen($fileName, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileName, 'images/about-us/'.$fileName);
        
                    }else{
    
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                        Image::make($request->get('image'))->save(public_path('images/about-us/').$fileName);
                    }
        
                }catch(\Exception $e){
        
                    return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        
                }
            }

            $aboutUs = AboutUs::where("id", 1)->first();
            $aboutUs->image = url('/').'/images/about-us/'.$fileName;
            $aboutUs->text = $request->text;
            $aboutUs->update();

            return response()->json(["success" => true, "msg" => "Textos de Quienes Somos han sido actualizados exitosamente"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);
        }

    }

}
