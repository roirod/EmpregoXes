@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.clinav')

@include('includes.messages')
@include('includes.errors')


<?php
 addtexto("Añadir Títulos al cliente");
?>
  
<div class="row">
  <div class="col-sm-12">

	<p class="pad10">
		{!!$cliente->apecli!!}, {!!$cliente->nomcli!!}
	</p>
	<br>

    <form role="form" id="form" class="form" action="{!! url('/Titucli') !!}" method="post">
    {!! csrf_field() !!}

    <input type="hidden" name="idcli" value="{!!$idcli!!}">
    
    <div class="form-group col-sm-6">
      <label class="control-label text-left mar10">Selecciona Título:</label>
      <select name="idtit" class="form-control" required>
		@foreach($titulos as $titu)
      	  	<option value="{!!$titu->idtit!!}">{!!$titu->nomtit!!}</option>
		@endforeach
      </select>
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