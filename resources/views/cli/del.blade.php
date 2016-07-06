@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.clinav')

@include('includes.messages')
@include('includes.errors')


{!! addtexto("Eliminar Cliente") !!}


 <div class="row"> 
  	<div class="col-sm-12 mar10">
  	
	 	<form role="form" class="form" id="form" role="form" action="{!!url("/Clientes/$idcli")!!}" method="POST">	
	  		{!! csrf_field() !!}

			<input type="hidden" name="_method" value="DELETE">

			<div class="col-sm-12">
				<span class="lead pad4"> 

					<p> &nbsp;{!!$cliente->apecli!!}, {!!$cliente->nomcli!!}</p>
					<p> &nbsp; dni: {!!$cliente->dni!!} </p>

				</span>
 			</div>
 			
 			@include('includes.delbuto')
 			
 		</form>
 	</div>
 </div>
 
 @endsection