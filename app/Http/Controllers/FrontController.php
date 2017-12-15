<?php

namespace BiblioSystem\Http\Controllers;

use Illuminate\Http\Request;
use BiblioSystem\ingresos;
use DB;
use BiblioSystem\Http\Requests;
use Carbon\Carbon;
class FrontController extends Controller{

    public function index(){
      return view ('index');

    }

    public function termino(Request $request){
      $fecha = Carbon::now();
      $mes= (string)$fecha->month;
      $anio = (string) $fecha->year;
      if ($mes != 12 || $mes != 11 || $mes != 10) {
        $periodo = $anio . '-' . '0' . $mes;
      }else {
        $periodo = $anio . '-' . $mes;
      }
      ingresos::registrarIngreso($request, $periodo);
      return view ('termino');
    }
}
