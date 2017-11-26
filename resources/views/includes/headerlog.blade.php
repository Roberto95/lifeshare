<header>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e00707;">

  <a href="{{route('Dashboard')}}"><img src="/images/ls.jpg" width="32px" height="32px"></a>
  <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>-->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		
	
	</div>
	 <ul class="nav navbar-nav navbar-right">

			<li><input type="button" value="{{Auth::user()->first_name}}" onclick="window.location='{{route('account')}}'" class="button"></li>
			<li><input type="button" value="Cerrar sesión" onclick="window.location='{{route('Logout')}}'" class="button"></li>

	</ul>
	@if (Storage::disk('local')->has(Auth::user()->first_name . '-' . Auth::user()->id . '.jpg'))
       	<img src="{{ route('account.image', ['filename' => Auth::user()->first_name . '-' . Auth::user()->id . '.jpg']) }}" alt="" class="image" width="5%">

    @else
    	<img src="/images/sinperfil.jpg" alt="" class="imagensinperfil" width="5%">


    @endif
	
</nav>
</header>