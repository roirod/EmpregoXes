@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.clinav')

@include('includes.messages')
@include('includes.errors')


 {!! addtexto("Añadir Demanda") !!}

  
<div class="row">
  <div class="col-sm-12">

    <form role="form" id="form" class="form" action="{!! url('/Regiscli') !!}" method="post">
	    {!! csrf_field() !!}

	    <input type="hidden" name="idcli" value="{!!$idcli!!}">
	    
	    <div class="form-group col-sm-5">
	      <label class="control-label text-left mar10">Selecciona Asunto:</label>
	      <select name="idasu" class="form-control" required>
			@foreach($asunto as $asun)
	      	  	<option value="{!!$asun->idasu!!}">{!!$asun->nomasu!!}</option>
			@endforeach
	      </select>
	    </div>	
			 	
		 <div class="form-group col-sm-4">
		 	<div>
		   		<label class="control-label text-left mar10">Fecha:</label>	
		   	</div> 		 	
	  			<input type="date" pattern="[0-9]{4}[- /](0[1-9]|1[012])[-/](0[1-9]|1[0-9]|2[0-9]|3[01])" name="fech" value="{!!old('fech')!!}" required > 
	  	 </div>
			
		 <div class="form-group col-sm-11">
		   <label class="control-label text-left mar10">Notas:</label>
			<textarea class="form-control" name="notas" rows="4">{!! old('notas') !!}</textarea>
		 </div>
			
		@include('includes.subutton')
    
    </form>
  </div>
</div>

@endsection

@section('js')
    @parent   
	  <script type="text/javascript" src="{!! asset('assets/js/modernizr.js') !!}"></script>
	  <script type="text/javascript" src="{!! asset('assets/js/minified/polyfiller.js') !!}"></script>
	  <script type="text/javascript" src="{!! asset('assets/js/main.js') !!}"></script>
	  <script type="text/javascript" src="{!! asset('assets/js/areyousure.js') !!}"></script>
	  <script type="text/javascript" src="{!! asset('assets/js/guarda.js') !!}"></script>
@endsection