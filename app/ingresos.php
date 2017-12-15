<?php

namespace BiblioSystem;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class ingresos extends Model
{
  protected $table = 'ingresos';


  public static function verIngresosPorMes($año){
        return $meses = DB::table('ingresos')
                            ->join('servicios', 'servicios.id', '=', 'ingresos.servicio')
                            ->select('servicios.nombre', DB::raw('count(ingresos.usuario) as visitas'))
                            ->where('ingresos.periodo', '=', $año)
                            ->groupBy('servicios.nombre')
                            ->get();
  }

  public static function verIngresosPorMesDetallada($periodo){
        return $meses = DB::table('tipo_usuarios')
                            ->join('usuarios', 'tipo_usuarios.id', '=', 'usuarios.tipoUsuario')
                            ->join('ingresos', 'usuarios.id', '=', 'ingresos.usuario')
                            ->join('servicios', 'ingresos.servicio', '=', 'servicios.id')
                            ->join('carreras', 'usuarios.primerCarrera', '=', 'carreras.id')
                            ->join('carreras as c2', 'usuarios.segundaCarrera', '=', 'c2.id')
                            ->select('usuarios.cedula', 'usuarios.nombre', 'carreras.nombre as carrera1',
                                     'c2.nombre as carrera2', 'tipo_usuarios.nombre as tipo',
                                     'ingresos.created_at as ingreso', 'servicios.nombre as servicio')
                            ->where('ingresos.periodo', '=', $periodo)
                            ->get();
  }
  public static function verIngresosPorDia($periodo){
    return $meses = DB::table('ingresos')
                        ->join('servicios', 'servicios.id', '=', 'ingresos.servicio')
                        ->select('servicios.nombre', DB::raw('count(ingresos.usuario) as visitas'))
                        ->where('ingresos.created_at', 'LIKE', $periodo.'%')
                        ->groupBy('servicios.nombre')
                        ->get();
  }
  public static function registrarIngreso($request, $periodo){
        return  $id = DB::table('ingresos')->insertGetId(
                ['usuario'     => $request->usuario,
                 'servicio'    => $request->servicio,
                 'periodo'     => $periodo,
                 'created_at'  => Carbon::now()
               ]);
    }

}
