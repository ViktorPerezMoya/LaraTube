<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use App\User;
use App\Video;

class UserController extends Controller
{
    public function canal($user_id){
        $usuario = User::find($user_id);
        $videos = Video::where('usuario_id',$user_id)->paginate(2);
        
        return view('usuario.canal', array('usuario' => $usuario, 'videos' => $videos));
    }
}
