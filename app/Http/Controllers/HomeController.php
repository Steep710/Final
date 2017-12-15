<?php

namespace BiblioSystem\Http\Controllers;

use BiblioSystem\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use BiblioSystem\ingresos;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $fecha = Carbon::now();
        $dia =$fecha->day;
        $mes = $fecha->month;
        $anio = $fecha->year;
        if ($dia == 1 || $dia == 2 || $dia == 3 || $dia == 4 || $dia == 5 || $dia == 6|| $dia == 7|| $dia == 8|| $dia == 9) {
          $dia = '0'.$dia;
        }
        if ($mes != 12 || $mes != 11 || $mes != 10) {
          $mes = '0'.$mes;
        }
        $fecha2 = $anio . '-' . $mes . '-' . $dia;
        $ingresos = ingresos::verIngresosPorDia($fecha2);
        return view('admin.index', compact('ingresos'));
    }
}
