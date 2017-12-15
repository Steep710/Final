<?php

namespace BiblioSystem;

use Illuminate\Database\Eloquent\Model;
use DB;

class Grupos extends Model
{
  protected $table = 'grupos';
  protected $fillable = ['cedula', 'nombreSupervisor', 'cantidadAlumno', 'idCarrera', 'asunto', 'horaInicio', 'horaFinal', 'created_at'];

  public static function obtenerGruposPorMes($periodo){
    return $grupos = DB::table('grupos')
                  ->join('carreras', 'carreras.id', '=', 'grupos.idCarrera')
                  ->select('carreras.nombre as carrera', 'grupos.cedula', 'grupos.nombreSupervisor', 'grupos.cantidadAlumno', 'grupos.asunto', 'grupos.horaInicio', 'grupos.horaFinal', 'grupos.created_at')
                  ->where('grupos.created_at','like', $periodo.'%')
                  ->get();

  }

}
