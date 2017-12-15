<?php

namespace BiblioSystem\Http\Controllers;

use BiblioSystem\usuarios;
use Illuminate\Http\Request;
use BiblioSystem\Prestamo;
use BiblioSystem\Dispositivos;
use BiblioSystem\Http\Requests;
use Session;
use Redirect;
use DB;

class PrestamoController extends Controller
{
  public function __construct(){
       $this->middleware('auth');
   }
    public function index(){
      $prestamos = Prestamo::obtenerPrestamos();
      return view('prestamo.index', compact('prestamos'));
    }

    public function create(){
      $dispositivos = Dispositivos::all();
      return view('prestamo.create', compact('dispositivos'));
    }

    public function verHistorial(){
      $prestamos = Prestamo::obtenerPrestamosEntregados();
      return view('prestamo.historial', compact('prestamos'));
    }

    public function update(Request $request, $id){
          $prestamo = Prestamo::find($id);
          Prestamo::cambiarEstado($prestamo->id);
          $dispo = Dispositivos::find($request->idDispositivo);
          Dispositivos::sumarDispositivo($dispo);
          Session::flash('message','Dispositivo Devuelto Correctamente');
          return Redirect::to('/prestamo');

    }

    public function store(Request $request){
      $usuario = usuarios::buscarUsuario($request->idUsuario);
      $codigo = explode(' - ', $request->idDispositivo);
      $cod = $codigo[0];
      $dispo = DB::table('dispositivos')->where('codigo', $cod)->first();

      if (!$usuario) {
        Session::flash('message','Usuario no se encuentra');
        $dispositivos = Dispositivos::all();
        return view('prestamo.create', compact('dispositivos'));
      }elseif ($dispo->cantidad == 0) {
        Session::flash('message','No hay unidades en stock');
        $dispositivos = Dispositivos::all();
        return view('prestamo.create', compact('dispositivos'));
      }
        Prestamo::create([
          'idUsuario' =>$usuario->id,
          'idDispositivo' => $dispo->id,
          'fecha_devolucion' => $request['fecha_devolucion'],
          'hora_devolucion'  => $request['hora_devolucion'],
          'estado' =>$request['estado'],
          'telefono' =>$request['telefono'],
          'entregadoPor' =>$request['entregadoPor'],
        ]);
        Dispositivos::restarDispositivo($dispo);
        Session::flash('message','Dispositivo prestado Correctamente');
        return Redirect::to('/prestamo');
    }

    public function destroy($id){
      $dispositivo = Dispositivos::find($id);
      $dispositivo->delete();
      Session::flash('message','Dispositivo Eliminado Correctamente');
      return Redirect::to('/dispositivos');

    }


}
