<?php

namespace BiblioSystem\Http\Controllers;
use BiblioSystem\tipoUsuarios;
use BiblioSystem\carreras;
use BiblioSystem\usuarios;
use BiblioSystem\servicios;
use Illuminate\Http\Request;
use Redirect;
use DB;
use Session;

use BiblioSystem\Http\Requests;

class RegistroController extends Controller
{
  public function index(){
    $tipos = DB::table('tipo_usuarios')->where('estado', 'Habilitado')->get();
    $carreras = DB::table('carreras')->where('estado', 'Habilitada')->get();
    return view ('registro.index', compact('tipos','carreras'));

  }

  public function store(){
    if ($_GET['cedula1'] != NULL ) {

    $cedula = $_GET['cedula1'];

  }elseif ($_GET['cedula2'] != NULL ) {

    $cedula = $_GET['cedula2'];

  }elseif ($_GET['cedula1'] == NULL && $_GET['cedula2'] == NULL  ) {
    $tipos = tipoUsuarios::all();
    $carreras = carreras::all();
    Session::flash("mensaje", "1");
    return view ('registro.index', compact('tipos','carreras'));
  }
  $comprobarCedula = usuarios::buscarUsuario($cedula);
  if ($comprobarCedula) {
    $tipos = tipoUsuarios::all();
    $carreras = carreras::all();
    Session::flash("mensaje", "2");
    return view ('registro.index', compact('tipos','carreras'));
  }

    $nombre = $_GET['nombre'];
    $nombreTipo = $_GET['tipoUsuario'];
    $nombreCarrera1 = $_GET['primerCarrera'];
    $nombreCarrera2 = $_GET['segundaCarrera'];

    $segundaCarrera = (int) $nombreCarrera2;
    $tipoUsuario = (int) $nombreTipo;
    $primerCarrera = (int) $nombreCarrera1;

    DB::statement(" INSERT INTO usuarios(tipoUsuario, primerCarrera, segundaCarrera, cedula, nombre, created_at) VALUES ($tipoUsuario, $primerCarrera, $segundaCarrera, '$cedula', '$nombre', now()) ");
    //DB::table('usuarios')->insert(
    //  ['tipoUsuario' => $tipoUsuario, 'primerCarrera' => $primerCarrera, 'segundaCarrera' => $segundaCarrera, 'cedula' => $cedula, 'nombre' =>  $nombre]
    //);
    $servicios =  DB::table('servicios')->where('estado', 'Habilitado')->get();
    $users = DB::table('usuarios')->select('id')-> where('cedula', '=', $cedula)->get();
    Session::flash("mensaje", "3");
    return view ('ingreso.secciones', compact('servicios', 'users'));
  }
}
