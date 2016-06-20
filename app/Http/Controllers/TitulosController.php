<?php

namespace App\Http\Controllers;

use DB;
use App\titulos;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class TitulosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }       
    
    public function index(Request $request)
    {   
        $numpag = 50;

        $titulos = DB::table('titulos')->whereNull('deleted_at')->orderBy('nomtit', 'ASC')->paginate($numpag);
              
        return view('titu.index', [
            'titulos' => $titulos,
            'request' => $request
        ]);  
    }

    public function ver(Request $request)
    {   
        $busca = $request->input('busca');
    
        if ( isset($busca) ) {
          $busca = htmlentities (trim($busca),ENT_QUOTES,"UTF-8");     
          $titulos = DB::table('titulos')->where('nomtit','LIKE','%'.$busca.'%')->whereNull('deleted_at')->orderBy('nomtit','ASC')->get();
        } 
                          
        return view('titu.ver', [
            'titulos' => $titulos,
            'request' => $request,
            'busca' => $busca 
        ]);  
    }    
   
    public function show(Request $request,$idtit)
    { }

    public function create(Request $request)
    {
        return view('titu.create', [
            'request' => $request
        ]);  
    }

    public function store(Request $request)
    {
        $nomtit = ucfirst($request->input('nomtit'));
        $nomtit = htmlentities (trim($nomtit),ENT_QUOTES,"UTF-8"); 

        $titulos = titulos::all();

        foreach ($titulos as $titu) {
            if($titu->nomtit == $nomtit) {
                $messa = 'Repetido: '.$nomtit.', ya existe.';

                $request->session()->flash('errmess', $messa);

                return redirect('Titulos/create')->withInput();
            }
        }

        $validator = Validator::make($request->all(),[
            'nomtit' => 'required|unique:titulos|max:166'
        ]);

        if ($validator->fails()) {
            $messa = 'Repetido: '.$nomtit.', ya existe.';
            $request->session()->flash('errmess', $messa);

            return redirect("Titulos/create")
                         ->withInput();
        } else { 
                            
            titulos::create([
                'nomtit' => $nomtit
            ]);
              
            $request->session()->flash('sucmess', 'Hecho!!!');    
                            
            return redirect('Titulos/create');
        }      
    }
  
    public function edit(Request $request,$idtit)
    {
        $idtit = htmlentities (trim($idtit),ENT_QUOTES,"UTF-8"); 
       
        $titulo = titulos::find($idtit);
       
        return view('titu.edit', [
            'request' => $request,
            'titulo' => $titulo,
            'idtit' => $idtit
        ]);   
     }
 
    public function update(Request $request,$idtit)
    {
        $nomtit = ucfirst($request->input('nomtit'));
        $nomtit = htmlentities (trim($nomtit),ENT_QUOTES,"UTF-8");  

        $idtit = htmlentities (trim($idtit),ENT_QUOTES,"UTF-8"); 

        $titulos = titulos::all();

        foreach ($titulos as $titu) {
            if($titu->nomtit == $nomtit) {
                $messa = 'Repetido: '.$nomtit.', ya existe.';

                $request->session()->flash('errmess', $messa);

                return redirect("Titulos/$idtit/edit")->withInput();
            }
        }

        $validator = Validator::make($request->all(),[
            'nomtit' => 'required|unique:titulos|max:166'
        ]);

        if ($validator->fails()) {
            $messa = 'Repetido: '.$nomtit.', ya existe.';
            $request->session()->flash('errmess', $messa);

            return redirect("Titulos/$idtit/edit")
                         ->withInput();
        } else {         
                                
            $titulos = titulos::find($idtit);
                    
            $nomtit = ucfirst(strtolower( $request->input('nomtit') ) );
            
            $titulos->nomtit = htmlentities (trim($nomtit),ENT_QUOTES,"UTF-8");
            
            $titulos->save();
      
            $request->session()->flash('sucmess', 'Hecho!!!');
                
            return redirect('Titulos');
        }  
    }
    
    public function del(Request $request,$idtit)
    {      
        if ( empty($idtit) ) {
            return redirect('Clientes');
        }

        $idtit = htmlentities (trim($idtit),ENT_QUOTES,"UTF-8");

        $titulo = titulos::find($idtit);

        return view('titu.del', [
            'request' => $request,
            'titulo' => $titulo,
            'idtit' => $idtit
        ]);
    }
 
    public function destroy(Request $request,$idtit)
    {      
        $idtit = htmlentities (trim($idtit),ENT_QUOTES,"UTF-8");  

        titulos::destroy($idtit);  
        
        return redirect('Titulos');
    }
}
