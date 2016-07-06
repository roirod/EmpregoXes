<?php

namespace App\Http\Controllers;

use DB;

use App\programas;
use App\especiprog;

use Validator;

use Illuminate\Http\Request;
use App\Http\Requests;

class EspeciprogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }   

    public function index()
    {  }

    public function create(Request $request,$idprog)
    {         
        if ( empty($idprog) ) {
            return redirect('Programas');
        }     

        $idprog = htmlentities (trim($idprog),ENT_QUOTES,"UTF-8");   

        $programa = DB::table('programas')->where('idprog', $idprog)->first();

        $especiali = DB::table('especiali')->whereNull('deleted_at')->orderBy('nomesp', 'ASC')->get();

        $especiprog = DB::table('especiprog')
                        ->where('idprog',$idprog)
                        ->get();

        $especiprog = array_column($especiprog, 'idesp');

        return view('esprog.create', [
            'request' => $request,
            'idprog' => $idprog,
            'especiali' => $especiali,
            'especiprog' => $especiprog,
            'programa' => $programa
        ]);  
    }

    public function store(Request $request)
    {

        $idprog = $request->input('idprog');

        if ( empty($idprog) ) {
            return redirect('Programas');
        }     

        $validator = Validator::make($request->all(),[
                'idprog' => 'required',
                'idesp' => 'required'
        ]);
                       
        if ($validator->fails()) {
             return redirect("Especiprog/$idprog/create")
                         ->withErrors($validator)
                         ->withInput();
        } else {
            
            $idprog = htmlentities (trim($request->input('idprog')),ENT_QUOTES,"UTF-8");
            $idesp = htmlentities (trim($request->input('idesp')),ENT_QUOTES,"UTF-8");
                            
            especiprog::create([
                  'idprog' => $idprog,
                  'idesp' => $idesp
            ]);
              
            $request->session()->flash('sucmess', 'Hecho!!!');  
                            
            return redirect("Especiprog/$idprog/create");
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
            return redirect('Programas');
        }

        $id = htmlentities (trim($id),ENT_QUOTES,"UTF-8");
        
        $especiprog = especiprog::find($id);
      
        $especiprog->delete();

        return redirect()->back();
    }
}
