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
					<article class="post" data-postid="{{$post->id}}">
				<p>{{$post->body}}</p>
				<div class="info">
					<!--ya esta definida la relacion, por eso se pone post->user, ademas se modifico el output de la fecha-->
					Publicado por {{$post->user->first_name}} el {{date_format($post->created_at,'d/m/y')}}
				</div>
				<div class="interaction">
					<a href="#">Me gusta</a> |
					<a href="#">No me gusta</a>	
					@if(Auth::user() == $post->user)
						|
						<a href="#" class="edit">Editar</a> | 	
						<a href="{{route('post.delete', ['post_id'=>$post->id])}}">Borrar</a>	
					@endif
					
				</div>
			</article>
				@endforeach
		</div>
	</section>

	<div class="modal" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Post</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="post-body">Editar</label>
                            <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Guardar cambios</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
    	var token='{{Session::token() }}';
    	var url='{{route('edit')}}';
    </script>

@endsection