<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //un usuario puede dar likes
    public function user(){
    	return $this->belongsTo('App\User');
    }

    //un post puede tener likes
    public function post(){
    	return $this->belongsTo('App\Post');
    }
}
