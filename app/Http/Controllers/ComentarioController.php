<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comentario;

class ComentarioController extends Controller
{
    public function store(Request $request){
        $validationData = $this->validate($request, array(
            'texto' => 'required',
        ));

        $comentario = new Comentario();
        $user = \Auth::user();
        $comentario->usuario_id = $user->id;
        $comentario->video_id = $request->input('video_id');
        $comentario->texto = $request->input('texto');
        $comentario->liked = 0;
        $comentario->disliked = 0;

        $comentario->save();

        return redirect()->route('videoDetalle',array('video_id' => $comentario->video_id))
                ->with(array('message' => 'Comentario añadido exitosamente!!'));
    }
    
    public function eliminarComentario($comentario_id){
        $usuario = \Auth::user();
        $comentario = Comentario::find($comentario_id);
        
        if($usuario && ($comentario->usuario_id == $usuario->id || $comentario->video->usuario_id == $usuario->id)){
            $comentario->delete();
        }
        return redirect()->route('videoDetalle',array('video_id' => $comentario->video_id))
                ->with(array('message' => 'Comentario borrado exitosamente!!'));
    }
}
