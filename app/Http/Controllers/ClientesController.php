<?php

namespace App\Http\Controllers;

use DB;
use App\clientes;

use Carbon\Carbon;
use Auth;
use Storage;

use Html;
use Image;

use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;


class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }    	
	
    public function index(Request $request)
    {  	
    	$numpag = 100;

    	$clientes = DB::table('clientes')
                    ->whereNull('deleted_at')
                    ->orderBy('apecli', 'ASC')
                    ->orderBy('nomcli', 'ASC')
                    ->paginate($numpag);
	          
        return view('cli.index', [
            'clientes' => $clientes,
         	'request' => $request
        ]);   
    }
  
    public function ver(Request $request)
    {  	
    	$busca = $request->input('busca');
        $busen = $request->input('busen');
   	
	  	if ( isset($busca) ) {

            if ( $busen == 'apecli' ) {
    		  $busca = htmlentities (trim($busca),ENT_QUOTES,"UTF-8"); 		  
      		  $clientes = DB::table('clientes')
                            ->whereNull('deleted_at')
                            ->where('apecli','LIKE','%'.$busca.'%')
                            ->orderBy('apecli','ASC')
                            ->orderBy('nomcli','ASC')
                            ->get();

            } elseif ($busen == 'dni') {
                
              $busca = htmlentities (trim($busca),ENT_QUOTES,"UTF-8");        
              $clientes = DB::table('clientes')
                            ->whereNull('deleted_at')
                            ->where('dni','LIKE','%'.$busca.'%')
                            ->orderBy('dni','ASC')
                            ->get();
            }
  		} 
  		     
        return view('cli.ver', [
        	'request' => $request,
        	'clientes' => $clientes,
         	'busca' => $busca   	
        ]);     
    }   
 
    public function show(Request $request,$idcli)
    {
    	if ( empty($idcli) ) {
    	  	return redirect('Clientes');
    	}

        $this->dircrea($idcli);

        $clidir = "/app/clidir/$idcli";

        $fotoper = url("$clidir/.fotoper.jpg");

    	$clientes = DB::table('clientes')->where('idcli', $idcli)->first();

		
		$titucli = DB::table('titucli')
			            ->join('titulos', 'titucli.idtit','=','titulos.idtit')
			            ->select('titucli.*','titulos.nomtit')
						->where('idcli',$idcli)
                        ->whereNull('titulos.deleted_at')
						->orderBy('nomtit', 'ASC')
						->get();

		$programcli = DB::table('programcli')
			            ->join('programas', 'programcli.idprog','=','programas.idprog')
			            ->join('especiali', 'programcli.idesp','=','especiali.idesp')
			            ->select('programcli.*','programas.nomprog','especiali.nomesp')
						->where('idcli',$idcli)
                        ->whereNull('programas.deleted_at')
						->orderBy('feini', 'DESC')
						->get();

		$regiscli = DB::table('regiscli')
			            ->join('asuntos', 'regiscli.idasu', '=', 'asuntos.idasu')
			            ->select('regiscli.*', 'asuntos.nomasu')
						->where('idcli',$idcli)
                        ->whereNull('asuntos.deleted_at')
						->orderBy('fech', 'DESC')
						->get();

		$fenac = trim($clientes->fenac);

		if( isset($fenac) ) {
	  		$Fecha = explode("-",$fenac,3);
		  	  
		  	$Fecha0 = $Fecha[0];
		  	$Fecha1 = $Fecha[1];
		  	$Fecha2 = $Fecha[2];
		  	  
		  	$Edad = Carbon::createFromDate($Fecha0,$Fecha1,$Fecha2)->age;

		} else {
			$Edad = 0;
		}

        return response()->view('cli.show',[
            'request' => $request,
            'clientes' => $clientes,
            'titucli' => $titucli,
            'programcli' => $programcli,
            'regiscli' => $regiscli,
            'fotoper' => $fotoper,
            'idcli' => $idcli,
            'Edad' => $Edad
        ])
           ->header('Expires', 'Sun, 01 Jan 1988 00:00:00 GMT')
           ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
           ->header('Cache-Control', ' post-check=0, pre-check=0', FALSE)
           ->header('Pragma', 'no-cache'); 
    }

    public function create(Request $request)
    {
		  return view('cli.create', ['request' => $request]);	
    }

    public function store(Request $request)
    {
        $dni = htmlentities (trim($request->input('dni')),ENT_QUOTES,"UTF-8");

        $clien = clientes::all();

        foreach ($clien as $clie) {
            if($clie->dni == $dni) {
                $messa = 'Repetido. El dni: '.$dni.', pertenece a: 
                    <a href="'.url("/Clientes/$clie->idcli").'" class="pad4" target="_blank">
                        '.$clie->apecli.', '.$clie->nomcli.'
                    </a>';

                $request->session()->flash('errmess', $messa);
                return redirect('Clientes/create');
            }
        }

        $validator = Validator::make($request->all(),[
            'apecli' => 'required|max:111',
            'nomcli' => 'required|max:88',
            'dni' => 'required|unique:clientes|max:12',
            'naf' => 'max:18',
            'email' => 'max:66',	            
            'tel1' => 'max:11',
            'tel2' => 'max:11',
            'tel3' => 'max:11',
            'sexo' => 'max:12',
            'notas' => '',
            'direc' => 'max:111',
            'pobla' => 'max:111',
            'fenac' => 'date'
        ]);
            
        if ($validator->fails()) {
	         return redirect('Clientes/create')
	                     ->withErrors($validator)
	                     ->withInput();
	     } else {
	        	        	
        	$nomcli = ucfirst(strtolower( $request->input('nomcli') ) );
        	$apecli = ucwords(strtolower( $request->input('apecli') ) );
        	$notas = ucfirst(strtolower( $request->input('notas') ) );
        	$direc = ucfirst(strtolower( $request->input('direc') ) );
        	$pobla = ucfirst(strtolower( $request->input('pobla') ) );
        	
			$nomcli = htmlentities (trim($nomcli),ENT_QUOTES,"UTF-8");
			$apecli = htmlentities (trim($apecli),ENT_QUOTES,"UTF-8");
			$dni = htmlentities (trim($request->input('dni')),ENT_QUOTES,"UTF-8");
			$naf = htmlentities (trim($request->input('naf')),ENT_QUOTES,"UTF-8");
			$email = htmlentities (trim($request->input('email')),ENT_QUOTES,"UTF-8");		
			$tel1 = htmlentities (trim($request->input('tel1')),ENT_QUOTES,"UTF-8");
			$tel2 = htmlentities (trim($request->input('tel2')),ENT_QUOTES,"UTF-8");
			$tel3 = htmlentities (trim($request->input('tel3')),ENT_QUOTES,"UTF-8");
			$sexo = htmlentities (trim($request->input('sexo')),ENT_QUOTES,"UTF-8");
			$notas = htmlentities (trim($notas),ENT_QUOTES,"UTF-8");
			$direc = htmlentities (trim($direc),ENT_QUOTES,"UTF-8");
			$pobla = htmlentities (trim($pobla),ENT_QUOTES,"UTF-8");
			$fenac = htmlentities (trim($request->input('fenac')),ENT_QUOTES,"UTF-8");
        	        	
	      	clientes::create([
	          'nomcli' => $nomcli,
	          'apecli' => $apecli,
	          'dni' => $dni,
	          'naf' => $naf,
	          'email' => $email,		          
	          'tel1' => $tel1,
	          'tel2' => $tel2,
	          'tel3' => $tel3,
	          'sexo' => $sexo,
	          'notas' => $notas,
	          'direc' => $direc,
	          'pobla' => $pobla,
	          'fenac' => $fenac
            ]);
	      
	      	$request->session()->flash('sucmess', 'Hecho!!!');	
        	        	
        	return redirect('Clientes/create');
        }      
    }
  
    public function edit(Request $request,$idcli)
    {
	   $cliente = clientes::find($idcli);
	   
	   return view('cli.edit', [
            'request' => $request,
      		'cliente' => $cliente,
      		'idcli' => $idcli
        ]);
	}
 
    public function update(Request $request,$idcli)
    {
        $idcli = htmlentities(trim($idcli),ENT_QUOTES,"UTF-8");
        $dni = htmlentities(trim($request->input('dni')),ENT_QUOTES,"UTF-8");

        $clientes = clientes::all();

        $cliente = clientes::find($idcli);
              
        $dnicli = $cliente->dni;

        $continua = 0;

        if ($dni != $dnicli) {
            foreach ($clientes as $clie) {
                if($clie->dni == $dni) {
                    $messa = 'Repetido. El dni: '.$dni.', pertenece a: 
                        <a href="'.url("/Clientes/$clie->idcli").'" class="pad4" target="_blank">
                            '.$clie->apecli.', '.$clie->nomcli.'
                        </a>';

                    $request->session()->flash('errmess', $messa);
                    return redirect("Clientes/$idcli/edit");
                }  
            }
        }

        $validator = Validator::make($request->all(),[
            'apecli' => 'required|max:111',
            'nomcli' => 'required|max:88',
            'dni' => 'required|max:12',
            'naf' => 'max:18',
            'email' => 'max:66',	            
            'tel1' => 'max:11',
            'tel2' => 'max:11',
            'tel3' => 'max:11',
            'sexo' => 'max:12',
            'notas' => '',
            'direc' => 'max:111',
            'pobla' => 'max:111',
            'fenac' => 'date'
        ]);
            
        if ($validator->fails()) {
	         return redirect("Clientes/$idcli/edit")
	                     ->withErrors($validator)
	                     ->withInput();
	    } else { 
 		    		
    		$fenac = $request->input('fenac');
    		
    		$regex = '/^(18|19|20)\d\d[\/\-.](0[1-9]|1[012])[\/\-.](0[1-9]|[12][0-9]|3[01])$/';
    		
    		if ( preg_match($regex, $fenac) ) {  } else {
		 	   $request->session()->flash('errmess', 'Fecha/s incorrecta');
		 	   return redirect("Clientes/$idcli/edit");
	 		}
    		
    		$clientes = clientes::find($idcli);
    		  		
        	$nomcli = ucfirst(strtolower( $request->input('nomcli') ) );
        	$apecli = ucwords(strtolower( $request->input('apecli') ) );
        	$notas = ucfirst(strtolower( $request->input('notas') ) );
        	$direc = ucfirst(strtolower( $request->input('direc') ) );
        	$pobla = ucfirst(strtolower( $request->input('pobla') ) );

            $dni = htmlentities (trim($request->input('dni')),ENT_QUOTES,"UTF-8");
        	
			$clientes->nomcli = htmlentities (trim($nomcli),ENT_QUOTES,"UTF-8");
			$clientes->apecli = htmlentities (trim($apecli),ENT_QUOTES,"UTF-8");
			$clientes->dni = $dni;			
			$clientes->naf = htmlentities (trim($request->input('naf')),ENT_QUOTES,"UTF-8");
			$clientes->email = htmlentities (trim($request->input('email')),ENT_QUOTES,"UTF-8");
			$clientes->tel1 = htmlentities (trim($request->input('tel1')),ENT_QUOTES,"UTF-8");
			$clientes->tel2 = htmlentities (trim($request->input('tel2')),ENT_QUOTES,"UTF-8");
			$clientes->tel3 = htmlentities (trim($request->input('tel3')),ENT_QUOTES,"UTF-8");
			$clientes->sexo = htmlentities (trim($request->input('sexo')),ENT_QUOTES,"UTF-8");
			$clientes->notas = htmlentities (trim($notas),ENT_QUOTES,"UTF-8");
			$clientes->direc = htmlentities (trim($direc),ENT_QUOTES,"UTF-8");
			$clientes->pobla = htmlentities (trim($pobla),ENT_QUOTES,"UTF-8");
			$clientes->fenac = htmlentities (trim($request->input('fenac')),ENT_QUOTES,"UTF-8");
			
			$clientes->save();
      
		    $request->session()->flash('sucmess', 'Hecho!!!');
		        	
		    return redirect("Clientes/$idcli");
	    }    
    }

    public function file(Request $request,$idcli)
    {
    	if ( null === $idcli ) {
    		return redirect('Clientes');
    	}

    	$idcli = htmlentities (trim($idcli),ENT_QUOTES,"UTF-8");

        $this->dircrea($idcli);
   	  
        $clidir = "/clidir/$idcli";

        $files = Storage::files($clidir);

        $url = url("Clientes/$idcli");


		return view('cli.file', [
            'request' => $request,
    	  	'idcli' => $idcli,
    	  	'files' => $files,
            'url' => $url
        ]);
    }

    public function upload(Request $request)
    {	
		$idcli = $request->input('idcli');

		$fotoper = $request->input('fotoper');

		if ( null === $idcli ) {
    		return redirect('Clientes');
    	}  

    	$idcli = htmlentities (trim($idcli),ENT_QUOTES,"UTF-8");  

        $clidir = storage_path("app/clidir/$idcli");

		$files = $request->file('files');

        if ($fotoper == 1) {
            $extension = $files->getClientOriginalExtension();

            if ($extension == 'jpg' || $extension == 'png') {

                Image::make($files)->encode('jpg', 80)
                    ->resize(150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save("$clidir/.fotoper.jpg");

                return redirect("Clientes/$idcli");

            } else { 
                $request->session()->flash('errmess', 'Formato no soportado, suba una imagen jpg o png.');
                return redirect("Clientes/$idcli");
            }

        } else {

            $ficount = count($files);
            $upcount = 0;

            foreach ($files as $file) {                       
                $filename = $file->getClientOriginalName();
                $size = $file->getClientSize();

                $max = 1024 * 1024 * 4;
 
                $filedisk = storage_path("app/clidir/$idcli/$filename");

                if ( $size > $max ) {
                    $mess = "El archivo: - $filename - es superior a 4MB";
                    $request->session()->flash('errmess', $mess);
                    return redirect("Clientes/$idcli/file");
                }                

                if ( file_exists($filedisk) ) {
                    $mess = "El archivo: $filename -- existe ya en su carpeta";
                    $request->session()->flash('errmess', $mess);
                    return redirect("Clientes/$idcli/file");

                } else {
                    $file->move($clidir, $filename);
                    $upcount ++;
                }
            }
		    
		    if($upcount == $ficount){
		      return redirect("Clientes/$idcli/file");
		    } else {
		      $request->session()->flash('errmess', 'error!!!');
		      return redirect("Clientes/$idcli/file");
		    }
		}
    }

    public function download(Request $request,$idcli,$file)
    {   
        $idcli = htmlentities (trim($idcli),ENT_QUOTES,"UTF-8");

        $clidir = storage_path()."/app/clidir/$idcli/";

        $filedown = $clidir.'/'.$file;

        return response()->download($filedown);
    } 

    public function filerem(Request $request)
    {  	  
    	$idcli = $request->input('idcli');
    	$filerem = $request->input('filerem');

    	$idcli = htmlentities (trim($idcli),ENT_QUOTES,"UTF-8");

        $clidir = "/clidir/$idcli";

        $firem = "$clidir/$filerem";
    	  
        Storage::delete($firem);	  
    	  
    	return redirect("Clientes/$idcli/file");
    }  
    
    public function del(Request $request,$idcli)
    {
     	if ( empty($idcli) ) {
    	  	return redirect('Clientes');
    	}

        $idcli = htmlentities (trim($idcli),ENT_QUOTES,"UTF-8");

        $cliente = clientes::find($idcli);

    	return view('cli.del', [
            'request' => $request,
            'cliente' => $cliente,
            'idcli' => $idcli
        ]);
    }
 
    public function destroy(Request $request,$idcli)
    {      
     	if ( empty($idcli) ) {
    	  	return redirect('Clientes');
    	}
        
        $idcli = htmlentities (trim($idcli),ENT_QUOTES,"UTF-8"); 
        
        clientes::destroy($idcli);

        $request->session()->flash('sucmess', 'Hecho!!!');
        
        return redirect('Clientes');
    }

    public function dircrea($idcli)
    {               
        $clidir = '/clidir/'.$idcli;

        if ( ! Storage::exists($clidir) ) { 
            Storage::makeDirectory($clidir,0770,true);
        }

        $thumbdir = $clidir.'/.thumbdir';

        if ( ! Storage::exists($thumbdir) ) {
            Storage::makeDirectory($thumbdir,0770,true);
        }

        $fotoper = "/$clidir/.fotoper.jpg";
        $foto = '/assets/img/fotoper.jpg';
          
        if ( ! Storage::exists($fotoper) ) { 
            Storage::copy($foto,$fotoper);
        }          

        $thumbdir = $clidir.'/.thumbdir';

        if ( ! Storage::exists($thumbdir) ) { 
            Storage::makeDirectory($thumbdir,0770,true);
        }

    }  

}
