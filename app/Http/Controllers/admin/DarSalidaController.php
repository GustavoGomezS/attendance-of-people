<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Visitante;
use App\Models\Registro;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DarSalidaController extends Controller
{
  public function index(){
    return view('admin.darSalida.index');
  }

  public function visitantes(){
    $datos = Self::getVisitantes();
    return response()->json(['data' => $datos]);
  }
  private function getVisitantes(){
    $datos = Visitante::select(DB::raw("CONCAT(nombreVisitante,' ', apellidoVisitante) AS nombreVisitante"),
      'visitante.documentoVisitante', 'visitante.id as DT_RowId', 'visitante.telefonoVisitante',
      DB::raw("CONCAT(nombreSector,' - ',unidad) AS sectorUnidad"),)
      ->from('visitante')
      ->join('localidad', 'localidad.id', '=', 'visitante.localidadVisita')
      ->join('sector', 'sector.id', '=', 'localidad.sector')
      ->where([['visitante.estadoVisitante', "=", "3"]])
      ->get();
    return $datos;
  }

  public function darSalida(Request $request){
    $arrayInputs = $request->all();
    if (isset($arrayInputs['id'])) {
      $procesoDeSalidaOk = Self::procesoDeSalida($arrayInputs);
      if ($procesoDeSalidaOk) {
        return response()->json(['success' => true]);
      }    
    }
  }
  private function procesoDeSalida($arrayInputs){
    for ($i = 0; $i < count($arrayInputs['id']); $i++) {
      $estadoDelVisitante = Visitante::findOrFail($arrayInputs['id'][$i]);
      $creaElRegistro = Self::registrarSalida($estadoDelVisitante, $arrayInputs,$i);
      $estadoDelVisitante->update(['estadoVisitante' => 4, 'localidadVisita' =>null]);
    }
    if ($creaElRegistro && $estadoDelVisitante->update()) {
      return true;
    }
  }
  private function registrarSalida($visitante,$arrayInputs,$i){
    $registro = new Registro();
    $registro->ingresoSalida = $arrayInputs['ingresoSalida'];
    $registro->visitante = $arrayInputs['id'][$i];
    $registro->autorizaSeguridad = auth()->user()->id;
    $registro->autorizaResidente = null;
    $registro->localidad = $visitante->localidadVisita;
    $registro->comentario = $arrayInputs['comentario'];
    $registro->puerta = $arrayInputs['puerta'];
    $registro->save();
    if ($registro->save()) {
      return true;
    }
  }
}