<?php

namespace App\Http\Controllers;

use DB;
use App\titulos;
use App\clientes;
use App\titucli;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class TitucliController extends Controller
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

        $titulos = DB::table('titulos')->orderBy('nomtit', 'ASC')->get();

        return view('titucli.create', ['request' => $request,
                                     'idcli' => $idcli,
                                     'cliente' => $cliente,
                                     'titulos' => $titulos]);  
    }

    public function store(Request $request)
    {

        $idcli = $request->input('idcli');

        if ( empty($idcli) ) {
            return redirect('Clientes');
        }     

        $validator = Validator::make($request->all(),[
                'idcli' => 'required',
                'idtit' => 'required'
        ]);
                       
        if ($validator->fails()) {
             return redirect("Titucli/$idcli/create")
                         ->withErrors($validator)
                         ->withInput();
         } else {
            
            $idcli = htmlentities (trim($request->input('idcli')),ENT_QUOTES,"UTF-8");
            $idtit = htmlentities (trim($request->input('idtit')),ENT_QUOTES,"UTF-8");
                            
            titucli::create([
                  'idcli' => $idcli,
                  'idtit' => $idtit
            ]);
              
            $request->session()->flash('sucmess', 'Hecho!!!');  
                            
            return redirect("Titucli/$idcli/create");
        }      
    }


    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request,$id)
    {
    }

    public function destroy(Request $request,$id)
    {
        if ( empty($id) ) {
            return redirect('Clientes');
        }    
        
        $titucli = titucli::find($id);
      
        $titucli->delete();

        return redirect()->back();
    }
}
