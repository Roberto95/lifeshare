<!doctype html>
<html>
    <head>
    	<!--el yield especifica que puede cambiar el titulo-->
        <title>@yield('title')</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <!-- Fonts -->
<link rel="stylesheet" href="{{ URL::to('css/main.css') }}">

        <!-- Styles -->
       
    </head>
    <body>
    @include('includes.header')
       <div class="container">
       		@yield('content')
       </div>
       
    </body>
</html>
