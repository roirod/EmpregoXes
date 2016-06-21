@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.clinav')

@include('includes.messages')
@include('includes.errors')


 {!! addtexto("Editar programa de cliente") !!}


<div class="row">
  <div class="col-sm-12">

  	<form class="form" id="form" role="form" action="{{url("/Programcli/$idprocli")}}" method="POST">

		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">

		<input type="hidden" name="idcli" value="{{$idcli}}">

		<p class="pad10"> {!! $programcli->nomprog !!} </p>

		<p class="pad10"> {!! $programcli->nomesp !!} </p>
				
			 	
		 <div class="form-group col-sm-4">
		 	<div>
		   		<label class="control-label text-left mar10">F. inicio:</label>	
		   	</div> 		 	
	  			<input type="date" pattern="[0-9]{4}[- /](0[1-9]|1[012])[-/](0[1-9]|1[0-9]|2[0-9]|3[01])" name="feini" value="{!! $programcli->feini !!}" required> 
	  	 </div>
			 	
		 <div class="form-group col-sm-4">
		 	<div>
		   		<label class="control-label text-left mar10">F. fin:</label>	
		   	</div> 		 	
	  			<input type="date" pattern="[0-9]{4}[- /](0[1-9]|1[012])[-/](0[1-9]|1[0-9]|2[0-9]|3[01])" name="fefin" value="{!! $programcli->fefin !!}" required> 
	  	 </div>
			
		 <div class="form-group col-sm-11">
		   <label class="control-label text-left mar10">Notas:</label>
			<textarea class="form-control" name="notas" rows="4"> {!! $programcli->notas !!} </textarea>
		 </div>
			
		@include('includes.subutton')
	 
	 </form>
 
</div>  </div>

@endsection

@section('js')
    @parent

	  <script type="text/javascript" src="{!! asset('assets/js/modernizr.js') !!}"></script>
	  <script type="text/javascript" src="{!! asset('assets/js/minified/polyfiller.js') !!}"></script>
	  <script type="text/javascript" src="{!! asset('assets/js/main.js') !!}"></script>
	  <script type="text/javascript" src="{!! asset('assets/js/areyousure.js') !!}"></script>
	  <script type="text/javascript" src="{!! asset('assets/js/guarda.js') !!}"></script>
@endsection