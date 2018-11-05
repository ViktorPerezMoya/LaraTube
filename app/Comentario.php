<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'video';
    // relacion One to Many
    public function likecomentario(){
        return $this->hasMany('App\Likecomentario');
    }
    //relacion Many to One
    public function usuario(){
        return $this->belongsTo('App\User');
    }
}
