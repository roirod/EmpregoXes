<!DOCTYPE html>
<html lang="es">

<head>
  @section('head')
    <meta charset="utf-8">
    <title>EmpregoXes</title>

    <link href="{!! asset('assets/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" >
    <link href="{!! asset('assets/css/manual.css') !!}" rel="stylesheet" type="text/css" >
    <link href="{!! asset('assets/font-awe/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css" >
    <link href="{!! asset('assets/img/favicon.ico') !!}" rel="shortcut icon" > 
  @show
</head>

<body id="inicio"> 


    <div class="container bgwi">
     <div class="row">
       
       	<div class="col-sm-12">


       		@yield('content')


    	</div>
       
      </div>
    </div>
  
  @section('js')
	  <script type="text/javascript" src="{!! asset('assets/js/jquery.min.js') !!}"></script>
	  <script type="text/javascript" src="{!! asset('assets/js/bootstrap.min.js') !!}"></script>
  @show
       
</body>
</html>