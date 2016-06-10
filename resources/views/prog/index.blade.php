@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.messages')
@include('includes.errors')

<div class="row">
 <div class="col-sm-12">
	  <div class="input-group pad4">
		   <span class="input-group-btn pad4"> <p> Programa:</p> </span>
		   <div class="col-sm-3">
		    <span class="input-group-btn">
		    	<a href="{!!url("/Programas/create")!!}" role="button" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Nuevo</a>
		    </span> 
		   </div>
	  </div>
 </div>
</div>
	
<div class="row">
 <form role="form" class="form" action="{!!url("/Programas/ver")!!}" method="post">
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
  <div class="panel panel-default">
  
   <table class="table">
	    <tr class="fonsi16 success">
	    	 <td class="wid50"></td> 
		     <td class="wid230">Nombre</td> 
		     <td class="wid95">F. inicio</td>
		     <td class="wid95">F. fin</td>
		     <td class="wid230"></td>
	    </tr>
   </table>
   
   <div class="box400">
	   <table class="table table-hover">
	
			@foreach ($programas as $programa)
					
				<tr>
					 <td class="wid50">
						  <a class="btn btn-default" type="button" href="{!!url("/Programas/$programa->idprog")!!}" target="_blank">
						  	  <i class="fa fa-hand-pointer-o"></i>
						  </a> 
					 </td>

					 <td class="wid230">
					 	<a class="pad4" href="{!!url("/Programas/$programa->idprog")!!}" target="_blank">
					 		{!!$programa->nomprog!!}
					 	</a>
					 </td>

					 <td class="wid95">{!!date ('d-m-Y', strtotime ($programa->feini) )!!}</td> 
					 <td class="wid95">{!!date ('d-m-Y', strtotime ($programa->fefin) )!!}</td>
					 <td class="wid230"></td>
				</tr>
					
			@endforeach
		
		<table class="table table-hover">
			<tr> 
			  <div class="textcent">
			    <hr>
			    {!!$programas->links()!!}
			  </div>  
			</tr>
		</table>
	
		</table>
   </div> 
  </div>
 </div>
  </div>

@endsection