@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.prognav')

@include('includes.messages')
@include('includes.errors')


   <div class="row">
     <div class="col-sm-12">
	     <hr>
	     <div class="input-group">
	       <span class="input-group-btn pad10"> <p> Programa: </p> </span>
	       <div class="btn-toolbar pad10" role="toolbar">
	         <div class="btn-group">
	           <a  href="{!!url("Programas/$idprog/edit")!!}" role="button" class="btn btn-sm btn-success">
	           	 <i class="fa fa-edit"></i> Editar
	           </a> 
	         </div>
	         <div class="btn-group">
			     <a href="{!!url("/Programas/$idprog/del")!!}" role="button" class="btn btn-sm btn-danger">
			      	 <i class="fa fa-times"></i> Eliminar
			     </a> 
	         </div>
	       </div>
	     </div>
	   </div>
	 </div>



<div class="row mar10 fonsi16">

	  <div class="col-sm-12 pad4"> 
	    <i class="fa fa-minus-square"></i> Nombre: &nbsp; {!!$programa->nomprog!!}
	  </div>
	  
	  <div class="col-sm-12 pad4"> 
	    <i class="fa fa-minus-square"></i> ID: &nbsp; {!!$programa->idprog!!}
	  </div>
	  
	  <div class="col-sm-12 pad4">
	    <i class="fa fa-minus-square"></i> Fecha inicio: &nbsp; {!!date ('d-m-Y', strtotime ($programa->feini) )!!}
	  </div> 

	   <div class="col-sm-12 pad4">
	    <i class="fa fa-minus-square"></i> Fecha fin: &nbsp; {!!date ('d-m-Y', strtotime ($programa->fefin) )!!}
	  </div> 

	  <div class="col-sm-12 pad4"> 
		 <i class="fa fa-minus-square"></i> Notas: 
		 <br>
		 <div class="box200"> 
		   {!!nl2br($programa->notas)!!}
		 </div>
	  </div>

</div>


<hr> <br> 


<div class="row">  
  <div class="col-sm-12">
	  <div class="input-group">
		   <span class="input-group-btn pad4"> <p> Especialidades, acciones:</p> </span>
		   <div class="col-sm-3">
		    <span class="input-group-btn">
		    	<a href="{!!url("/Especiprog/$idprog/create")!!}" role="button" class="btn btn-sm btn-primary"> 
		    		<i class="fa fa-plus"></i> Añadir
		    	</a>
		    </span> 
		   </div>
	  </div>
  </div>
 </div>


 <div class="row"> 
  <div class="col-sm-12">

		<div class="panel panel-default">
			<div class="box260">
		   	<table class="table table-hover">
       	  		
				 @foreach ($especiprog as $esprog)

						<tr>
							  <td class="wid230">{!!$esprog->nomesp!!}</td>
							  						
							  <td class="wid50">

							    <form role="form" id="form" class="form" action="{!!url("/Especiprog/$esprog->idesprog")!!}" method="POST">
								    <input type="hidden" name="_method" value="DELETE">
								    
								    {!! csrf_field() !!}

										 <div class="btn-group">
										   <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" title="Eliminar">
										     <i class="fa fa-times"></i>
										     <span class="caret"></span>
										   </button>
										   <ul class="dropdown-menu" role="menu">
										     <li>
											     <button type="submit" class="btn btn-xs btn-danger">
											      	 <i class="fa fa-times"></i> Eliminar
											     </button> 
										     </li>
										    </ul>
										  </div>
								</form>

							   </td>

							   <td class="wid290"></td>

				   		</tr>	
				
				  @endforeach 

		     </table>
		   </div>
		 </div>

   </div>
</div>


<hr> <br>



<div class="row">  
  <div class="col-sm-12">
	  <div class="input-group">
		   <span class="input-group-btn pad4"> <p> Integrantes del programa:</p> </span>
	  </div>
  </div>
 </div>

<div class="row">
  <div class="col-sm-12">
	 <div class="panel panel-default">
	   <table class="table">
	     <tr class="fonsi16 success">
	       <td class="wid230">Nombre</td>
	       <td class="wid110">Especialidad</td>
	       <td class="wid70">F. inicio</td>
	       <td class="wid70">F. fin</td>
	       <td class="wid180">Notas</td>
	     </tr>
	   </table> 
	 <div class="box260">
	   <table class="table table-striped">
       	  		
		 @foreach ($programcli as $progcli)

			<tr>
				  <td class="wid230">
						<a class="pad4" href="{!!url("/Clientes/$progcli->idcli")!!}" target="_blank">
							{!!$progcli->apecli!!}, {!!$progcli->nomcli!!}
						</a>				  
				  </td>
				  
				  <td class="wid110">{!!$progcli->nomesp!!}</td>
				  <td class="wid70">{!!date('d-m-Y', strtotime($progcli->feini) )!!}</td>
				  <td class="wid70">{!!date('d-m-Y', strtotime($progcli->fefin) )!!}</td>
				  <td class="wid180">{!!$progcli->notas!!}</td>
		   	</tr>	
		
		  @endforeach 

	     </table>
	   </div>
	 </div>
  </div>
</div>
			 
@endsection