@extends('layouts.master')

@section('content')
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
			<article class="post">
				<p>el texto que aqui deberia ir</p>
				<div class="info">
					Posted by beto on 12 nov 2016
				</div>
				<div class="interaction">
					<a href="#">Like</a> |
					<a href="#">Dislike</a>	|
					<a href="#">Edit</a> | 	
					<a href="#">Delete</a>
				</div>
			</article>

			<article class="post">
				<p>el texto que aqui deberia ir</p>
				<div class="info">
					Posted by beto on 12 nov 2016
				</div>
				<div class="interaction">
					<a href="#">Like</a> |
					<a href="#">Dislike</a>	|
					<a href="#">Edit</a> | 	
					<a href="#">Delete</a>
				</div>
			</article>
		</div>
	</section>
@endsection