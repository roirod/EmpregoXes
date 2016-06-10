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

        $cliente = DB::table('clientes')->where('idcli', $idcli)->first();

        $asunto = DB::table('asuntos')->orderBy('nomasu', 'ASC')->get();

        return view('regis.create', ['request' => $request,
                                     'idcli' => $idcli,
                                     'cliente' => $cliente,
                                     'asunto' => $asunto]);  
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
                'notas' => '']);
                       
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
                  'notas' => $notas]);
              
            $request->session()->flash('sucmess', 'Hecho!!!');  
                            
            return redirect("Regiscli/$idcli/create");
        }      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
