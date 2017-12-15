<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'FrontController@index' );
Route::get('store', 'RegistroController@store' );
Route::get('ingreso', 'IngresoController@index' );
Route::get('secciones', 'IngresoController@verSecciones' );
Route::get('comprobar', 'IngresoController@comprobarCedula');
Route::get('registro', 'RegistroController@index' );
Route::get('termino', 'FrontController@termino' );
Route::get('login', 'AuthController@showLogin');
Route::resource('dispositivos', 'DispositivoController');
Route::resource('carreras', 'CarreraController');
Route::resource('tipoUsuarios', 'TipoUsuarioController');
Route::resource('prestamo', 'PrestamoController');
Route::resource('visita', 'VisitaController');
Route::resource('visitaDetallada', 'VisitasDetalladaController');
Route::resource('servicios', 'ServiciosController');
Route::resource('grupos', 'GruposController');
Route::auth();
Route::post('periodo-visita', 'VisitaController@verVisitas');
Route::post('periodo-visitaDetallada', 'VisitasDetalladaController@verVisitas');
Route::post('mostrar-grupos', 'GruposController@mostrarGrupos');
Route::get('periodo-grupos', 'GruposController@selectGrupos');
Route::get('historial-dispositivos', 'PrestamoController@verHistorial');

Route::get('/home', 'HomeController@index');
