<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">

  <title>EmpregoXes</title>
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/login.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/font-awe/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/img/favicon.ico') }}" rel="shortcut icon" >
</head>

<body> <br>

<div class="jumbotron container pad20">
	 <div class="row">
	 
	    @yield('content')
	
	 </div>
</div>

  <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>

</body>
</html>
