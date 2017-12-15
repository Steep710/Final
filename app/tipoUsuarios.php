<?php

namespace BiblioSystem;

use Illuminate\Database\Eloquent\Model;

class tipoUsuarios extends Model
{
  protected $table = "tipo_usuarios";
  protected $fillable = ['nombre', 'estado'];
    //
}
