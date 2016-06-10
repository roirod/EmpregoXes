@extends('layouts.main')

@section('content')

@include('includes.messages')
@include('includes.errors')

<div class="row">
	<div class="col-sm-12">
	  <div class="input-group">
		   <span class="input-group-btn pad4"> <p> Buscar títulos de los clientes:</p> </span>
	  </div>
 	</div>
</div>
	
<div class="row">
 <div class="col-sm-12 mar10">

    <form role="form" class="form" action="{!!url('/Buscador/ver')!!}" method="post">
	    
	    {!! csrf_field() !!}

		<div class="form-group col-lg-6">
		   
		   <label class="control-label text-left mar10">Selecciona título/s:</label> 
		   <br>
		   Para seleccionar varios mantén pulsado Ctrl
		   
		    <select name="selarr[]" class="form-control" style="height:200px;" multiple="multiple" required="required">

			     @foreach($titulos as $titu)

					<option value="{!!$titu->idtit!!}"> {!!$titu->nomtit!!} </option>
			 	 
			 	 @endforeach	
		   
		   </select>
		
		</div>
			
		<br>
		<div class="form-group">
		  	<div class="col-sm-12 text-left">
		  		<button type="submit" class="text-left btn btn-primary btn-md">
		   			<i class="fa fa-search"></i> Buscar
		   	</button>
			</div>
		</div>

	</form>

 </div>
</div>


<div class="row">
	<div class="col-sm-12">
		<span class="fonsi16 text-success"> Has buscado: 		
			<ul>
				@foreach ($titarr as $titar)

					<li>{!!$titar!!}</li>

				@endforeach
			</ul>	
		</span> 
	</div>
</div>


<div class="row"> 
	 <div class="col-sm-12">
		  <div class="panel panel-default">
		  
				   <table class="table">
					    <tr class="fonsi16 success">
						     <td class="wid50">&nbsp;</td>
						     <td class="wid290">Cliente</td>
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
								
								</table>
				  </div> 
		 </div>
	</div>
</div>

@endsection