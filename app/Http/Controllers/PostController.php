<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
	public function postCreatepost(Request $request){
		//validacion
		$this->validate($request, [
				'body'=>'required|max:1000'
			]);

		$post=new Post();
		//se guarda en el body del model de posts de la db
		$post->body=$request['body'];
		$message='Ha habido un error';
		//se guarda el post para el usuario autenticado actualmente
		
		if($request->user()->posts()->save($post)){
			$message='Post creado exitosamente';
		}
		
		return redirect()->route('Dashboard')->with(['message'=>$message]);
	}
}