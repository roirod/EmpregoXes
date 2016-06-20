@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.clinav')

@include('includes.messages')
@include('includes.errors')


 {!! addtexto("Editar Demanda") !!}


<div class="row">
  <div class="col-sm-12">

  	<form class="form" id="form" role="form" action="{{url("/Regiscli/$idregcli")}}" method="POST">

		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">

		<input type="hidden" name="idcli" value="{{$idcli}}">

		<p class="pad10"> {!! $regiscli->nomasu !!} </p>
				
			 	
		 <div class="form-group col-sm-4">
		 	<div>
		   		<label class="control-label text-left mar10">Fecha:</label>	
		   	</div> 		 	
	  			<input type="date" pattern="[0-9]{4}[- /](0[1-9]|1[012])[-/](0[1-9]|1[0-9]|2[0-9]|3[01])" name="fech" value="{!! $regiscli->fech !!}" required> 
	  	 </div>
			
		 <div class="form-group col-sm-11">
		   <label class="control-label text-left mar10">Notas:</label>
			<textarea class="form-control" name="notas" rows="4"> {!! $regiscli->notas !!} </textarea>
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