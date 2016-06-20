<?php

namespace App\Http\Controllers;

use DB;
use App\asuntos;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class AsuntosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }       
    
    public function index(Request $request)
    {   
      $numpag = 30;

      $asuntos = DB::table('asuntos')
                  ->whereNull('deleted_at')
                  ->orderBy('nomasu', 'ASC')
                  ->paginate($numpag);
              
      return view('asun.index', [
        'asuntos' => $asuntos,
        'request' => $request
      ]);  
    }

    public function ver(Request $request)
    {   
      $busca = $request->input('busca');
    
      if ( isset($busca) ) {
        $busca = htmlentities (trim($busca),ENT_QUOTES,"UTF-8");      
        $asuntos = DB::table('asuntos')
                    ->where('nomasu','LIKE','%'.$busca.'%')
                    ->whereNull('deleted_at')
                    ->orderBy('nomasu','ASC')
                    ->get();
      } 
           
      return view('asun.ver', [
         'asuntos' => $asuntos,
         'request' => $request,
         'busca' => $busca 
      ]);   
    }
   
    public function show(Request $request,$idasu)
    { }

    public function create(Request $request)
    {
         return view('asun.create', [
            'request' => $request
         ]);  
    }

    public function store(Request $request)
    {
        $nomasu = ucfirst($request->input('nomasu'));
        $nomasu = htmlentities (trim($nomasu),ENT_QUOTES,"UTF-8");        

        $asuntos = asuntos::all();

        foreach ($asuntos as $asun) {
            if($asun->nomasu == $nomasu) {
                $messa = 'Repetido: '.$nomasu.', ya existe.';

                $request->session()->flash('errmess', $messa);

                return redirect('Asuntos/create')->withInput();
            }
        }

        $validator = Validator::make($request->all(),[
            'nomasu' => 'required|unique:asuntos|max:166',
        ]);

        if ($validator->fails()) {
            $messa = 'Repetido: '.$nomasu.', ya existe.';
            $request->session()->flash('errmess', $messa);

            return redirect("Asuntos/create")
                         ->withInput();
        } else { 
                            
            asuntos::create([
                'nomasu' => $nomasu
            ]);
              
            $request->session()->flash('sucmess', 'Hecho!!!');    
                            
            return redirect('Asuntos/create');
        }      
    }
  
    public function edit(Request $request,$idasu)
    {
         if ( empty($idasu) ) {
             return redirect('Asuntos');
         }
          
         $asunto = asuntos::find($idasu);
          
         return view('asun.edit', [
           'request' => $request,
           'asunto' => $asunto,
           'idasu' => $idasu
         ]);  
     }

    public function update(Request $request,$idasu)
    {
        if ( empty($idasu) ) {
            return redirect('Asuntos');
        }

        $nomasu = ucfirst($request->input('nomasu'));
        $nomasu = htmlentities (trim($nomasu),ENT_QUOTES,"UTF-8");

        $idasu = htmlentities (trim($idasu),ENT_QUOTES,"UTF-8");

        $asuntos = asuntos::all();

        foreach ($asuntos as $asun) {
            if($asun->nomasu == $nomasu) {
                $messa = 'Repetido: '.$nomasu.', ya existe.';

                $request->session()->flash('errmess', $messa);

                redirect("Asuntos/$idasu/edit")->withInput();
            }
        }

        $validator = Validator::make($request->all(),[
            'nomasu' => 'required|unique:asuntos|max:166'
        ]);
                      
        if ($validator->fails()) {
            $messa = 'Repetido: '.$nomasu.', ya existe.';
            $request->session()->flash('errmess', $messa);

            return redirect("Asuntos/$idasu/edit")
                         ->withInput();
        } else {   
          
            $asuntos = asuntos::find($idasu);
                    
            $nomasu = ucfirst($request->input('nomasu'));
            
            $asuntos->nomasu = htmlentities (trim($nomasu),ENT_QUOTES,"UTF-8");
            
            $asuntos->save();
      
            $request->session()->flash('sucmess', 'Hecho!!!');
                
            return redirect('Asuntos');
        }
    }
    
    public function del(Request $request,$idasu)
    {
         if ( empty($idasu) ) {
            return redirect('Asuntos');
         }

         $idasu = htmlentities (trim($idasu),ENT_QUOTES,"UTF-8");

         $asunto = asuntos::find($idasu);
            
         return view('asun.del', [
           'request' => $request,
           'asunto' => $asunto,
           'idasu' => $idasu
         ]);
    }
 
    public function destroy(Request $request,$idasu)
    {      
         if ( empty($idasu) ) {
            return redirect('Asuntos');
         }    
          
          $idasu = htmlentities (trim($idasu),ENT_QUOTES,"UTF-8");

          asuntos::destroy($idasu);
          
          return redirect('Asuntos');
    }
}
