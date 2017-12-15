<?php

namespace BiblioSystem;

use Illuminate\Database\Eloquent\Model;
use DB;

class Prestamo extends Model
{
    protected $table = 'prestamos';
    protected $fillable = ['idDispositivo', 'idUsuario', 'fecha_devolucion', 'hora_devolucion', 'estado', 'telefono', 'entregadoPor'];


    public static function obtenerPrestamos(){
      return $prestamos = DB::table('carreras')
                      ->join('usuarios', 'carreras.id', '=', 'usuarios.primerCarrera')
                      ->join('prestamos', 'usuarios.id', '=', 'prestamos.idUsuario')
                      ->join('dispositivos', 'dispositivos.id', '=', 'prestamos.idDispositivo')
                      ->select('usuarios.nombre', 'dispositivos.nombre as dispositivo', 'dispositivos.id as idDispositivo', 'carreras.nombre as carrera', 'prestamos.id as prestamo',
                              'prestamos.telefono','prestamos.created_at', 'prestamos.fecha_devolucion', 'prestamos.hora_devolucion', 'prestamos.estado', 'prestamos.entregadoPor')
                      ->where('prestamos.estado', '=', 'Prestado')
                      ->get();

    }
    public static function obtenerPrestamosEntregados(){
      return $prestamos = DB::table('carreras')
                      ->join('usuarios', 'carreras.id', '=', 'usuarios.primerCarrera')
                      ->join('prestamos', 'usuarios.id', '=', 'prestamos.idUsuario')
                      ->join('dispositivos', 'dispositivos.id', '=', 'prestamos.idDispositivo')
                      ->select('usuarios.nombre', 'dispositivos.nombre as dispositivo', 'dispositivos.id as idDispositivo', 'carreras.nombre as carrera', 'prestamos.id as prestamo',
                              'prestamos.telefono','prestamos.created_at', 'prestamos.fecha_devolucion', 'prestamos.hora_devolucion', 'prestamos.estado', 'prestamos.entregadoPor')
                      ->where('prestamos.estado', '=', 'Devuelto')
                      ->get();

    }
    public static function cambiarEstado($id){
      DB::table('prestamos')
        ->where('id', $id)
        ->update(['estado' => 'Devuelto']);

    }
}
