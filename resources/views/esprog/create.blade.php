@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.prognav')

@include('includes.messages')
@include('includes.errors')



{!! addtexto("Añadir Especialidades, acciones al programa") !!}

  
<div class="row">
  <div class="col-sm-12">

	<p class="pad10">
		{!!$programa->nomprog!!}
	</p>
	<br>

    <form role="form" id="form" class="form" action="{!! url('/Especiprog') !!}" method="post">
    
	    {!! csrf_field() !!}

	    <input type="hidden" name="idprog" value="{!!$idprog!!}">
	    
	    <div class="form-group col-sm-6">
	      <label class="control-label text-left mar10">Selecciona Especialidad:</label>
	      
	      <select name="idesp" class="form-control" required>

			@foreach($especiali as $item)

				@continue($item->nomesp == 'ninguna')
				
				@if(!in_array($item->idesp, $especiprog))

					<option value="{!!$item->idesp!!}"> {!! $item->nomesp !!} </option>

				@endif

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