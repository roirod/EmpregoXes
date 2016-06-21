<?php

Route::group(['middleware' => 'web'], function () {
    
	 Route::get('/', 'Auth\AuthController@getLogin');
	 Route::get('/login', 'Auth\AuthController@getLogin');
	 Route::post('/login', 'Auth\AuthController@postLogin');
	 Route::get('/logout', 'Auth\AuthController@getLogout');
	 
	 Route::get('/home', 'ClientesController@index');

	 Route::get('/Manual', function() {
	 	return view('Manual');
	 });
	

	 Route::group(['middleware' => 'admin'], function () {	

		Route::get('Clientes/{id}/del', 'ClientesController@del');
	 	Route::delete('Clientes/{id}', 'ClientesController@destroy');

	 	Route::get('Programas/{id}/del', 'ProgramasController@del');
		Route::delete('Programas/{id}', 'ProgramasController@destroy');

		Route::get('Asuntos/{id}/del', 'AsuntosController@del');
		Route::delete('Asuntos/{id}', 'AsuntosController@destroy');

		Route::get('Especiali/{id}/del', 'EspecialiController@del');
		Route::delete('Especiali/{id}', 'EspecialiController@destroy');

		Route::get('Titulos/{id}/del', 'TitulosController@del');
		Route::delete('Titulos/{id}', 'TitulosController@destroy');


	 	Route::get('Usuarios/usuedit', 'UsuariosController@usuedit');
	 	Route::get('Usuarios/usudel', 'UsuariosController@usudel');
	 	Route::post('Usuarios/saveup', 'UsuariosController@saveup');
	 	Route::post('Usuarios/delete', 'UsuariosController@delete');
	 	Route::resource('Usuarios', 'UsuariosController');
	 });


	 Route::group(['middleware' => 'medio'], function () {

	 	Route::get('Clientes/{id}/edit', 'ClientesController@edit');
	 	Route::put('Clientes/{id}', 'ClientesController@update');
	 	Route::post('Clientes/filerem', 'ClientesController@filerem');

		Route::get('Programas/{id}/edit', 'ProgramasController@edit');
		Route::put('Programas/{id}', 'ProgramasController@update');

	 	Route::get('Asuntos/{id}/edit', 'AsuntosController@edit');
	 	Route::put('Asuntos/{id}', 'AsuntosController@update');

	 	Route::get('Especiali/{id}/edit', 'EspecialiController@edit');
	 	Route::put('Especiali/{id}', 'EspecialiController@update');	 	

	 	Route::get('Titulos/{id}/edit', 'TitulosController@edit');
	 	Route::put('Titulos/{id}', 'TitulosController@update');

		Route::delete('Especiprog/{id}', 'EspeciprogController@destroy');

	 	Route::delete('Titucli/{id}', 'TitucliController@destroy');

		Route::get('Programcli/{idcli}/{idprocli}/edit', 'ProgramcliController@edit');
		Route::get('Programcli/{idcli}/{idprocli}/del', 'ProgramcliController@del');
		Route::put('Programcli/{idprocli}', 'ProgramcliController@update');
		Route::delete('Programcli/{idprocli}', 'ProgramcliController@destroy');	

		Route::get('Regiscli/{idpac}/{id}/edit', 'RegiscliController@edit');
		Route::put('Regiscli/{id}', 'RegiscliController@update');
		Route::get('Regiscli/{idpac}/{id}/del', 'RegiscliController@del');
		Route::delete('Regiscli/{id}', 'RegiscliController@destroy');
	 });
	 
	
	 Route::post('Clientes/ver', 'ClientesController@ver');
	 Route::get('Clientes/{idcli}/file', 'ClientesController@file');
	 Route::post('Clientes/upload', 'ClientesController@upload');
	 Route::get('Clientes/{idcli}/{file}/down', 'ClientesController@download');
	 Route::resource('Clientes', 'ClientesController');


	 Route::get('Regiscli/{id}/create', 'RegiscliController@create');
	 Route::resource('Regiscli', 'RegiscliController');
	 
	 Route::resource('Asuntos/ver', 'AsuntosController@ver');
	 Route::resource('Asuntos', 'AsuntosController');

	 Route::post('Programas/ver', 'ProgramasController@ver');
	 Route::resource('Programas', 'ProgramasController');

	 Route::post('Programcli/crea','ProgramcliController@crea');
	 Route::post('Programcli/selcrea', 'ProgramcliController@selcrea');
	 Route::resource('Programcli', 'ProgramcliController');

	 Route::post('Especiali/ver', 'EspecialiController@ver');
	 Route::resource('Especiali', 'EspecialiController');

	 Route::get('Especiprog/{id}/create', 'EspeciprogController@create');
	 Route::resource('Especiprog', 'EspeciprogController');
	 
	 Route::post('Titulos/ver', 'TitulosController@ver');
	 Route::resource('Titulos', 'TitulosController');
	 
	 Route::get('Titucli/{id}/create', 'TitucliController@create');
	 Route::resource('Titucli', 'TitucliController');

	 Route::resource('Ajustes', 'AjustesController');

	 Route::post('Buscador/ver', 'BuscadorController@ver');
	 Route::resource('Buscador', 'BuscadorController');
 
});
