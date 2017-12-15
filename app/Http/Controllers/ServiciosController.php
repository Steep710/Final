<?php

namespace BiblioSystem\Http\Controllers;

use Illuminate\Http\Request;
use BiblioSystem\servicios;
use BiblioSystem\Http\Requests;
use Session;
use Redirect;
use DB;

class ServiciosController extends Controller{


  public function __construct(){
       $this->middleware('auth');
   }

  public function index(){
    $servicios = servicios::all();
    return view('servicios.index', compact('servicios'));
  }

  public function edit($id){
    $servicio = servicios::find($id);
    return view('servicios.edit', compact('servicio'));
  }

  public function create(){
    return view('servicios.create');
  }

  public function update(Request $request, $id){
        $servicio = servicios::find($id);
        $servicio->fill($request->all());
        $servicio->save();
        Session::flash('message','Servicio Editado Correctamente');
        return Redirect::to('/servicios');

  }

  public function store(Request $request){
      servicios::create($request->all());
      Session::flash('message','Servicio guardado Correctamente');
      return Redirect::to('/servicios');
  }

  public function destroy($id){
    $servicio = servicios::find($id);
    if ($servicio->estado == 'Habilitado') {
      DB::table('servicios')->where('id', $servicio->id)
          ->update(['estado' => "Inhabilitada"]);
      Session::flash('message','Servicio Inhabilitado');
    }else {
      DB::table('servicios')->where('id', $servicio->id)
          ->update(['estado' => "Habilitado"]);
      Session::flash('message','Servicio Habilitado');
    }
    return Redirect::to('/servicios');

  }


}
