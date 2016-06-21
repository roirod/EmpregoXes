@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.clinav')

@include('includes.messages')
@include('includes.errors')


<div class="row">
 <div class="col-sm-12">
     <div class="input-group">
       <span class="input-group-btn pad10"> <p> Cliente: </p> </span>
       <div class="btn-toolbar pad10" role="toolbar">
         <div class="btn-group">
           <a  href="{!!url("Clientes/$idcli/edit")!!}" role="button" class="btn btn-sm btn-success">
           	 <i class="fa fa-edit"></i> Editar
           </a> 
         </div>
         <div class="btn-group">
		     <a href="{!!url("/Clientes/$idcli/del")!!}" role="button" class="btn btn-sm btn-danger">
		      	 <i class="fa fa-times"></i> Eliminar
		     </a> 
         </div>
       </div>
     </div>
   </div>
 </div>



 <div class="row pad10">
  <form role="form" action="{!!url('/Clientes/upload')!!}" method="post" enctype="multipart/form-data">
  	  {!! csrf_field() !!}

       <input type="hidden" name="idcli" value="{!!$idcli!!}">
       <input type="hidden" name="fotoper" value="1">
  
  	  <div class="input-group">
  	    <span class="input-group-btn pad4"> 
  	      <p>&nbsp;&nbsp; Subir foto perfil: &nbsp;&nbsp;</p> 
  	    </span> 
  	    <span class="input-group-btn"> 
  	      <input type="file" class="btn btn-default" name="files" />
  	    </span> 
  	    &nbsp;&nbsp;&nbsp;
  	    <span class="pad10"> 
  	      <button type="submit" class="btn btn-info">&nbsp;<i class="fa fa-upload"></i>&nbsp;</button>
  	    </span>
  	  </div>
  </form>
</div>

<hr>


<div class="row mar10 fonsi16">

		<div class="col-sm-2 pad4 max150">
			<img src="{!! $fotoper !!}?{!! time() !!}">
		</div> 

	  <div class="col-sm-6 pad4"> 
	    <i class="fa fa-minus-square"></i> Nombre: &nbsp; {!!$clientes->apecli!!}, &nbsp; {!!$clientes->nomcli!!}
	  </div>
	  
	  <div class="col-sm-2 pad4"> 
	    <i class="fa fa-minus-square"></i> ID: &nbsp; {!!$clientes->idcli!!}
	  </div>
	  
	  <div class="col-sm-5 pad4">
	    <i class="fa fa-minus-square"></i> Poblaci&#xF3;n: &nbsp; {!!$clientes->pobla!!}
	  </div>

	    <div class="col-sm-5 pad4">
	    <i class="fa fa-minus-square"></i> Direcci&#xF3;n: &nbsp; {!!$clientes->direc!!}
	  </div> 
	  
	  <div class="col-sm-3 pad4">
	    <i class="fa fa-minus-square"></i> DNI: &nbsp; {!! $clientes->dni!!}
	  </div>
	  
	  <div class="col-sm-3 pad4">
	    <i class="fa fa-minus-square"></i> NAF: &nbsp; {!! $clientes->naf!!}
	  </div>    
	  
	  <div class="col-sm-4 pad4">
	    <i class="fa fa-minus-square"></i> Email: &nbsp; {!! $clientes->email!!}
	  </div>   
	  
	  <div class="col-sm-2 pad4">
	    <i class="fa fa-minus-square"></i> Sexo: &nbsp; {!!$clientes->sexo!!}
	  </div>
	  
	   <div class="col-sm-3 pad4">
	    <i class="fa fa-minus-square"></i> Tel&#xE9;fono: &nbsp;{!!$clientes->tel1!!}
	  </div>
	  
	  <div class="col-sm-3 pad4">
	    <i class="fa fa-minus-square"></i> Tel&#xE9;fono2: &nbsp; {!! $clientes->tel2!!}
	  </div>
	  
	  <div class="col-sm-3 pad4">
		 <i class="fa fa-minus-square"></i> Tel&#xE9;fono3: &nbsp; {!!$clientes->tel3!!}
	  </div> 
	  
	  <div class="col-sm-3 pad4"> 
	    <i class="fa fa-minus-square"></i> F. nacimiento: &nbsp; {!!date ('d-m-Y', strtotime ($clientes->fenac) )!!}
	  </div>
	  
	  <div class="col-sm-2 pad4"> 	
		 <i class="fa fa-minus-square"></i> Edad: &nbsp; {!!$Edad!!} años
	  </div>

	  <div class="col-sm-12 pad4"> 
		 <i class="fa fa-minus-square"></i> Notas: 
		 <br>
		 <div class="box200"> 
		   {!!nl2br($clientes->notas)!!}
		 </div>
	  </div>

</div>

<hr> <br> 


<div class="row">
  
  <div class="col-sm-12">
	  <div class="input-group">
		   <span class="input-group-btn pad4"> <p> Títulos, formación:</p> </span>
		   <div class="col-sm-3">
		    <span class="input-group-btn">
		    	<a href="{!!url("/Titucli/$idcli/create")!!}" role="button" class="btn btn-sm btn-primary"> 
		    		<i class="fa fa-plus"></i> Añadir
		    	</a>
		    </span> 
		   </div>
	  </div>
  </div>

  <div class="col-sm-12 mar10">

			<div class="panel panel-default">
				<div class="box260">
			   	<table class="table table-hover">
		       	  		
						 @foreach ($titucli as $tituc)

								<tr>
									  <td class="wid230">{!!$tituc->nomtit!!}</td>
									  						
									  <td class="wid50">

									    <form role="form" id="form" class="form" action="{!!url("/Titucli/$tituc->idtitcli")!!}" method="POST">
										    <input type="hidden" name="_method" value="DELETE">
										    
										    {!! csrf_field() !!}

												 <div class="btn-group">
												   <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" title="Eliminar">
												     <i class="fa fa-times"></i>
												     <span class="caret"></span>
												   </button>
												   <ul class="dropdown-menu" role="menu">
												     <li>
													     <button type="submit" href="{!!url("/Titucli/$tituc->idtitcli")!!}" class="btn btn-xs btn-danger">
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
   <span class="input-group-btn pad10">  <p> Programas: </p> </span>
   	<div class="btn-toolbar pad10" role="toolbar"> 
	   	<div class="btn-group">
		  	<form class="form" id="form" role="form" action="{!!url("/Programcli/crea")!!}" method="POST">
				{!! csrf_field() !!}
				<input type="hidden" name="idcli" value="{!!$idcli!!}">

				<button type="submit" class="text-left btn btn-primary btn-sm">Añadir
					<i class="fa fa-plus"></i> 
				</button>
			</form>
		</div>
 </div> </div> 
</div> </div>

<div class="row">
  <div class="col-sm-12">
	 <div class="panel panel-default">
	   <table class="table">
	     <tr class="fonsi16 success">
	       <td class="wid180">Programa</td>
	       <td class="wid110">Especialidad</td>
	       <td class="wid70">F. inicio</td>
	       <td class="wid70">F. fin</td>
	       <td class="wid180">Notas</td>
	       <td class="wid50"></td>
	       <td class="wid50"></td>
	     </tr>
	   </table> 
	 <div class="box260">
	   <table class="table table-striped">
       	  		
		 @foreach ($programcli as $progcli)

			<tr>
				  <td class="wid180">
					 	<a class="pad4" href="{!!url("/Programas/$progcli->idprog")!!}" target="_blank">
					 		{!!$progcli->nomprog!!}
					 	</a>
				  </td>

				  <td class="wid110">{!! $progcli->nomesp !!}</td>

				  <td class="wid70">{!!date('d-m-Y', strtotime($progcli->feini) )!!}</td>
				  <td class="wid70">{!!date('d-m-Y', strtotime($progcli->fefin) )!!}</td>
				  <td class="wid180">{!!$progcli->notas!!}</td>
				  
				  <td class="wid50">
			           <a  href="{!!url("/Programcli/$idcli/$progcli->idprocli/edit")!!}" role="button" class="btn btn-xs btn-success" title="Editar">
			           	 <i class="fa fa-edit"></i> 
			           </a> 
				  </td>
				
				  <td class="wid50">
					 <div class="btn-group">
					   <button type="button" class="btn btn-xs btn-danger btn-md dropdown-toggle" data-toggle="dropdown">
					     <i class="fa fa-times"></i>
					     <span class="caret"></span>
					   </button>
					   <ul class="dropdown-menu" role="menu">
					     <li>
						     <a  href="{!!url("/Programcli/$idcli/$progcli->idprocli/del")!!}" role="button" class="btn btn-xs btn-danger" title="Eliminar">
						      	 <i class="fa fa-times"></i> Eliminar
						     </a> 
					     </li>
					    </ul>
					  </div>
				   </td>
		   	</tr>	
		
		  @endforeach 

	     </table>
	   </div>
	 </div>
  </div>
</div>
		

<hr><br>

<div class="row">
 <div class="col-sm-12">
	  <div class="input-group">
		   <span class="input-group-btn pad4"> <p> Demandas:</p> </span>
		   <div class="col-sm-3">
		    <span class="input-group-btn">
		    	<a href="{!!url("/Regiscli/$idcli/create")!!}" role="button" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Añadir</a>
		    </span> 
		   </div>
	  </div>
 </div>
</div>

<div class="row">
  <div class="col-sm-12">
	 <div class="panel panel-default">
	   <table class="table">
	     <tr class="fonsi16 success">
	       <td class="wid230">Asunto</td>
	       <td class="wid95">Fecha</td>
	       <td class="wid230">Notas</td>
	       <td class="wid50"></td>
	       <td class="wid50"></td>
	     </tr>
	   </table> 
	 <div class="box260">
	   <table class="table table-striped">
 
	@foreach ($regiscli as $regcli)
		<tr>
		  <td class="wid230">{!!$regcli->nomasu!!}</td>
		  <td class="wid95">{!!date('d-m-Y',strtotime($regcli->fech))!!}</td>
		  <td class="wid230">{!!$regcli->notas!!}</td>

		  <td class="wid50">
		    <a role="button" href="{!!url("Regiscli/$idcli/$regcli->idregcli/edit")!!}" class="btn btn-xs btn-success" title="Editar">	
		     	<i class="fa fa-edit"></i> 
			</a>
		  </td>
		
		  <td class="wid50">
			 <div class="btn-group">
			   <button type="button" class="btn btn-xs btn-danger btn-md dropdown-toggle" data-toggle="dropdown" title="Eliminar">
			     <i class="fa fa-times"></i>
			     <span class="caret"></span>
			   </button>
			   <ul class="dropdown-menu" role="menu">
			     <li>
			     	<a role="button" class="btn btn-xs btn-danger" href="{!!url("Regiscli/$idcli/$regcli->idregcli/del")!!}">	
	     				<i class="fa fa-times"></i> Eliminar
	     			</a>
			     </li>
			    </ul>
			  </div>
		   </td>

		</tr>		
	@endforeach
				
     </table>
   </div>
 </div>
</div>		
	 
@endsection