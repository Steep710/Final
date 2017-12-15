<?php

namespace BiblioSystem\Http\Controllers;

use Illuminate\Http\Request;
use BiblioSystem\tipoUsuarios;
use BiblioSystem\Http\Requests;
use Session;
use Redirect;
use DB;

class TipoUsuarioController extends Controller{


    public function __construct(){
         $this->middleware('auth');
     }

  public function index(){
    $tipos = tipoUsuarios::all();
    return view('tipoUsuario.index', compact('tipos'));
  }

  public function edit($id){
    $tipo = tipoUsuarios::find($id);
    return view('tipoUsuario.edit', compact('tipo'));
  }

  public function create(){
    return view('tipoUsuario.create');
  }

  public function update(Request $request, $id){
        $tipo = tipoUsuarios::find($id);
        $tipo->fill($request->all());
        $tipo->save();
        Session::flash('message','Tipo de usuario Editado Correctamente');
        return Redirect::to('/tipoUsuarios');

  }

  public function store(Request $request){
      tipoUsuarios::create($request->all());
      Session::flash('message','Tipo de usuario guardado Correctamente');
      return Redirect::to('/tipoUsuarios');
  }

  public function destroy($id){
    $tipo = tipoUsuarios::find($id);
    if ($tipo->estado == 'Habilitado') {
      DB::table('tipo_usuarios')->where('id', $tipo->id)
          ->update(['estado' => "Inhabilitada"]);
      Session::flash('message','Tipo de Usuario Inhabilitado');
    }else {
      DB::table('tipo_usuarios')->where('id', $tipo->id)
          ->update(['estado' => "Habilitado"]);
      Session::flash('message','Tipo de Usuario Habilitado');
    }
    return Redirect::to('/tipoUsuarios');

  }


}
