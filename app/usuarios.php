<?php

namespace BiblioSystem;

use Illuminate\Database\Eloquent\Model;
use DB;

class usuarios extends Model
{
  protected $table = 'usuarios';
  protected $fillable = ['tipoUsuario', 'primerCarrera', 'segundaCarrera', 'cedula', 'nombre'];

  public static function buscarUsuario($id){
    return $usuario = DB:: table('usuarios')
                        ->select('id')
                        ->where('cedula', $id)
                        ->first();
  }

}
