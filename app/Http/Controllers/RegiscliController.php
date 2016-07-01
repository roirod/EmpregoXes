<?php

namespace App\Http\Controllers;

use DB;
use App\regiscli;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class RegiscliController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }   

    public function index()
    {  }

    public function create(Request $request,$idcli)
    {         
        if ( empty($idcli) ) {
            return redirect('Clientes');
        }        

        $asunto = DB::table('asuntos')->whereNull('deleted_at')->orderBy('nomasu', 'ASC')->get();

        return view('regis.create', [
            'request' => $request,
            'idcli' => $idcli,
            'asunto' => $asunto
        ]);  
    }

    public function store(Request $request)
    {
        $idcli = $request->input('idcli');

        if ( empty($idcli) ) {
            return redirect('Clientes');
        }     

        $validator = Validator::make($request->all(),[
            'idcli' => 'required',
            'idasu' => 'required',
            'fech' => 'required|date',
            'notas' => ''
        ]);
                       
        if ($validator->fails()) {
             return redirect("Regiscli/$idcli/create")
                         ->withErrors($validator)
                         ->withInput();
         } else {
            
            $notas = ucfirst(strtolower( $request->input('notas') ) );

            $idcli = htmlentities (trim($request->input('idcli')),ENT_QUOTES,"UTF-8");
            $idasu = htmlentities (trim($request->input('idasu')),ENT_QUOTES,"UTF-8");
            $fech = htmlentities (trim($request->input('fech')),ENT_QUOTES,"UTF-8");
            $notas = htmlentities (trim($notas),ENT_QUOTES,"UTF-8");
                            
            regiscli::create([
                'idcli' => $idcli,
                'idasu' => $idasu,
                'fech' => $fech,
                'notas' => $notas
            ]);
              
            $request->session()->flash('sucmess', 'Hecho!!!');  
                            
            return redirect("Regiscli/$idcli/create");
        }      
    }

    public function show($id)
    { }

    public function edit(Request $request,$idcli,$idregcli)
    {
        if ( null === $idcli ) {
            return redirect('Clientes');
        }
        
        if ( null === $idregcli ) {
            return redirect('Clientes');
        }

        $idcli = htmlentities (trim($idcli),ENT_QUOTES,"UTF-8");
        $idregcli = htmlentities (trim($idregcli),ENT_QUOTES,"UTF-8");

        $regiscli = DB::table('regiscli')
                        ->join('asuntos', 'regiscli.idasu', '=', 'asuntos.idasu')
                        ->select('regiscli.*', 'asuntos.nomasu')
                        ->where('idregcli',$idregcli)
                        ->whereNull('asuntos.deleted_at')
                        ->first();        

        return view('regis.edit', [
            'request' => $request,
            'regiscli' => $regiscli,
            'idregcli' => $idregcli,
            'idcli' => $idcli
        ]);
    }

    public function update(Request $request,$idregcli)
    {
        if ( null === $idregcli ) {
            return redirect('Clientes');
        }

        $idregcli = htmlentities(trim($idregcli),ENT_QUOTES,"UTF-8");
        $idcli = htmlentities(trim($request->input('idcli')),ENT_QUOTES,"UTF-8");

        if ( null === $idcli ) {
            return redirect('Clientes');
        }

        $validator = Validator::make($request->all(),[
            'idcli' => 'required',
            'fech' => 'required|date',
            'notas' => ''
        ]);
                       
        if ($validator->fails()) {
            return redirect("/Regiscli/$idcli/$idregcli/edit")
                         ->withErrors($validator)
                         ->withInput();
        } else {
            
            $notas = ucfirst($request->input('notas'));

            $fech = htmlentities(trim($request->input('fech')),ENT_QUOTES,"UTF-8");
            $notas = htmlentities(trim($notas),ENT_QUOTES,"UTF-8");
                               
            $regiscli = regiscli::find($idregcli);
            
            $regiscli->fech = $fech;
            $regiscli->notas = $notas;

            $regiscli->save();

            $request->session()->flash('sucmess', 'Hecho!!!');

            return redirect("Clientes/$idcli");
        }   
    }

    public function del(Request $request,$idcli,$idregcli)
    {         
        $idregcli = htmlentities (trim($idregcli),ENT_QUOTES,"UTF-8");
        $idcli = htmlentities (trim($idcli),ENT_QUOTES,"UTF-8");

        if ( null === $idregcli ) {
            return redirect('Clientes');
        }

        if ( null === $idcli ) {
            return redirect('Clientes');
        }

        $regiscli = DB::table('regiscli')
                        ->join('asuntos', 'regiscli.idasu', '=', 'asuntos.idasu')
                        ->select('regiscli.*', 'asuntos.nomasu')
                        ->where('idregcli',$idregcli)
                        ->whereNull('asuntos.deleted_at')
                        ->first(); 

        return view('regis.del', [
            'request' => $request,
            'regiscli' => $regiscli,
            'idregcli' => $idregcli,
            'idcli' => $idcli
        ]);
    }
 
    public function destroy(Request $request,$idregcli)
    {               
        $idregcli = htmlentities (trim($idregcli),ENT_QUOTES,"UTF-8");
        $idcli = htmlentities(trim($request->input('idcli')),ENT_QUOTES,"UTF-8");

        if ( null === $idregcli ) {
            return redirect('Clientes');
        }

        if ( null === $idcli ) {
            return redirect('Clientes');
        } 
        
        $idregcli = htmlentities(trim($idregcli),ENT_QUOTES,"UTF-8");

        $regiscli = regiscli::find($idregcli);
      
        $regiscli->delete();

        $request->session()->flash('sucmess', 'Hecho!!!');
        
        return redirect("Clientes/$idcli");
    }
}
