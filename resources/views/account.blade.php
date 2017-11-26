@extends('layouts.masterlog')

@section('title')
    Perfil
@endsection

@section('content')
    <section class="row new-post">
        <div class="col-md-6 offset-md-3">
            <header><h3>Tu perfil</h3></header>
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">Nombre de usuario</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" id="first_name">
                </div>
                <div class="form-group">
                    <label for="image">Imagen (unicamente .jpg)</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Guardar perfil</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
        <section class="row new-post">
            <div class="col-md-6 offset-md-3">
                <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}" alt="" class="img-responsive" width="100%">
            </div>
        </section>
    @else
        <img src="/images/sinperfil.jpg" alt="" class="img-responsive" width="100%">

    @endif
@endsection