<?php

namespace BiblioSystem\Http\Controllers;
use BiblioSystem\usuarios;
use BiblioSystem\servicios;
use Illuminate\Http\Request;
use Redirect;
use DB;

use BiblioSystem\Http\Requests;
use BiblioSystem\Http\Requests\IngresoRequest;

class IngresoController extends Controller
{
  public function index(){
  //$usuarios = usuarios::all();
  //$servicios = servicios::all();
    return view ('ingreso.index');

  }

  public function store(){
    return view ('ingreso.index');
    //
  }
  public function comprobarCedula(IngresoRequest $request){
  $cedula = $request->input('cedula');
//  $cedula = $_GET['cedula'];
  $users = DB::table('usuarios')->select('id')-> where('cedula', '=', $cedula)->count();

    if ($users > 0) {

      $servicios =  DB::table('servicios')->where('estado', 'Habilitado')->get();
      $users = DB::table('usuarios')->select('id')-> where('cedula', '=', $cedula)->get();
      return view ('ingreso.secciones', compact('servicios', 'users'));
    }
    else {
      session_start();
      $_SESSION["mensaje"]= 1;
      return view ('ingreso.index', compact('alerta'));
    }
  }
}
