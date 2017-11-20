<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

	public function getDashboard(){
		//ordenar los posts de manera descendente
		$posts=Post::orderBy('created_at','desc')->get();
		return view('Dashboard', ['posts'=>$posts]);

	}

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

	//eliminar un post con parametro el id del post a eliminar
	public function getDeletePost($post_id){
		//se busca el id del post usando first para usar el primero que encuentre
		$post=Post::where('id',$post_id)->first();
		if(Auth::user() != $post->user){
			return redirect()->back();
		}
		$post->delete();
		return redirect()->route('Dashboard')->with(['message'=> 'Eliminado exitosamente']);
	}

	public function postEditPost(Request $request){
		$this->validate($request, [
			'body'=>'required'
		]);
		$post =Post::find($request['postId']);
		if(Auth::user() != $post->user){
			return redirect()->back();
		}
		$post->body=$request['body'];
		$post->update();
		return response()->json(['new_body'=>$post->body],200);
	}
}