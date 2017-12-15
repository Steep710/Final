<?php

namespace BiblioSystem\Http\Controllers;

use Illuminate\Http\Request;
use BiblioSystem\ingresos;
use BiblioSystem\Http\Requests;

class VisitasDetalladaController extends Controller
{
  public function __construct(){
       $this->middleware('auth');
   }

  public function index(){
      return view('visitas.detalladas.periodo');

  }

  public function verVisitas(Request $request){
    $fecha = $request->año . '-' . $request->mes;
    $ingresos = ingresos::verIngresosPorMesDetallada($fecha);
    $fecha = $request->mes . '-' . $request->año;
    return view('visitas.detalladas.index', compact('ingresos', 'fecha'));
  }
}
