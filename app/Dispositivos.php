<?php

namespace BiblioSystem;

use Illuminate\Database\Eloquent\Model;
use DB;

class Dispositivos extends Model
{
    protected $table = 'dispositivos';
    protected $fillable = ['codigo', 'nombre', 'cantidad'];

  public static function restarDispositivo($dispo){
    DB::table('dispositivos')
      ->where('id', $dispo->id)
      ->update(['cantidad' => ($dispo->cantidad-1)]);
  }

  public static function sumarDispositivo($dispo){
    DB::table('dispositivos')
      ->where('id', $dispo->id)
      ->update(['cantidad' => ($dispo->cantidad+1)]);
  }
}
