@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.messages')
@include('includes.errors')

<?php
 addtexto("Añadir Título");
?>
  
<div class="row">
  <div class="col-sm-12">
    <form role="form" id="form" class="form" action="{!! url('/Titulos') !!}" method="post">
    {!! csrf_field() !!}
    
    <div class="row">
	    <div class="form-group col-sm-6">
	      <label class="control-label text-left mar10">Nombre:</label>
		   <input type="text" class="form-control" pattern=".{1,222}" maxlength="222" name="nomtit" value="{!! old('nomtit') !!}" required>
		</div>
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