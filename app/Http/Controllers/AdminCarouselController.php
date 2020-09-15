<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CarouselAdminStoreRequest;
use App\Http\Requests\CarouselAdminUpdateRequest;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Carousel;

class AdminCarouselController extends Controller
{

    function index(){
        return view('admin.carousels.index');
    }
    
    function store(CarouselAdminStoreRequest $request){

        try{

            if($request->get('image') != null){
            
                try{
    
                    $imageData = $request->get('image');
    
                    if(strpos($imageData, "svg+xml") > 0){
    
                        $data = explode( ',', $imageData);
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                        $ifp = fopen($fileName, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileName, 'images/carousels/'.$fileName);
        
                    }else{
    
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                        Image::make($request->get('image'))->save(public_path('images/carousels/').$fileName);
                    }
        
                }catch(\Exception $e){
        
                    return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        
                }
            }

            $carousel = new Carousel;
            $carousel->image = url('/').'/images/carousels/'.$fileName;
            $carousel->status = $request->status;
            $carousel->save();

            return response()->json(["success" => true, "msg" => "Carrusel añadido exitosamente"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);
        }

    }

    function update(CarouselAdminUpdateRequest $request){

        try{

            if($request->get('image') != null){
            
                try{
    
                    $imageData = $request->get('image');
    
                    if(strpos($imageData, "svg+xml") > 0){
    
                        $data = explode( ',', $imageData);
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.'."svg";
                        $ifp = fopen($fileName, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileName, 'images/carousels/'.$fileName);
        
                    }else{
    
                        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                        Image::make($request->get('image'))->save(public_path('images/carousels/').$fileName);
                    }
        
                }catch(\Exception $e){
        
                    return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        
                }
            }

            $carousel = Carousel::where("id", $request->id)->first();
            if($request->get('image') != null){
                $carousel->image = url('/').'/images/carousels/'.$fileName;
            }
            $carousel->status = $request->status;
            $carousel->update();

            return response()->json(["success" => true, "msg" => "Carrusel actualizado exitosamente"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);
        }

    }

    function fetch(){

        try{

            $carousels = Carousel::all();
            return response()->json(["success" => true, "carousels" => $carousels]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);
        }

    }

    function delete(Request $request){

        try{

            $carousel = Carousel::where("id", $request->id)->first();
            $carousel->delete();

            return response()->json(["success" => true, "msg" => "Carrusel eliminado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);
        }

    }

}
