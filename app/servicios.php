<?php

namespace BiblioSystem;

use Illuminate\Database\Eloquent\Model;

class servicios extends Model
{
  protected $table = 'servicios';
  protected $fillable = ['nombre', 'estado'];


}
