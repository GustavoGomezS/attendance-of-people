<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
  public function store(Request $request)
  {
    $request->validate(['nombre' => ['required', 'string', 'max:19']]);
    $sector = new Sector();
    $sector->nombreSector = $request->nombre;
    $sector->color = $request->color;
    $sector->save();
    if ($sector->save()) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false]);
    }
  }
  
  public function edit($Sector)
  {
    $detalleSector = Sector::findOrFail($Sector);
    if ($detalleSector) {
      return response()->json($detalleSector);
    }
  }

  public function update(Request $request, $sector)
  {
    $request->validate(['nombreSector' => ['required', 'string', 'max:19']]);
    $sectorParaActualizar = Sector::findOrFail($sector);
    $formulario = $request->all();
    $resultado = $sectorParaActualizar->fill($formulario)->save();
    if ($resultado) {
      return response()->json(['success' => true]);
    }
    
  }

  public function destroy($sector)
  { 
    $sectorParaEliminar = Sector::findOrFail($sector);
    $resultado = $sectorParaEliminar->delete();
    if ($resultado) {
      return response()->json(['success' => true]);
    }
  }

  public function listar()
  {  
    $datos = Sector::select()->orderBy('nombreSector', 'desc')->paginate(6);
    return view('admin/ubicacion/sectorPuerta/tablas/tablaSector')->with('datos', $datos);
  }
}