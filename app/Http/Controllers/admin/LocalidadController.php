<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Localidad;
use App\Models\Sector;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
  public function index(){
    return view('admin.ubicacion.localidad.index');
  }

  public function store(Request $request){
    $arrayInputs = $request->all();
    $request->validate([
      'unidad' => ['required', 'string', 'max:9'],
      'sector' => ['required']
    ]);
    if (isset($arrayInputs['sector'])) {
      $guardaCorrectamente = Self::localidadesNuevas($arrayInputs);
      if ($guardaCorrectamente) { 
        return response()->json(['success' => true]);
      } else {
        return response()->json(['success' => false]); 
      }
    }
  }
  private function localidadesNuevas($arrayInputs){
    for ($i = 0; $i < count($arrayInputs['sector']); $i++) { 
      $localidad=new Localidad(); 
      $localidad->unidad = $arrayInputs['unidad'];
      $localidad->sector = $arrayInputs['sector'][$i];
      $localidad->save();
    }
    if ($localidad->save()) {
      return true; 
    } 
  }

  public function destroy($localidad){
    $eliminaCorrectamente = Localidad::findOrFail($localidad)->delete();
    if ($eliminaCorrectamente) { 
      return response()->json(['success' => true]);
    }else { 
      return response()->json(['success' => false]); 
    }
  }

  //listar 
  public function listar(){
    $datos = Self::localidades();
    return view('admin.ubicacion.localidad.includes.tabla')->with('datos', $datos);
  }
  private function localidades(){
    $datos = Localidad::select('localidad.*', 'sector.nombreSector')
        ->orderBy('sector.nombreSector', 'desc')
        ->orderBy('unidad', 'asc')
        ->from('localidad')
        ->join('sector', 'sector.id', '=', 'localidad.sector')
        ->paginate(6);
    return $datos;
  }
}