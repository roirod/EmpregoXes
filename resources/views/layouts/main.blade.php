<!DOCTYPE html>
<html lang="es">
<head>
  @section('head')
    <meta charset="UTF-8">
    <title>EmpregoXes</title>
    
    <link href="{!! asset('assets/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" >
    <link href="{!! asset('assets/css/Start.css') !!}" rel="stylesheet" type="text/css" >
    <link href="{!! asset('assets/font-awe/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css" >
    <link href="{!! asset('assets/img/favicon.ico') !!}" rel="shortcut icon" > 
  @show
</head>

<body> 
 <br>

<div class="jumbotron container bgwi pad20">
 <div class="row">
   
   <div class="col-sm-1 wid180">
	     <h3 class="pad10"> Emprego<small>Xes</small></h3>

	     <nav class="navbar navbar-default" role="navigation">
		       <ul class="nav nav-pills nav-stacked bgtra fonsi16"> 
			         <li><a href="{!!url("/Buscador")!!}"> <i class="fa fa-search" aria-hidden="true"></i> Buscador</a></li>
			         <li><a href="{!!url("/Clientes")!!}">Clientes</a></li>
					 <li><a href="{!!url("/Programas")!!}">Programas </a></li>
			         <li><a href="{!!url("/Asuntos")!!}">Asuntos</a></li>
					 <li><a href="{!!url("/Especiali")!!}">Especialidades</a></li>
			         <li><a href="{!!url("/Titulos")!!}">T&iacute;tulos</a></li>
		       </ul>
	     </nav>
   </div>
   
   <div class="col-sm-10">
     <div class="row">
     
	       <div class="col-sm-10 fonsi16 pad4"> 
				<?php
					setlocale(LC_ALL,'es_ES.UTF-8');
						
					$Carbon = new Carbon\Carbon;
					$diactu = $Carbon::now()->formatLocalized('%A');
				?>
					
				{!! ucfirst ($diactu) !!},&nbsp;
				{!! $Carbon::now()->format('d-m-Y') !!}  &nbsp;|&nbsp;
					
				Usuario: <span class="label label-primary fonsi16"> {!! Auth::user()->username !!} </span>
		  </div>
			 
		  <div class="col-sm-2 text-right">

			  	<a href="{!!url("/Ajustes")!!}" role="button" class="btn btn-sm btn-default" title="Ajustes">
			  		<i class="fa fa-cogs" aria-hidden="true"></i>
			  	</a>
		  
				<a href="{!!url("/Manual")!!}" target="_blank" role="button" class="btn btn-sm btn-info" title="Manual">
					<i class="fa fa-question" aria-hidden="true"></i>
				</a>

				<button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" title="Cerrar">
				    <span class="caret"></span> &nbsp;
				    <i class="fa fa-close" aria-hidden="true"></i>
				</button>
				<ul class="dropdown-menu" role="menu">
				    <li><a role="button" href="{!!url("/logout")!!}" class="btn btn-default btn-sm"> Cerrar </a></li>
				</ul> 

		  </div>
			 
		  <div class="row">
			   <div class="col-sm-12">
			     <hr>
			   </div>
		  </div> 

	 </div>
 

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