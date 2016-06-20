@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.messages')
@include('includes.errors')


{!! addtexto("Añadir Cliente") !!}


<div class="row">
  <div class="col-sm-12">
    <div class="text-danger pad10">
        *NAF: 12 caracteres. *DNI: 9 caracteres.     
    </div>  
  </div>
</div>
     
<div class="row">
  <div class="col-sm-12">
    <form role="form" id="form" class="form" action="{!! url('/Clientes') !!}" method="post">
	    {!! csrf_field() !!}
	    
	    <div class="form-group col-sm-4">
	      <label class="control-label text-left mar10">Apellidos:</label>
		   <input type="text" class="form-control" pattern=".{1,111}" maxlength="111" name="apecli" value="{!! old('apecli') !!}" required>
		 </div>
			
		 <div class="form-group col-sm-3">
		   <label class="control-label text-left mar10">Nombre:</label>
			<input type="text" class="form-control" pattern=".{1,88}" maxlength="88" name="nomcli" value="{!! old('nomcli') !!}" required>
		 </div>
		 
		 <div class="form-group col-sm-4">
		   <label class="control-label text-left mar10">Poblaci&#xF3;n:</label>
			<input type="text" class="form-control" pattern=".{0,166}" maxlength="166" name="pobla" value="{!! old('username') !!}">
		 </div>  
		 
		 <div class="form-group col-sm-4">
		   <label class="control-label text-left mar10">Direcci&#xF3;n:</label>
			<input type="text" class="form-control" pattern=".{0,166}" maxlength="166" name="direc" value="{!! old('direc') !!}">
		 </div>
		 
		 <div class="form-group col-sm-2">
		   <label class="control-label text-left mar10">DNI:</label>
		   <input type="text" class="form-control" pattern="[A-Z0-9]{0,9}" maxlength="9" name="dni" value="{!! old('dni') !!}" required> 
		 </div>

		 <div class="form-group col-sm-2">
		   <label class="control-label text-left mar10">NAF:</label>
		   <input type="text" class="form-control" pattern="[A-Z0-9]{0,12}" maxlength="12" name="naf" value="{!! old('naf') !!}"> 
		 </div>

		 <div class="form-group col-sm-3">
		   <label class="control-label text-left mar10">Email:</label>
		   <input type="email" class="form-control" name="email" value="{!! old('email') !!}"> 
		 </div>
		 	 
		 <div class="form-group col-sm-2"> 
		   <label class="control-label text-left mar10">Sexo:</label>
	      <select name="sexo" class="form-control" required>
	        <option value="hombre" selected> hombre </option>
	        <option value="mujer"> mujer </option>
	      </select>
	    </div>		
			
		 <div class="form-group col-sm-2">
		   <label class="control-label text-left mar10">Tel&#xE9;fono:</label>
			<input type="text" class="form-control" pattern="[0-9 ]{0,12}" maxlength="12" name="tel1" value="{!! old('tel1') !!}">
	    </div>
			
		 <div class="form-group col-sm-2">
		   <label class="control-label text-left mar10">Tel&#xE9;fono:</label>
			<input type="text" class="form-control" pattern="[0-9 ]{0,12}" maxlength="12" name="tel2" value="{!! old('tel2') !!}">
		 </div>
			
		 <div class="form-group col-sm-2">
		   <label class="control-label text-left mar10">Tel&#xE9;fono:</label>
			<input type="text" class="form-control" pattern="[0-9 ]{0,12}" maxlength="12" name="tel3" value="{!! old('tel3') !!}"> 
		 </div>
		 	
		 <div class="form-group col-sm-4">
		   <label class="control-label text-left mar10">F. nacimiento:</label>		 	
	  		<input type="date" name="fenac" value="1970-01-01" pattern="[0-9]{4}[- /](0[1-9]|1[012])[-/](0[1-9]|1[0-9]|2[0-9]|3[01])"> 
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