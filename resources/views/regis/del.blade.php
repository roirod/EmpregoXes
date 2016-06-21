@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.clinav')

@include('includes.messages')
@include('includes.errors')


{!! addtexto("Eliminar Demanda") !!}


 <div class="row"> 
  	<div class="col-sm-12 mar10">
  	
	 	<form role="form" class="form" id="form" role="form" action="{!!url("/Regiscli/$idregcli")!!}" method="POST">	
	  		{!! csrf_field() !!}

			<input type="hidden" name="_method" value="DELETE">

			<input type="hidden" name="idcli" value="{{$idcli}}">

			<div class="col-sm-12">
				<span class="lead pad4"> 

					<p> &nbsp; {!!$regiscli->nomasu!!} </p>

				</span>
 			</div>
 			
 			@include('includes.delbuto')
 			
 		</form>
 	</div>
 </div>
 
 @endsection