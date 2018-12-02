<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

use App\User;
use App\Video;
use App\Playlist;
class UserController extends Controller
{
    public function canal($user_id){
        $data['usuario'] = User::find($user_id);
        $data['videos'] = Video::where('usuario_id',$user_id)->paginate(2);
        $data['listas'] = Playlist::where('usuario_id','=', $user_id)->orderBy('titulo','asc')->get();
        
        
        return view('usuario.canal', $data);
    }
}
