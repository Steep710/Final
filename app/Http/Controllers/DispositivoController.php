<?php

namespace BiblioSystem\Http\Controllers;

use Illuminate\Http\Request;
use BiblioSystem\Dispositivos;
use BiblioSystem\Http\Requests;
use BiblioSystem\Http\Requests\DispositivoRequest;
use Session;
use Redirect;


class DispositivoController extends Controller{

  public function __construct(){
       $this->middleware('auth');
   }
    public function index(){
      $dispositivos = Dispositivos::all();
      return view('dispositivos.index', compact('dispositivos'));
    }

    public function edit($id){
      $dispositivo = Dispositivos::find($id);
      return view('dispositivos.edit', compact('dispositivo'));
    }

    public function create(){
      return view('dispositivos.create');
    }

    public function update(DispositivoRequest $request, $id){
          $dispositivo = Dispositivos::find($id);
          $dispositivo->fill($request->all());
          $dispositivo->save();
          Session::flash('message','Dispositivo Editado Correctamente');
          return Redirect::to('/dispositivos');

    }

    public function store(DispositivoRequest $request){
        Dispositivos::create($request->all());
        Session::flash('message','Dispositivo guardado Correctamente');
        return Redirect::to('/dispositivos');
    }

    public function destroy($id){
      $dispositivo = Dispositivos::find($id);
      $dispositivo->delete();
      Session::flash('message','Dispositivo Eliminado Correctamente');
      return Redirect::to('/dispositivos');

    }


}
