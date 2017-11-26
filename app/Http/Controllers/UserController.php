<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//autentificar
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

	

	public function postSignUp(Request $request)
	{

		//validaciones al momento de registrarse
		$this->validate($request, [
			'email'=>'required|email|unique:users',
			'first_name'=>'required|max:120',
			'password'=> 'required|min:4'

		]);

		//guardar lo que esta en el formulario
		$email = $request['email'];
		$first_name = $request['first_name'];
		$password = bcrypt($request['password']);

		//crear la instancia del modelo usuario y guardar los datos en ella
		$user=new User();
		$user->email=$email;
		$user->first_name=$first_name;
		$user->password=$password;

		//guardar cambios
		$user->save();

		//proteger dashboard y solo mostrarlo para cada usuario
		Auth::login($user);
		return redirect()->route('Dashboard');
	}

	public function postSignIn(Request $request)
	{
		//validar que no se dejen espacios en blanco
		$this->validate($request, [
			'signin_mail'=>'required',
			'signin_password'=> 'required'

		]);
		//hace intentos de ingresar y retorna bool para ver si esta bien o no el pass y el email
		if(Auth::attempt(['email'=>$request['signin_mail'], 'password'=>$request['signin_password']]))
		{
			return redirect()->route('Dashboard');
		}else{
			//guardar un mensaje de error por si no se encuentra el usuario o la contraseña
			$message='Usuario y/o contraseña inválidos';
		}	
		//redireccionar atras con el mensaje de error
		return redirect()->back()->with(['message'=>$message]);
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect()->route('home');
	}

	public function getAccount(){
		return view('account', ['user'=>Auth::user()]);
	}

	public function postSaveAccount(Request $request){
		$this->validate($request,[
			'first_name'=>'required|max:120'
		]);

		$user= Auth::user();
		$user->first_name=$request['first_name'];
		$user->update();
		$file=$request->file('image');
		$filename=$request['first_name'] . '-' . $user->id . '.jpg';
		if($file){
			//nos permite almacenar archivos de cualquier tipo se modifica en filesystems.php en la carpeta config
			Storage::disk('local')->put($filename, File::get($file));
		}

		return redirect()->route('account');
	}

	public function getUserImage($filename){
		$file=Storage::disk('local')->get($filename);
		return new Response($file, 200);
	}
}