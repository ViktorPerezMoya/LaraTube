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
    }
}
