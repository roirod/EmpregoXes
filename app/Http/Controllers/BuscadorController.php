<?php

namespace App\Http\Controllers;

use DB;
use App\programas;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class BuscadorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }       
    
    public function index(Request $request)
    {         
        $titulos = DB::table('titulos')->orderBy('nomtit', 'ASC')->get();

        return view('busc.index', [
            'request' => $request,
            'titulos' => $titulos
        ]);  
    }
  
    public function ver(Request $request)
    {   
        $selarr = $request->input('selarr.*');

        $count = count($selarr);

        $strin = '';

        if ( count($selarr) > 0 ) {
            foreach ($selarr as $clasel => $valsel) {
                if ($clasel == 0) {
                    $strin .= "idtit=$valsel";
                } else {
                    $strin .= " OR idtit=$valsel";
                } 
            } 
        }

        $titulos = DB::table('titulos')->orderBy('nomtit', 'ASC')->get();

        $clientes = DB::table('titucli')
                ->join('clientes', 'titucli.idcli','=','clientes.idcli')
                ->select('titucli.*','clientes.*')
                ->whereRaw("($strin)")
                ->whereNull('clientes.deleted_at')
                ->groupBy('titucli.idcli')
                ->havingRaw("COUNT(*) = $count")
                ->get();

        $titarr = array();
    
        if ( count($selarr) > 0 ) {
            foreach ($selarr as $sela) {
                foreach ($titulos as $titu) {
                    if ($sela == $titu->idtit) {
                        $titarr[] = $titu->nomtit;
                    }
                }
            }
        } 
             
        return view('busc.ver', [
            'request' => $request,
            'titarr' => $titarr,
            'titulos' => $titulos,
            'clientes' => $clientes
        ]);   
    }  
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
