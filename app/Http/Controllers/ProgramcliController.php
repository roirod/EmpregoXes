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
    {
    }

    public function create()
    {
    }

    public function crea(Request $request)
    {     
        $idcli = $request->input('idcli');

        if ( empty($idcli) ) {
            return redirect('Clientes');
        }
        
        $programas = DB::table('programas')->orderBy('nomprog', 'ASC')->get();
        $clientes = clientes::find($idcli);

        $apecli = $clientes->apecli;
        $nomcli = $clientes->nomcli;

        return view('progcli.crea', [
            'request' => $request,
            'programas' => $programas,
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
    {
        //
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
