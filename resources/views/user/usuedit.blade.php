@extends('layouts.main')

@section('content')

@include('includes.usunav')

@include('includes.messages')
@include('includes.errors')


 <div class="row">
   <div class="col-sm-12 mar10">
    <p class="pad10"> Cambiar contraseña: </p>

	 <form role="form" class="form" action="{!!url('/Usuarios/saveup')!!}" method="post">	
		  {!! csrf_field() !!}	 
		 
		 <div class="input-group">
		  	<span class="input-group-btn pad4"> <p> &nbsp; Usuario:</p> </span>
		   <div class="col-sm-3">
			    <select name="uid" class="form-control">
		 
						@foreach ($users as $user)
							   
							   <option value="{!!$user->uid!!}">{!!$user->username!!}</option> 
							
						@endforeach
						
			    </select>
		   </div>
		  </div>
		  
		  <br>
		  
		  <div class="input-group">
		    <span class="input-group-btn pad4"> <p> &nbsp; Contraseña nueva:</p> </span>
		    <div class="col-sm-3">
		    	<input type="text" name="passwd" class="form-control" placeholder="Contraseña" required>
		    </div>
		  </div>
		
		<br>
		
		 <div class="col-sm-3"> 
		 	<button class="btn btn-primary" type="submit"> Guardar &nbsp; 
		 		<i class="fa fa-arrow-circle-right"></i>
		 	</button>
		 </div>

	</form>

</div> </div>
 
 @endsection