@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.clinav')

@include('includes.messages')
@include('includes.errors')


 {!! addtexto("Eliminar programa de cliente") !!}


 <div class="row"> 
  	<div class="col-sm-12 mar10">
  	
	 	<form role="form" class="form" id="form" role="form" action="{!!url("/Programcli/$idprocli")!!}" method="POST">	
	  		{!! csrf_field() !!}

			<input type="hidden" name="_method" value="DELETE">

			<input type="hidden" name="idcli" value="{{$idcli}}">

			<div class="col-sm-12">
				<span class="lead pad4"> 

					<p> &nbsp; {!! $programcli->nomprog !!} </p>

					<p> &nbsp; {!! $programcli->nomesp !!} </p>

				</span>
 			</div>
 			
 			@include('includes.delbuto')
 			
 		</form>
 	</div>
 </div>
 
 @endsection