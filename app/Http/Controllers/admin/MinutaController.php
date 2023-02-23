<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Minuta;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MinutaController extends Controller
{
  public function index(){
    return view('admin.minuta.index');
  }

  public function store(Request $request){
    $request->validate([
      'comentario' => ['required', 'max:500'],
    ]);
    $guardaCorrectamente=Self::registroNuevo($request); 
    if ($guardaCorrectamente) {
      return response()->json(['success' => true]);
    }   
  }
  private function registroNuevo($request){
    $registro = new Minuta();
    $registro->usuario = $request->usuario;
    $registro->comentario = $request->comentario;
    $registro->save();
    if ($registro->save()) {
      return true;
    }
  }

  public function registros(Request $request){
    $datos = Self::getRegistros($request);
    return response()->json(['data' => $datos]);
  }
  private function getRegistros($request){
    $datos = Minuta::select('minuta.*',DB::raw("CONCAT(users.name,' ', users.last_name) AS nombreUsuario"))
      ->orderBy('created_at', 'desc')
      ->from('minuta')
      ->join('users', 'users.id', '=', 'minuta.usuario')
      ->whereBetween('minuta.created_at', [$request->fechaInicio . " 00:00:00 ", $request->fechaFin . " 23:59:59"])
      ->get();
    $datos = json_decode($datos);
    $nuevosDatos = array_map("Self::modificarDatosDeNovedades", $datos);
    return $nuevosDatos;
  }
  private function modificarDatosDeNovedades($datos){
    Self::modificarFormatoFecha($datos);
    return $datos;
  }
  private function modificarFormatoFecha($datos){
    $fechaVieja = new DateTime($datos->created_at);
    $datos->created_at = $fechaVieja->format('d-m-Y H:i:s');
  }
}
