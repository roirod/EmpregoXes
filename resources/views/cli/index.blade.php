@extends('layouts.main')

@section('content')

@include('includes.messages')
@include('includes.errors')

<div class="row">
	<div class="col-sm-12">
	  <div class="input-group pad4">
		   <span class="input-group-btn pad4"> <p> Cliente:</p> </span>
		   <div class="col-sm-3">
		    <span class="input-group-btn">
		    	<a href="{!!url("/Clientes/create")!!}" role="button" class="btn btn-sm btn-primary">
		    		 <i class="fa fa-plus"></i> Nuevo
		    	</a>
		    </span> 
		   </div>
	  </div>
 	</div>
</div>
	
<div class="row">
	 <form role="form" class="form" action="{!!url("/Clientes/ver")!!}" method="post">

		 	{!! csrf_field() !!}
	
			 <div class="input-group">

				  <span class="input-group-btn pad4"> <p> &nbsp; Buscar en:</p> </span>

				  <div class="col-sm-2">

	      			<select name="busen" class="form-control" required>

	      				<option value="apecli" selected> Apellido/s </option>
	      				<option value="dni"> DNI </option>

					</select>

				  </div>

				  <div class="col-sm-4">
				   		<input type="search" name="busca" class="form-control" placeholder="buscar..." autofocus required>
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
						     <td class="wid50">&nbsp;</td>
						     <td class="wid290">Nombre</td>
						     <td class="wid110 textcent">DNI</td>
						     <td class="wid110">Poblaci&#xF3;n</td>			     
						     <td class="wid110 textcent">Tel&#xE9;fono</td>
					    </tr>
				   </table>
				   
				   <div class="box400">
						   <table class="table table-hover">
						
								@foreach ($clientes as $cliente)
										
									<tr>
										<td class="wid50">
											<a class="btn btn-default" href="{!!url("/Clientes/$cliente->idcli")!!}" target="_blank" role="button">
												<i class="fa fa-hand-pointer-o"></i>
											</a> 
										</td>

										<td class="wid290">
											<a class="pad4" href="{!!url("/Clientes/$cliente->idcli")!!}" target="_blank">
												{!!$cliente->apecli!!}, {!!$cliente->nomcli!!}
											</a> 
										</td>

										 <td class="wid110 textcent">{!!$cliente->dni!!}</td>
										 <td class="wid110">{!!$cliente->pobla!!}</td> 
										 <td class="wid110 textder">{!!$cliente->tel1!!}</td>
									</tr>
										
								@endforeach
								
										<table class="table table-hover">
											<tr> 
											  <div class="textcent">
											    <hr>
											    {!!$clientes->links()!!}
											  </div>  
											</tr>
										</table>
								
								</table>
				  </div> 
		 </div>
	</div>
</div>

@endsection