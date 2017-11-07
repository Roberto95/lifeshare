<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function user(){
    	//hacer la relacion entre el modelo usuario y el modelo post
    	//un post solo puede pertenecer a un usuario
    	return $this->belongsTo('App\User');
    }
}
