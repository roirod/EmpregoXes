<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use DB;
use Validator;

use Illuminate\Http\Request;
use App\Http\Requests;

class UsuariosController extends Controller
{
	
    public function __construct()
    {
        $this->middleware('auth');
    }    	
	
    public function index(Request $request)
    {  }
    
    public function create(Request $request)
    {
         $users = DB::table('users')->orderBy('username','ASC')->get();
         
         $tipo = ["normal","medio"];

    	   return view('user.create', [
            'request' => $request,
            'users' => $users,
            'tipo' => $tipo
         ]);	
    }    

    public function store(Request $request)
    {
    	  $users = DB::table('users')->get();
    	  
    	  $passwd = trim( $request->input('passwd') );
    	  $uname = htmlentities (trim($request->input('uname')),ENT_QUOTES,"UTF-8");
        $tipo = htmlentities (trim($request->input('tipo')),ENT_QUOTES,"UTF-8");
    	  
    	  foreach ($users as $user) {
    	  	 if ($user->username == $uname) {
    	  	 	$request->session()->flash('errmess', 'Nombre de usuario en uso, use cualquier otro.');
    	  	 	return redirect('Usuarios/create');
    	  	 }
    	  }	 
    	 	
        $validator = Validator::make($request->all(),[
        		'uname' => 'required|max:44',
	         'passwd' => 'required|max:44',
            'tipo' => 'required|max:44'
	     ]);
            
        if ($validator->fails()) {
	         return redirect('/Usuarios/create')
	                     ->withErrors($validator)
	                     ->withInput();
	     } else {
	     		
		    	if ( $uname == 'admin' ) {
		    		$request->session()->flash('errmess', 'Nombre de usuario no permitido, use cualquier otro.');	
		    	  	return redirect('Usuarios/create');
		    	}	     		
	        	     	        	
		      User::create([
		          'username' => $uname,
		          'password' => bcrypt($passwd),
                'tipo' => $tipo
            ]);
		      
		      $request->session()->flash('sucmess', 'Hecho!!!');	
	        	        	
	        	return redirect('Usuarios/create');
        }      
    }
    
    public function usuedit(Request $request)
    {
		   $users = DB::table('users')->get();

		   return view('user.usuedit', [
            'request' => $request,
            'users' => $users
         ]);  
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
    
    
    public function saveup(Request $request)
    {	  
		  $uid = $request->input('uid');
		  $passwd = $request->input('passwd');
		  
		  $User = User::find($uid);
		  
		  $User->passwd = bcrypt($passwd);
		  
		  $User->save();
		  
		  $request->session()->flash('sucmess', 'Hecho!!!');
		        	
		  return redirect('/Config');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
