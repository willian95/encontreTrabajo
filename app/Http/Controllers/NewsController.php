<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Notice;

class NewsController extends Controller
{
    
    function index(){

        return view("admin.news.index");

    }

    function create(){
        return view("admin.news.create");
    }

    function fetch($page = 1){
        try{
            $dataAmount = 10;
            $skip = ($page - 1) * $dataAmount;

            $notices = Notice::skip($skip)->take($dataAmount)->orderBy("id", "desc")->get();
            $noticesCount = Notice::count();

            return response()->json(["success" => true, "notices" => $notices, "noticesCount" => $noticesCount, "dataAmount" => $dataAmount]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }
    }

    function edit($id){

        $notice = Notice::find($id);
        return view("admin.news.edit", ["image" => $notice->image, "text" => $notice->text, "title" => $notice->title, "id" => $notice->id, "video" => $notice->video]);

    }

    function store(NewsStoreRequest $request){

        try{

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

            if($request->get('video') != null){
                try{
    
                    $videoData = $request->get('video');
               
                    if(explode('/', explode(':', substr($videoData, 0, strpos($videoData, ';')))[1])[0] == "video"){
                        
                        $data = explode( ',', $videoData);
                        $fileVideo = Carbon::now()->timestamp . '_' . uniqid() . '.'.explode('/', explode(':', substr($videoData, 0, strpos($videoData, ';')))[1])[1];
                        $ifp = fopen($fileVideo, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileVideo, 'images/news/'.$fileVideo);
                    }
                    
        
                }catch(\Exception $e){
        
                    return response()->json(["success" => false, "msg" => "Hubo un problema con el video", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        
                }
            }

            $slug = str_replace(" ", "-", $request->title);
            $slug = str_replace("/", "-", $slug);

            if(Notice::where("slug", $slug)->count() > 0){
                $slug = $slug."-".uniqid();
            }

            $news = new Notice;
            $news->image = url('/').'/images/news/'.$fileName;
            if($request->get('video') != null){
                $news->video = url('/').'/images/news/'.$fileVideo;
            }
            $news->title = $request->title;
            $news->text = $request->text;
            $news->slug = $slug;
            $news->save();

            return response()->json(["success" => true, "msg" => "Noticia creada"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function update(NewsUpdateRequest $request){

        try{

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

            if($request->get('video') != null){
                try{
    
                    $videoData = $request->get('video');
               
                    if(explode('/', explode(':', substr($videoData, 0, strpos($videoData, ';')))[1])[0] == "video"){
                        
                        $data = explode( ',', $videoData);
                        $fileVideo = Carbon::now()->timestamp . '_' . uniqid() . '.'.explode('/', explode(':', substr($videoData, 0, strpos($videoData, ';')))[1])[1];
                        $ifp = fopen($fileVideo, 'wb' );
                        fwrite($ifp, base64_decode( $data[1] ) );
                        rename($fileVideo, 'images/news/'.$fileVideo);
                    }
                    
        
                }catch(\Exception $e){
        
                    return response()->json(["success" => false, "msg" => "Hubo un problema con el video", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        
                }
            }

            $news = Notice::find($request->id);
            if($request->get("image") != null){
                $news->image = url('/').'/images/news/'.$fileName;
            }

            if($request->get('video') != null){
                $news->video = url('/').'/images/news/'.$fileVideo;
            }
            
            $news->title = $request->title;
            $news->text = $request->text;
            $news->update();

            return response()->json(["success" => true, "msg" => "Noticia actualizada"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

    function delete(Request $request){

        try{
            
            $notice = Notice::find($request->id);
            $notice->delete();

            return response()->json(["success" => true, "msg" => "Noticia eliminada"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Error en el servidor"]);
        }

    }

}
