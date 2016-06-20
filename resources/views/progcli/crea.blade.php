@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.clinav')

@include('includes.messages')
@include('includes.errors')


 {!! addtexto("Añadir cliente a un programa") !!}


<div class="row">
 <div class="col-sm-12 mar10">

 	<div class="pad4">
 		{!!$apecli!!}, {!!$nomcli!!}  |  id: {!!$idcli!!}
 	</div>
 	<hr>

    <form role="form" id="form" class="form" action="{!!url('/Programcli/selcrea')!!}" method="post">
	    
	    {!! csrf_field() !!}

		<input type="hidden" name="idcli" value="{!!$idcli!!}">
		<input type="hidden" name="apecli" value="{!!$apecli!!}">
		<input type="hidden" name="nomcli" value="{!!$nomcli!!}">

		<div class="form-group col-lg-6">
		   
		   <label class="control-label text-left mar10">Selecciona programa:</label> 
		   
		   <select name="idprog" class="form-control" required>
		   
			     <option value="" selected> </option>

			     @foreach($programas as $programa)

					<option value="{!!$programa->idprog!!}"> {!!$programa->nomprog!!} </option>
			 	 
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
	  <script type="text/javascript" src="{!! asset('assets/js/areyousure.js') !!}"></script>
	  <script type="text/javascript" src="{!! asset('assets/js/guarda.js') !!}"></script>
@endsection