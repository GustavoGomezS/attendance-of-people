<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Localidad;
use App\Models\Residente;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EstadoResidenteController extends Controller
{
  public function index(){
    $datos = Self::datosIndex();
    return view('admin.estadoResidente.index')->with('datos', $datos);
  }
  private function datosIndex(){
    $sectores = json_decode(Sector::select('id', 'color')->get(), true);
    $localidades = Self::getLocalidades($sectores);
    return $localidades;
  }
  private function getLocalidades($sectores){
    $datos = array();
    for ($i = 0; $i < count($sectores); $i++) {
      $queryLocalidades = Localidad::select('localidad.id', DB::raw("CONCAT(sector.nombreSector,' - ', localidad.unidad) AS unidad"))
        ->from('localidad')
        ->join('sector', 'sector.id', '=', 'localidad.sector')
        ->where('sector', '=', $sectores[$i]['id'])
        ->get()->all();
      $datos[$sectores[$i]['color']] = Arr::pluck($queryLocalidades, 'unidad', 'id');
    }
    return $datos;
  }

  public function residentes($localidad){
    $residentes = Residente::select()
    ->where([['localidad', '=', $localidad],['estadoResidente','<>', 2]])->get();
    return view('admin.estadoResidente.includes.tablaResidente')->with('datos', $residentes);
  }

  public function update(Request $request){
    $formulario = $request->all();
    if (isset($formulario['estadoResidente'])) {
      DB::table('residente')->where('id', $request->idResidente)->update(['estadoResidente' => 3]);
      return response()->json(['success' => false]);
    } else {
      DB::table('residente')->where('id', $request->idResidente)->update(['estadoResidente' => 4]);
      return response()->json(['success' => false]);
    }
  }
}