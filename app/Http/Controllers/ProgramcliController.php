<?php

namespace App\Http\Controllers;

use DB;
use App\clientes;
use App\programas;
use App\programcli;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class ProgramcliController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }   

    public function index()
    { }

    public function create()
    { }

    public function crea(Request $request)
    {     
        $idcli = $request->input('idcli');

        if ( empty($idcli) ) {
            return redirect('Clientes');
        }
        
        $programas = DB::table('programas')->whereNull('deleted_at')->orderBy('nomprog', 'ASC')->get();

        $programcli = DB::table('programcli')
                        ->where('idcli',$idcli)
                        ->get();

        $programcli = array_column($programcli, 'idprog');

        $clientes = clientes::find($idcli);

        $apecli = $clientes->apecli;
        $nomcli = $clientes->nomcli;

        return view('progcli.crea', [
            'request' => $request,
            'programas' => $programas,
            'programcli' => $programcli,
            'idcli' => $idcli,
            'apecli' => $apecli,
            'nomcli' => $nomcli
        ]);
    }

    public function selcrea(Request $request)
    {     
        $idprog = $request->input('idprog');
        $idcli = $request->input('idcli');
        $apecli = $request->input('apecli');
        $nomcli = $request->input('nomcli');     

        $programa = programas::find($idprog);

        $especiali = DB::table('especiali')->where('nomesp','=','ninguna')->first();

        $especiprog = DB::table('especiprog')
                        ->join('especiali', 'especiprog.idesp','=','especiali.idesp')
                        ->select('especiprog.*','especiali.nomesp')
                        ->where('idprog',$idprog)
                        ->orderBy('nomesp', 'ASC')
                        ->get();
        
        return view('progcli.selcrea', [
            'request' => $request,
            'especiprog' => $especiprog,
            'especiali' => $especiali,
            'programa' => $programa,
            'idcli' => $idcli,
            'apecli' => $apecli,
            'nomcli' => $nomcli
        ]);
    }

    public function store(Request $request)
    {     
        $idcli = $request->input('idcli');

        if ( null == $idcli ) {
            return redirect('Clientes');
        }       
                  
        $validator = Validator::make($request->all(), [
            'idcli' => 'required',
            'idprog' => 'required',
            'idesp' => '',
            'feini' => 'required|date',
            'fefin' => 'required|date',
            'notas' => ''
        ]);

        if ($validator->fails()) {
            return redirect("/Clientes/$idcli")
                         ->withErrors($validator)
                         ->withInput();
        } else {

            $idcli = htmlentities (trim($request->input('idcli')),ENT_QUOTES,"UTF-8");
            $idprog = htmlentities (trim($request->input('idprog')),ENT_QUOTES,"UTF-8");
            $idesp = htmlentities (trim($request->input('idesp')),ENT_QUOTES,"UTF-8");
            $feini = htmlentities (trim($request->input('feini')),ENT_QUOTES,"UTF-8");
            $fefin = htmlentities (trim($request->input('fefin')),ENT_QUOTES,"UTF-8");
            $notas = htmlentities (trim($request->input('notas')),ENT_QUOTES,"UTF-8");

            programcli::create([
                'idcli' => $idcli,
                'idprog' => $idprog,
                'idesp' => $idesp,
                'feini' => $feini,
                'fefin' => $fefin,
                'notas' => $notas,
            ]);

            $request->session()->flash('sucmess', 'Hecho!!!');  
                            
            return redirect("/Clientes/$idcli");
        }     
    }

    public function show($id)
    { }
    
    public function edit(Request $request,$idcli,$idprocli)
    {
        if ( null === $idcli ) {
            return redirect('Pacientes');
        }
        
        if ( null === $idprocli ) {
            return redirect('Pacientes');
        }

        $idcli = htmlentities (trim($idcli),ENT_QUOTES,"UTF-8");
        $idprocli = htmlentities (trim($idprocli),ENT_QUOTES,"UTF-8");

        $programcli = DB::table('programcli')
                        ->join('programas', 'programcli.idprog','=','programas.idprog')
                        ->join('especiali', 'programcli.idesp','=','especiali.idesp')
                        ->select('programcli.*','programas.nomprog','especiali.nomesp')
                        ->where('programcli.idprocli',$idprocli)
                        ->whereNull('programas.deleted_at')
                        ->first();

        return view('progcli.edit', [
            'request' => $request,
            'programcli' => $programcli,
            'idcli' => $idcli,
            'idprocli' => $idprocli
        ]);
    }

    public function update(Request $request,$idprocli)
    {
        if ( null === $idprocli ) {
            return redirect('Clientes');
        }

        $idprocli = htmlentities(trim($idprocli),ENT_QUOTES,"UTF-8");
        $idcli = htmlentities(trim($request->input('idcli')),ENT_QUOTES,"UTF-8");

        if ( null === $idcli ) {
            return redirect('Clientes');
        }

        $validator = Validator::make($request->all(), [
            'feini' => 'required|date',
            'fefin' => 'required|date',
            'notas' => ''
        ]);
                       
        if ($validator->fails()) {
            return redirect("/Programcli/$idcli/$idprocli/edit")
                         ->withErrors($validator);
        } else {
            
            $notas = ucfirst($request->input('notas'));

            $feini = htmlentities(trim($request->input('feini')),ENT_QUOTES,"UTF-8");
            $fefin = htmlentities(trim($request->input('fefin')),ENT_QUOTES,"UTF-8");
            $notas = htmlentities(trim($notas),ENT_QUOTES,"UTF-8");
                               
            $programcli = programcli::find($idprocli);
            
            $programcli->feini = $feini;
            $programcli->fefin = $fefin;
            $programcli->notas = $notas;

            $programcli->save();

            $request->session()->flash('sucmess', 'Hecho!!!');

            return redirect("Clientes/$idcli");
        }   
    }

    public function del(Request $request,$idcli,$idprocli)
    {         
        $idprocli = htmlentities (trim($idprocli),ENT_QUOTES,"UTF-8");
        $idcli = htmlentities (trim($idcli),ENT_QUOTES,"UTF-8");

        if ( null === $idprocli ) {
            return redirect('Clientes');
        }

        if ( null === $idcli ) {
            return redirect('Clientes');
        }

        $programcli = DB::table('programcli')
                        ->join('programas', 'programcli.idprog','=','programas.idprog')
                        ->join('especiali', 'programcli.idesp','=','especiali.idesp')
                        ->select('programcli.*','programas.nomprog','especiali.nomesp')
                        ->where('programcli.idprocli',$idprocli)
                        ->whereNull('programas.deleted_at')
                        ->first();        

        return view('progcli.del', [
            'request' => $request,
            'programcli' => $programcli,
            'idprocli' => $idprocli,
            'idcli' => $idcli
        ]);
    }
 
    public function destroy(Request $request,$idprocli)
    {               
        $idprocli = htmlentities (trim($idprocli),ENT_QUOTES,"UTF-8");
        $idcli = htmlentities(trim($request->input('idcli')),ENT_QUOTES,"UTF-8");

        if ( null === $idprocli ) {
            return redirect('Clientes');
        }

        if ( null === $idcli ) {
            return redirect('Clientes');
        } 
        
        $idprocli = htmlentities(trim($idprocli),ENT_QUOTES,"UTF-8");

        $programcli = programcli::find($idprocli);
      
        $programcli->delete();

        $request->session()->flash('sucmess', 'Hecho!!!');
        
        return redirect("Clientes/$idcli");
    }
}
