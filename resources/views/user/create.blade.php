@extends('layouts.main')

@section('content')

@include('includes.usunav')

@include('includes.messages')
@include('includes.errors')


<div class="row">
	 <div class="col-sm-4 mar10">

	 	<p class="pad10"> Usuarios creados: </p>


		  <div class="panel panel-default">
		  
				   <table class="table">
					    <tr class="fonsi16">
						     <td class="wid95">Nombre</td>
						     <td class="wid95 textcent">Tipo</td>
					    </tr>
				   </table>
				   
				   <div class="box400">
						   <table class="table table-hover table-bordered">
						
								@foreach($users as $user)

									@continue($user->username == 'admin')
										
									<tr>
										<td class="wid95"> {!! $user->username !!} </td>
										 <td class="wid95 textcent">{!! $user->tipo !!}</td>
									</tr>
										
								@endforeach
								
							</table>
				  </div> 
		 </div>
	</div>


	<div class="col-sm-6 mar10"> 
  		<p class="pad10"> Crear Usuario: </p>
  	
	  	<form role="form" class="form" action="{!! url('/Usuarios') !!}" method="post">
		 	{!! csrf_field() !!}

		 	<div class="input-group">
		 	 	<span class="input-group-btn pad4"> <p> &nbsp; Usuario:</p> </span>
		 		<div class="col-sm-7">
		 			<input type="text" name="uname" class="form-control" placeholder="Usuario" required>
		 		</div>
		 	</div>

		 	<br>
		 	
		 	<div class="input-group">
		 		<span class="input-group-btn pad4"> <p> &nbsp; Contraseña:</p> </span>
		 		<div class="col-sm-7"> 
		 			<input type="text" name="passwd" class="form-control" placeholder="Contraseña" required>
		 		</div>
		 	</div>

		 	<br>

		 	<div class="form-group col-sm-7">
		      <label class="control-label text-left mar10">Selecciona tipo:</label>
		      <select name="tipo" class="form-control" required>
				@foreach($tipo as $val)
		      	  	<option value="{!!$val!!}">{!!$val!!}</option>
				@endforeach
		      </select>
		    </div>	

		@include('includes.subutton')

		</form>
	</div>
 
</div>
 
@endsection