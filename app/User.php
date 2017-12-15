<?php

namespace BiblioSystem;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['deleted_at'];

    public static function guardarRegistro($user, $accion, $dato){
      DB::table('users_history')->insert(
        ['idUser'       => $user,
        'accion'     => $accion,
        'dato'       => $dato,
        'created_at' => Carbon::now()
      ]);
    }

    public static function verHistorial(){
      return $historial = DB::table('users_history')
      ->join('users', 'users.id', '=', 'users_history.idUser')
      ->select('users.name', 'users_history.accion', 'users_history.dato', 'users_history.created_at')
      ->orderBy('users_history.created_at', 'desc')
      ->get();
    }
}
