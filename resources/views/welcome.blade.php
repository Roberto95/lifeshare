@extends('layouts.master')

@section('title')
    Bienvenido a LifeShare
@endsection

@section('content')
    @include('includes.message-block')

   <div class="row">
        <div class="col-md-4 offset-md-1">
        <h3>Registrarse:</h3>
        <!--Mover la ruta hacia el signup de las rutas, la cual a su vez se redirige a las funciones en el controlador-->
            <form action="{{ route('signup') }}" method="post">
                <div class="form-group">
                    <label for="email">Tu E-mail</label>
                    <!--{{ $errors->has('email') ? 'is-invalid' : '' }} esto es para marcar en rojo los errores en los campos-->
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" placeholder="example@example.com" value="{{Request::old('email')}}">
                 </div>
                 <div class="form-group">
                    <label for="first_name">Tu nombre de usuario</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" placeholder="Escribe tu nombre de usuario..." value="{{Request::old('first_name')}}">
                 </div>
                 <div class="form-group">
                    <label for="password">Tu contraseña</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" placeholder="Escribe tu contraseña...">
                 </div>
                 <button type="submit" class="btn btn-primary">Crear cuenta</button>
                 <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>

        <div class="col-md-4 offset-md-2">
            <h3>Iniciar sesión:</h3>
            <!--Mover la ruta hacia el signin de las rutas, la cual a su vez se redirige a las funciones en el controlador-->
            <form action="{{route('signin')}}" method="post">
                <div class="form-group">
                    <label for="email">Tu E-mail</label>
                    <input class="form-control {{ $errors->has('signin_mail') ? 'is-invalid' : '' }}" type="text" name="signin_mail" id="signin_mail" placeholder="example@example.com" value="{{Request::old('signin_mail')}}">
                 </div>
                
                 <div class="form-group">
                    <label for="password">Tu contraseña</label>
                    <input class="form-control {{ $errors->has('signin_password') ? 'is-invalid' : '' }}" type="password" name="signin_password" id="signin_password" placeholder="Escribe tu contraseña...">
                 </div>
                 <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
   </div>


@endsection