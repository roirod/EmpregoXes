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

    <p class="pad4">
        {!!$programa->nomser!!}
    </p>    

    <form role="form" id="form" class="form" action="{!!url('/Programcli')!!}" method="post">
        {!! csrf_field() !!}

        <input type="hidden" name="idcli" value="{!!$idcli!!}">
        <input type="hidden" name="idprog" value="{!!$programa->idprog!!}">

        <div class="form-group col-lg-6">
           
           <label class="control-label text-left mar10">Selecciona especialidad:</label> 
           
           <select name="idesp" class="form-control">

              @if($especiali->nomesp == 'ninguna')

                 <option value="{!!$especiali->idesp!!}" selected> {!!$especiali->nomesp!!} </option>

              @endif

              @foreach($especiprog as $espeprog)             

                    <option value="{!!$espeprog->idesp!!}"> {!!$espeprog->nomesp!!} </option>
                 
              @endforeach    
           
           </select>
        
        </div>
        
         <div class="form-group col-sm-4">
           <label class="control-label text-left mar10">Fecha inicio:</label>           
           <input type="date" pattern="[0-9]{4}[- /](0[1-9]|1[012])[-/](0[1-9]|1[0-9]|2[0-9]|3[01])" name="feini" value="{!!$programa->feini!!}" required > 
         </div>
         
         <div class="form-group col-sm-4">
           <div><label class="control-label text-left mar10">Fecha fin:</label> </div>      
            <input type="date" pattern="[0-9]{4}[- /](0[1-9]|1[012])[-/](0[1-9]|1[0-9]|2[0-9]|3[01])" name="fefin" value="{!!$programa->fefin!!}" required > 
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
	  <script type="text/javascript" src="{!! asset('assets/js/calcula.js') !!}"></script>
@endsection