@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.clinav')

@include('includes.messages')
@include('includes.errors')


{!! addtexto("Editar Cliente") !!}


<div class="row">
  <div class="col-sm-12">

    <form role="form" id="form" class="form" action="{!!url("Clientes/$idcli")!!}" method="POST">
	    
	    {!! csrf_field() !!}

	    <input type="hidden" name="_method" value="PATCH">
	    
	    <div class="form-group col-sm-4">
	      <label class="control-label text-left mar10">Apellidos:</label>
		   <input type="text" class="form-control" pattern=".{1,111}" maxlength="111" name="apecli" value="{!!$cliente->apecli!!}" required>
		 </div>
			
		 <div class="form-group col-sm-3">
		   <label class="control-label text-left mar10">Nombre:</label>
			<input type="text" class="form-control" pattern=".{1,88}" maxlength="88" name="nomcli" value="{!!$cliente->nomcli!!}" required>
		 </div>
		 
		 <div class="form-group col-sm-4">
		   <label class="control-label text-left mar10">Poblaci&#xF3;n:</label>
			<input type="text" class="form-control" pattern=".{1,222}" maxlength="222" name="pobla" value="{!!$cliente->pobla!!}">
		 </div>  
		 
		 <div class="form-group col-sm-4">
		   <label class="control-label text-left mar10">Direcci&#xF3;n:</label>
			<input type="text" class="form-control" pattern=".{1,222}" maxlength="222" name="direc" value="{!!$cliente->direc!!}">
		 </div>
		 
		 <div class="form-group col-sm-2">
		   <label class="control-label text-left mar10">DNI:</label>
		   <input type="text" class="form-control" pattern="[A-Z0-9]{0,9}" maxlength="9" name="dni" value="{!!$cliente->dni!!}" required> 
		 </div>

		 <div class="form-group col-sm-2">
		   <label class="control-label text-left mar10">NAF:</label>
		   <input type="text" class="form-control" pattern="[A-Z0-9]{0,12}" maxlength="12" name="naf" value="{!!$cliente->naf!!}"> 
		 </div>


		 <div class="form-group col-sm-3">
		   <label class="control-label text-left mar10">Email:</label>
		   <input type="email" class="form-control" name="email" value="{!!$cliente->email!!}"> 
		 </div>
		 	 
		 <div class="form-group col-sm-2"> 
		   <label class="control-label text-left mar10">Sexo:</label>
	      <select name="sexo" class="form-control" required>
		      	@if ( $cliente->sexo == 'hombre')
		      		<option value="hombre" selected> hombre </option>
		      		<option value="mujer"> mujer </option>
		      	@else
		      		<option value="hombre"> hombre </option>
		      		<option value="mujer" selected> mujer </option>   		
		      	@endif
	      </select>
	    </div> 
			
		 <div class="form-group col-sm-2">
		   <label class="control-label text-left mar10">Tel&#xE9;fono:</label>
			<input type="text" class="form-control" pattern="[0-9 ]{0,12}" maxlength="12" name="tel1" value="{!!$cliente->tel1!!}">
	    </div>
			
		 <div class="form-group col-sm-2">
		   <label class="control-label text-left mar10">Tel&#xE9;fono:</label>
			<input type="text" class="form-control" pattern="[0-9 ]{0,12}" maxlength="12" name="tel2" value="{!!$cliente->tel2!!}">
		 </div>
			
		 <div class="form-group col-sm-2">
		   <label class="control-label text-left mar10">Tel&#xE9;fono:</label>
			<input type="text" class="form-control" pattern="[0-9 ]{0,12}" maxlength="12" name="tel3" value="{!!$cliente->tel3!!}"> 
		 </div>
		 	
		 <div class="form-group col-sm-4">
		   <label class="control-label text-left mar10">F. nacimiento:</label>		 	
	  		<input type="date" name="fenac" pattern="[0-9]{4}[- /](0[1-9]|1[012])[-/](0[1-9]|1[0-9]|2[0-9]|3[01])" value="{!!$cliente->fenac!!}"> 
	  	 </div>
			
		 <div class="form-group col-sm-11">
		   <label class="control-label text-left mar10">Notas:</label>
			<textarea class="form-control" name="notas" rows="4">{!!$cliente->notas!!}</textarea>
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