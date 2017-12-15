<?php

namespace BiblioSystem\Http\Controllers;

use Illuminate\Http\Request;
use BiblioSystem\ingresos;
use BiblioSystem\Http\Requests;

class VisitaController extends Controller{


    public function __construct(){
         $this->middleware('auth');
     }

    public function index(){
        return view('visitas.periodo');

    }

    public function verVisitas(Request $request){
      $fecha = $request->año . '-' . $request->mes;
      $ingresos = ingresos::verIngresosPorMes($fecha);
      $fecha = $request->mes . '-' . $request->año;
      return view('visitas.index', compact('ingresos', 'fecha'));
    }
}
