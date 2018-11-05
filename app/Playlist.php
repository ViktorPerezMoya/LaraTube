<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = 'playlist';
    
    //relacion One to Many
    public function videos(){
        return $this->hasMany('App\Video');
    }
    
    //relacion Many to One
    public function usuario(){
        return $this->belongsTo('App\User');
    }
    
}
