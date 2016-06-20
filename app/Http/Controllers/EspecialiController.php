<?php

namespace App\Http\Controllers;

use DB;
use App\especiali;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class EspecialiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }       
    
    public function index(Request $request)
    {   
        $numpag = 30;

        $especiali = DB::table('especiali')
                        ->whereNull('deleted_at')
                        ->orderBy('nomesp', 'ASC')
                        ->paginate($numpag);
              
        return view('espe.index', [
            'especiali' => $especiali,
            'request' => $request
        ]);  
    }
    
    public function ver(Request $request)
    {  	
    	$busca = $request->input('busca');
   	
	  	if ( isset($busca) ) {
		    $busca = htmlentities (trim($busca),ENT_QUOTES,"UTF-8"); 		  
  		    $especiali = DB::table('especiali')->where('nomesp','LIKE','%'.$busca.'%')->whereNull('deleted_at')->orderBy('nomesp','ASC')->get();
  		} 
  		     
        return view('espe.ver', [
          'especiali' => $especiali,
         	'request' => $request,
          'busca' => $busca 
        ]);     
    }  
       
    public function show(Request $request)
    { }

    public function create(Request $request)
    {
        return view('espe.create', ['request' => $request]);  
    }

    public function store(Request $request)
    {
        $nomesp = ucfirst($request->input('nomesp'));
        $nomesp = htmlentities(trim($nomesp),ENT_QUOTES,"UTF-8");

        $especiali = DB::table('especiali')->orderBy('nomesp','ASC')->get();

        foreach ($especiali as $especia) {
             if ( $nomesp == $especia->nomesp ) {
                $messa = 'Repetido: '.$nomesp.', ya existe.';

                $request->session()->flash('errmess', $messa);

                return redirect('Especiali/create')->withInput();          
             }
        }

        $validator = Validator::make($request->all(),[
            'nomesp' => 'required|unique:especiali|max:166'
        ]);

        if ($validator->fails()) {
            $messa = 'Repetido: '.$nomesp.', ya existe.';
            $request->session()->flash('errmess', $messa);

            return redirect("Especiali/create")
                         ->withInput();
        } else {  

             especiali::create([
               'nomesp' => $nomesp
             ]);
                 
             $request->session()->flash('sucmess', 'Hecho!!!');    
                               
             return redirect('Especiali/create');
        }  
    }
  
    public function edit(Request $request,$idesp)
    {  
       	if ( empty($idesp) ) {
      	  	return redirect('Clientes');
      	}   

        $idesp = htmlentities (trim($idesp),ENT_QUOTES,"UTF-8"); 
 
        $especiali = especiali::find($idesp);
        
        return view('espe.edit', [
             'request' => $request,
             'especiali' => $especiali,
             'idesp' => $idesp
        ]);
     }

 
    public function update(Request $request,$idesp)
    {
     	  if ( empty($idesp) ) {
    	  	return redirect('Clientes');
        }   

        $idesp = htmlentities (trim($idesp),ENT_QUOTES,"UTF-8"); 

        $nomesp = ucfirst($request->input('nomesp'));
        $nomesp = htmlentities(trim($nomesp),ENT_QUOTES,"UTF-8");

        $especiali = DB::table('especiali')->orderBy('nomesp','ASC')->get();

        foreach ($especiali as $especia) {
             if ( $nomesp == $especia->nomesp ) {
                $messa = 'Repetido: '.$nomesp.', ya existe.';

                $request->session()->flash('errmess', $messa);

                return redirect("Especiali/$idesp/edit")->withInput();          
             }
        }
 
        $validator = Validator::make($request->all(),[
            'nomesp' => 'required|unique:especiali|max:166'
        ]);

        if ($validator->fails()) {
            $messa = 'Repetido: '.$nomesp.', ya existe.';
            $request->session()->flash('errmess', $messa);

            return redirect("Especiali/$idesp/edit")
                         ->withInput();
        } else {           
                    
            $especiali = especiali::find($idesp);
                    
            $nomesp = ucfirst($request->input('nomesp'));
                        
            $especiali->nomesp = htmlentities (trim($nomesp),ENT_QUOTES,"UTF-8");
            
            $especiali->save();
      
            $request->session()->flash('sucmess', 'Hecho!!!');
                  
            return redirect('Especiali');
        }    
    }
    
    public function del(Request $request,$idesp)
    {
        if ( empty($idesp) ) {
    	  	return redirect('Clientes');
        }       

        $idesp = htmlentities (trim($idesp),ENT_QUOTES,"UTF-8");

        $especiali = especiali::find($idesp);  
        
        return view('espe.del', [
            'request' => $request,
            'especiali' => $especiali,
            '$idesp' => $idesp
        ]);
    }
 
    public function destroy(Request $request,$idesp)
    {      
      	if ( empty($idesp) ) {
      	  	return redirect('Clientes');
      	}   

        $idesp = htmlentities (trim($idesp),ENT_QUOTES,"UTF-8");

        especiali::destroy($idesp);
        
        $request->session()->flash('sucmess', 'Hecho!!!');
        
        return redirect('Especiali');
    }
}
