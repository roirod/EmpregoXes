@extends('layouts.main')

@include('includes.other')

@section('content')

@include('includes.messages')
@include('includes.errors')


{!! addtexto("Añadir Programa") !!}

  
<div class="row">
  <div class="col-sm-12">
    <form role="form" id="form" class="form" action="{!! url('/Programas') !!}" method="post">
        {!! csrf_field() !!}
        
        <div class="form-group col-sm-5">
          <label class="control-label text-left mar10">Nombre:</label>
    	   <input type="text" class="form-control" pattern=".{1,166}" maxlength="166" name="nomprog" value="{!! old('nomprog') !!}" required>
    	 </div>
    		 	
    	 <div class="form-group col-sm-4">
    	   <label class="control-label text-left mar10">Fecha inicio:</label>		 	
      		<input type="date" pattern="[0-9]{4}[- /](0[1-9]|1[012])[-/](0[1-9]|1[0-9]|2[0-9]|3[01])" name="feini" value="{!!old('feini')!!}" required > 
      	 </div>
      	 
      	 <div class="form-group col-sm-4">
    	   <div><label class="control-label text-left mar10">Fecha fin:</label>	</div>	 	
      		<input type="date" pattern="[0-9]{4}[- /](0[1-9]|1[012])[-/](0[1-9]|1[0-9]|2[0-9]|3[01])" name="fefin" value="{!!old('fefin')!!}" required > 
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