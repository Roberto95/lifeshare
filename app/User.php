<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    //
	use \Illuminate\Auth\Authenticatable;

	public function posts(){
		//relacion entre post y user
		//un usuario puede tener muchos post.
		return $this->hasMany('App\Post');
	}
}
