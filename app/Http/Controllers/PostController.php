<?php
namespace App\Http\Controllers;

use App\Post;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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

	//funcion para dar like, si se da un like en la bd con un bool se hace true
	//si se da like de nuevo, se borra el like dado
	//si de da dislike se hace false con el bool el like,
	//si se vuelve a dar dislike se borra el dislike dado
	public function postLikePost(Request $request){
		$post_id=$request['postId'];
		$is_like=$request['isLike'] === 'true';
		$update=false;
		$post=Post::find($post_id);
		if(!$post){
			return null;

		}
		$user=Auth::user();
		$like=$user->likes()->where('post_id',$post_id)->first();
		if($like){
			//ver si ya tiene o no un like
			$already_like=$like->like;
			$update = true;
			if($already_like==$is_like){
				$like->delete();
				return null;
			}
		}else{
			$like=new Like();
		}

		$like->like=$is_like;
		$like->user_id=$user->id;
		$like->post_id=$post->id;

		if($update){
			$like->update();
		}else{
			$like->save();
		}
		return null;

	}

	public static function getCountLikes($post_id){

		$resultado=DB::table('likes')->where('post_id', $post_id)->where('like', 1)->count();
		
		return $resultado;
	}

	public static function getCountDislikes($post_id){

		$resultado=DB::table('likes')->where('post_id', $post_id)->where('like', 0)->count();
		
		return $resultado;
	}
}