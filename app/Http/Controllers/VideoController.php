<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Video;
use App\Comentario;

class VideoController extends Controller
{
    public function crearVideo(){
        return view('video.crearVideo');
    }
    
    public function guardarVideo(Request $request){
        $validatedData = $request->validate([
            'titulo' => 'required|unique:video|min:5|max:255',
            'descripcion' => 'required',
            'imagen' => 'required|mimes:jpeg,png,jpg',
            'video' => 'required|mimes:mp4',
        ]);
        
        $video = new Video();
        $user = \Auth::user();//obtenemos el usuario logeado
        $video->usuario_id = $user->id;
        $video->titulo = $request->input('titulo');
        $video->descripcion = $request->input('descripcion');
        //subimos archivos
        $image_file = $request->file('imagen');
        if($image_file){
            $image_path = time().$image_file->getClientOriginalName();
            //para usar el disco imagenes hay que configurar filesystems en la carpeta de configuracion
            \Storage::disk('imagenes')->put($image_path, \File::get($image_file));
            
            $video->imagen = $image_path;
        }
        
        $video_file = $request->file('video');
        if($video_file){
            $video_path = time().$video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path, \File::get($video_file));
            
            $video->video_path = $video_path;
        }
        //guardamos
        $video->save();
        //redireccionamos
        return redirect()->route('home')->with('mensaje','El video se ha subido correctamente!!!');
    }
    
    public function getImagen($filename){
        //traemos la imagen del disco
        $file = Storage::disk('imagenes')->get($filename);
        return new Response($file, 200);
    }
    
    public function getVideoDetalle($video_id){
        $video = Video::find($video_id);
        return view('video.detalle', array('video' => $video));
    }
    
    public function getVideo($filename){
        $file = Storage::disk('videos')->get($filename);
        return new Response($file, 200);
    }
    
    public function eliminarVideo($video_id){
        $usuario = \Auth::user();
        $video = Video::find($video_id);
//        $comentarios = Comentario::where('video_id',$video_id);
        
        if($usuario && $usuario->id == $video->usuario_id){
            DB::beginTransaction();
            try{
                //eliminar comentarios
                Comentario::where('video_id',$video_id)->delete();
                
                //eliminar archivos
                Storage::disk('imagenes')->delete($video->imagen);
                Storage::disk('videos')->delete($video->video_path);
                //eliminar video
                $video->delete();
                DB::commit();
                
                $message = array('message' => 'El video se ha borrado exitosamente!!');
            } catch (Exception $ex) {
                DB::rollBack();
                $message = array('message' => 'ERROR: ALLGO FALLO EN LA ELIMINACIÓN DEL VIDEO!');
            }
        }else{
            $message = array('message' => 'No tiene privilegios suficientes para esta acción.');
        }
        
        return redirect()->route('home')->with($message);
    }
    
    public function editarVideo($video_id) {
        $video = Video::find($video_id);
        return view('video.editar', array('video'=>$video));
    }
    
    public function update($video_id, Request $request){
        $validatedData = $request->validate([
            'titulo' => 'required|unique:video|min:5|max:255',
            'descripcion' => 'required',
            'imagen' => 'mimes:jpeg,png,jpg',
            'video' => 'mimes:mp4',
        ]);
        
        $video = Video::find($video_id);
        $user = \Auth::user();//obtenemos el usuario logeado
        $video->usuario_id = $user->id;
        $video->titulo = $request->input('titulo');
        $video->descripcion = $request->input('descripcion');
        //subimos archivos
        $image_file = $request->file('imagen');
        if($image_file){
            //borro la imagen anterior
            Storage::disk('imagenes')->delete($video->imagen);
            //obtengo el nombre del archivo nuevo
            $image_path = time().$image_file->getClientOriginalName();
            //para usar el disco imagenes hay que configurar filesystems en la carpeta de configuracion
            \Storage::disk('imagenes')->put($image_path, \File::get($image_file));
            
            $video->imagen = $image_path;
        }
        
        $video_file = $request->file('video');
        if($video_file){
            Storage::disk('videos')->delete($video->video_path);
            $video_path = time().$video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path, \File::get($video_file));
            
            $video->video_path = $video_path;
        }
        //guardamos
        $video->update();
        //redireccionamos
        return redirect()->route('home')->with('mensaje','El video se ha actualizado correctamente!!!');
    }
    
    public function search($search = null){
        if(is_null($search)){
            $search = \Request::get('search');
            
            return redirect()->route('videoSearch',['search' => $search]);
        }
        
        $videos = Video::where('titulo','LIKE','%'.$search.'%')->orderBy('id','desc')->paginate(3);
        
        return view('video.search',array(
            'videos' => $videos,
            'search' => $search
        ));
    }
}
