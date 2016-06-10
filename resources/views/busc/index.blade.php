@extends('layouts.main')

@section('content')

@include('includes.messages')
@include('includes.errors')

<div class="row">
	<div class="col-sm-12">
	  <div class="input-group">
		   <span class="input-group-btn pad4"> <p> Buscar títulos de los clientes:</p> </span>
	  </div>
 	</div>
</div>
	
<div class="row">
 <div class="col-sm-12 mar10">

    <form role="form" class="form" action="{!!url('/Buscador/ver')!!}" method="post">
	    
	    {!! csrf_field() !!}

		<div class="form-group col-lg-6">
		   
		   <label class="control-label text-left mar10">Selecciona título/s:</label> 
		   <br>
		   Para seleccionar varios mantén pulsado Ctrl
		   
		   <select name="selarr[]" class="form-control" style="height:200px;" multiple="multiple" required="required">

			     @foreach($titulos as $titu)

					<option value="{!!$titu->idtit!!}"> {!!$titu->nomtit!!} </option>
			 	 
			 	 @endforeach	
		   
		   </select>
		
		</div>
			
		<br>
		<div class="form-group">
		  	<div class="col-sm-12 text-left">
		  		<button type="submit" class="text-left btn btn-primary btn-md">
		   			<i class="fa fa-search"></i> Buscar
		   	</button>
			</div>
		</div>

	</form>

 </div>
</div>

@endsection