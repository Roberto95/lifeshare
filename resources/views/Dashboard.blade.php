@extends('layouts.master')

@section('content')
@include('includes.message-block')
	<section class="row new-post">
		<!--col son las columnas, y para hacerla hacia la parte central, se utiliza el offset 3-->
		<div class="col-md-6 offset-md-3">
			<header>
				<h3>
					¿Qué tienes que decir?
				</h3>
			</header>
			<form action="{{ route('post.create') }}" method="post">
				<div class="form-group">
					<textarea class="form-control" name="body" id="new-post" rows="6" placeholder="Tu publicación..."></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Publicar</button> 
				<input type="hidden" value="{{ Session::token() }}" name="_token">
			</form>
		</div>
	</section>
	<section class="row posts">
		<div class="col-md-6 offset-md-3">
			<header>
				<h3>Lo que los demás dicen...</h3>
			</header>
			@foreach($posts as $post)
					<article class="post">
				<p>{{$post->body}}</p>
				<div class="info">
					<!--ya esta definida la relacion, por eso se pone post->user, ademas se modifico el output de la fecha-->
					Publicado por {{$post->user->first_name}} el {{date_format($post->created_at,'d/m/y')}}
				</div>
				<div class="interaction">
					<a href="#">Me gusta</a> |
					<a href="#">No me gusta</a>	|
					<a href="#">Editar</a> | 	
					<a href="#">Borrar</a>
				</div>
			</article>
				@endforeach
		</div>
	</section>
@endsection