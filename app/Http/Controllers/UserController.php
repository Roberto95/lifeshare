<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
//autentificar
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

	public function getDashboard(){
		return view('Dashboard');

	}

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
		}	
		return redirect()->back();
	}
}