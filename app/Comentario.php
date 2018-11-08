<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentario';
    // relacion One to Many
    public function likecomentario(){
        return $this->hasMany('App\Likecomentario');
    }
    //relacion Many to One
    public function usuario(){
        return $this->belongsTo('App\User');
    }
    
    public function video(){
        return $this->belongsTo('App', 'video_id');
    }
}
