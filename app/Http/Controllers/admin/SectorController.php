<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
  public function store(Request $request){
    $request->validate(['nombre' => ['required', 'string', 'max:19']]);
    $guardaCorrectamente = Self::nuevoSector($request);
    if ($guardaCorrectamente) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  private function nuevoSector($request){
    $sector = new Sector();
    $sector->nombreSector = $request->nombre;
    $sector->color = $request->color;
    $sector->save();
    if ($sector->save()) {
      return true;
    }
  }
  
  public function edit($Sector){
    $detalleSector = Sector::findOrFail($Sector);
    if ($detalleSector) {
      return response()->json($detalleSector);
    }
  }

  public function update(Request $request, $id){
    $request->validate(['nombreSector' => ['required', 'string', 'max:19']]);
    $nuevosDatos = $request->all();
    $actualizaCorrectamente = Sector::findOrFail($id)->fill($nuevosDatos)->save();
    if ($actualizaCorrectamente) {
      return response()->json(['success' => true]);
    }
    
  }

  public function destroy($sector){ 
    $eliminaCorrectamente = Sector::destroy($sector);
    if ($eliminaCorrectamente) {
      return response()->json(['success' => true]);
    }
  }

  public function listar(){  
    $datos = Sector::select()->orderBy('nombreSector', 'desc')->paginate(6);
    return view('admin.ubicacion.sectorPuerta.tablas.tablaSector')->with('datos', $datos);
  }
}