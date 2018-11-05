<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    
    //relacion uno a muchos
    public function  comentarios(){
        return $this->hasMany('App\Comentario');
    }
    
    public function likevideo(){
        return $this->hasMany('App\Likevideo');
    }
    //relacion Many to One
    public function usuario(){
        return $this->belongsTo('App\User');
    }
    
    public function playlist(){
        return $this->belongsTo('App\Playlist');
    }
}
