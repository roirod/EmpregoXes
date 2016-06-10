<?php

namespace App\Http\Controllers;

use DB;
use App\programas;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;


class ProgramasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }    	
	
    public function index(Request $request)
    {  	
    	$numpag = 30;

    	$programas = DB::table('programas')->orderBy('nomprog', 'DESC')->paginate($numpag);
	          
        return view('prog.index', [
			'programas' => $programas,
      		'request' => $request
      	]);  
    }
  
    public function ver(Request $request)
    {  	
    	$busca = $request->input('busca');
   	
	  	if ( isset($busca) ) {
		  $busca = htmlentities (trim($busca),ENT_QUOTES,"UTF-8"); 		  
  		  $programas = DB::table('programas')->where('nomprog','LIKE','%'.$busca.'%')->orderBy('nomprog','DESC')->get();
  		} 
  		     
        return view('prog.ver', [
            'programas' => $programas,
            'busca' => $busca,
      		'request' => $request,
        ]);   
    }   

    public function show(Request $request,$idprog)
    {    	    
        if ( empty($idprog) ) {
          return redirect('Programas');
        } 

        $idprog = htmlentities (trim($idprog),ENT_QUOTES,"UTF-8");

        $programa =	DB::table('programas')->where('idprog',$idprog)->first();

        $especiprog = DB::table('especiprog')
            ->join('especiali', 'especiprog.idesp','=','especiali.idesp')
            ->select('especiprog.*','especiali.nomesp')
            ->where('idprog',$idprog)
            ->orderBy('nomesp', 'ASC')
            ->get();

	    $programcli = DB::table('programcli')
            ->join('clientes', 'programcli.idcli','=','clientes.idcli')
            ->join('especiali', 'programcli.idesp','=','especiali.idesp')
            ->select('programcli.*', 'clientes.apecli', 'clientes.nomcli', 'especiali.nomesp')
            ->where('idprog',$idprog)
            ->orderBy('feini', 'ASC')
            ->get();										 													
	    	          
        return view('prog.show', [
            'request' => $request,
            'programa' => $programa,
            'especiprog' => $especiprog,
        	'programcli' => $programcli,
	        'idprog' => $idprog
        ]);       
    }

    public function create(Request $request)
    {
		  return view('prog.create', ['request' => $request]);	
    }

    public function store(Request $request)
    {
        $nomprog = htmlentities (trim($request->input('nomprog')),ENT_QUOTES,"UTF-8");

        $programas = programas::all();

        foreach ($programas as $program) {
            if($program->nomprog == $nomprog) {
                $request->session()->flash('errmess', "Repetido. El nombre -- $nomprog -- ya está en uso.");
                return redirect('Programas/create');
            }
        }

        $validator = Validator::make($request->all(),[
    		'nomprog' => 'required|unique:programas|max:166',
            'feini' => 'required|date',
            'fefin' => 'required|date',
            'notas' => ''
        ]);
	                   
        if ($validator->fails()) {
	         return redirect('Programas/create')
	                     ->withErrors($validator)
	                     ->withInput();
	     } else {
        	
        	$nomprog = ucfirst(strtolower( $request->input('nomprog') ) );
        	$notas = ucfirst(strtolower( $request->input('notas') ) );
        	
			$nomprog = htmlentities (trim($nomprog),ENT_QUOTES,"UTF-8");
			$feini = htmlentities (trim($request->input('feini')),ENT_QUOTES,"UTF-8");
			$fefin = htmlentities (trim($request->input('fefin')),ENT_QUOTES,"UTF-8");
			$notas = htmlentities (trim($notas),ENT_QUOTES,"UTF-8");
	        	        	
		    programas::create([
		        'nomprog' => $nomprog,
		        'feini' => $feini,
		        'fefin' => $fefin,
		        'notas' => $notas
            ]);
		      
		    $request->session()->flash('sucmess', 'Hecho!!!');	
	        	        	
	        return redirect('Programas/create');
        }      
    }
  
    public function edit(Request $request,$idprog)
    {
        if ( empty($idprog) ) {
            return redirect('Programas');
        }

        $idprog = htmlentities (trim($idprog),ENT_QUOTES,"UTF-8");  
	   
		$programa = programas::find($idprog);
		
		return view('prog.edit', [
			 'request' => $request,
			 'programa' => $programa,
			 'idprog' => $idprog
		]);
	   
	 }
 
    public function update(Request $request,$idprog)
    {
        if ( empty($idprog) ) {
            return redirect('Programas');
        }

        $idprog = htmlentities(trim($idprog),ENT_QUOTES,"UTF-8");
        $nomprog = htmlentities(trim($request->input('nomprog')),ENT_QUOTES,"UTF-8");

        $programas = programas::all();

        $progra = programas::find($idprog);

        if($progra->nomprog == $nomprog) {

        } else {
            
            foreach ($programas as $program) {
                if($program->nomprog == $nomprog) {
                    $request->session()->flash('errmess', "Repetido. El nombre -- $nomprog -- ya está en uso.");
                    return redirect("Programas/$idprog/edit");
                }
            }
        }

        $validator = Validator::make($request->all(),[
            'nomprog' => 'required|max:166',
            'feini' => 'required|date',
            'fefin' => 'required|date',
            'notas' => ''
        ]);  		
	     
        if ($validator->fails()) {
             return redirect("Programas/$idprog/edit")
                         ->withErrors($validator)
                         ->withInput();
        } else {
    		
    		$idprog = htmlentities (trim($idprog),ENT_QUOTES,"UTF-8");
    		
    		$programas = programas::find($idprog);
    		  		
        	$nomprog = ucfirst(strtolower( $request->input('nomprog') ) );
        	$notas = ucfirst(strtolower( $request->input('notas') ) );
        	
			$programas->nomprog = htmlentities (trim($nomprog),ENT_QUOTES,"UTF-8");
			$programas->feini = htmlentities (trim($request->input('feini')),ENT_QUOTES,"UTF-8");
            $programas->fefin = htmlentities (trim($request->input('fefin')),ENT_QUOTES,"UTF-8");
            $programas->notas = htmlentities (trim($notas),ENT_QUOTES,"UTF-8");
			
			$programas->save();
      
	      $request->session()->flash('sucmess', 'Hecho!!!');
	        	
	      return redirect('Programas');
	    }   
    }
    
    public function del(Request $request,$idprog)
    {
        if ( empty($idprog) ) {
            return redirect('Programas');
        }   
    	
        $idprog = htmlentities (trim($idprog),ENT_QUOTES,"UTF-8");

    	return view('prog.del', [
			'request' => $request,
			'idprog' => $idprog							   
		]);
    }
 
    public function destroy(Request $request,$idprog)
    {      
        if ( empty($idprog) ) {
            return redirect('Programas');
        }      
        
        $idprog = htmlentities (trim($idprog),ENT_QUOTES,"UTF-8");
        
        $programas = programas::find($idprog);
      
        $programas->delete();
        
        return redirect('Programas');
    }
}
