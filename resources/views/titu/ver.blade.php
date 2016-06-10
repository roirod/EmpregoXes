@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.messages')
@include('includes.errors')

<div class="row">
 <div class="col-sm-12">
	  <div class="input-group pad4">
		   <span class="input-group-btn pad4"> <p> T&#xED;tulo:</p> </span>
		   <div class="col-sm-3">
		    <span class="input-group-btn">
		    	<a href="{!!url("/Titulos/create")!!}" role="button" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Nuevo</a>
		    </span> 
		   </div>
	  </div>
 </div>
</div>


<div class="row">
	 <form role="form" class="form" action="{!!url("/Titulos/ver")!!}" method="post">
	 	{!! csrf_field() !!}
		 <div class="input-group">
			  <span class="input-group-btn pad4"> <p> &nbsp; Buscar por nombre:</p> </span>
			  <div class="col-sm-4">
			   	<input type="search" name="busca" class="form-control" placeholder="buscar..." required>
			  </div>
			  <div class="col-sm-1">
			   	<button class="btn btn-default" type="submit"> <i class="fa fa-arrow-circle-right"></i></button>
			  </div> 
		 </div>
	 </form>
</div>


<div class="row">
	<div class="col-sm-12">
		<span class="fonsi16 text-success"> Has buscado: {!!$busca!!} </span> 
	</div>
</div>


<div class="row"> 
 <div class="col-sm-12">
  <div class="panel panel-default">
  
   <table class="table">
	    <tr class="fonsi16 success">
		     <td class="wid390">Nombre</td> 
		     <td class="wid50"></td> 
		     <td class="wid50"></td>
		     <td class="wid290"></td>
	    </tr>
   </table>
   
   <div class="box400">
	   <table class="table table-hover">
	
			@foreach ($titulos as $titulo)
					
				<tr>
					 <td class="wid390">{!!$titulo->nomtit!!}</td>

					 <td class="wid50">
			           <a href="{!!url("/Titulos/$titulo->idtit/edit")!!}" role="button" class="btn btn-sm btn-success" title="Editar">
			           	 <i class="fa fa-edit"></i>
			           </a> 
					 </td>

					 <td class="wid50">
						 <div class="btn-group">
						   <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">
						     <i class="fa fa-times"></i>
						     <span class="caret"></span>
						   </button>
						   <ul class="dropdown-menu" role="menu">
						     <li>
							     <a  href="{!!url("/Titulos/$titulo->idtit/del")!!}" role="button" class="btn btn-sm btn-danger" title="Eliminar">
							      	 <i class="fa fa-times"></i>
							     </a> 
						     </li>
						    </ul>
						  </div>
					 </td>					 

					 <td class="wid290"></td> 
				</tr>
					
			@endforeach
	
		</table>
   </div> 
  </div>
 </div>
  </div>

@endsection