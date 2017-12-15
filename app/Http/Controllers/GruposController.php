<?php

namespace BiblioSystem\Http\Controllers;

use Illuminate\Http\Request;
use BiblioSystem\carreras;
use BiblioSystem\Grupos;
use BiblioSystem\ingresos;
use BiblioSystem\Http\Requests;
use Redirect;
use Session;

class GruposController extends Controller{

  public function index (){
      $carreras = carreras::all();
      return view ("grupos.index" ,compact('carreras'));
  }

  public function store(Request $request){
    if($request->cedula==null){
      $carreras = carreras::all();
      Session::flash('mensaje', '2');
      return view ("grupos.index" ,compact('carreras'));
    }
    $grupos = Grupos::create($request->all());
    $grupos->save();
    Session::flash('mensaje', '1');
    return Redirect::to('/');
  }

  public function mostrarGrupos(Request $request){
    $fecha = $request->año .'-'.$request->mes;
    $grupos = Grupos::obtenerGruposPorMes($fecha);
    return view("grupos.mostarGrupos", compact('grupos'));
  }

  public function selectGrupos(Request $request){
    $fecha = $request->año . '-' . $request->mes;
    $ingresos = ingresos::verIngresosPorMes($fecha);
    $fecha = $request->mes . '-' . $request->año;
    return view('grupos.selectPeriodo', compact('ingresos', 'fecha'));
  }

}
