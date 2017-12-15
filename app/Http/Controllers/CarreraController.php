<?php

namespace BiblioSystem\Http\Controllers;

use Illuminate\Http\Request;
use BiblioSystem\Carreras;
use BiblioSystem\Http\Requests;
use Session;
use Redirect;
use DB;

class CarreraController extends Controller{


    public function __construct(){
         $this->middleware('auth');
     }

  public function index(){
        $carreras = Carreras::all();
        return view('carrera.index', compact('carreras'));
  }

  public function edit($id){
        $carrera = Carreras::find($id);
        return view('carrera.edit', compact('carrera'));
  }

  public function create(){
        return view('carrera.create');
  }

  public function update(Request $request, $id){
        $carrera = Carreras::find($id);
        $carrera->fill($request->all());
        $carrera->save();
        Session::flash('message','Carrera Editada Correctamente');
        return Redirect::to('/carreras');

  }

  public function store(Request $request){
        Carreras::create($request->all());
        Session::flash('message','Carrera guardada Correctamente');
        return Redirect::to('/carreras');
  }

  public function destroy($id){
        $carrera = Carreras::find($id);
        if ($carrera->estado == 'Habilitada') {
          DB::table('carreras')->where('id', $carrera->id)
              ->update(['estado' => "Inhabilitada"]);
          Session::flash('message','Carrera Inhabilitada');
        }else {
          DB::table('carreras')->where('id', $carrera->id)
              ->update(['estado' => "Habilitada"]);
          Session::flash('message','Carrera Habilitada');
        }
        return Redirect::to('/carreras');

  }


}
